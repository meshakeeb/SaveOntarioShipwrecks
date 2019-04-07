<?php
class BoltMediaAjax{

	function deny(){
	    $response = array(
	    	'error' => true,
	    	'error_message' => 'Unauthorized Ajax Process'
	    );
	    die();
	}

	function moderate_photos(){
		$response = false;

	    if ( ! isset( $_POST['nonce_field'] )  || ! wp_verify_nonce( $_POST['nonce_field'], 'moderate_photos_nonce') ) {
	 	        exit('The form is not valid'); 
	    }
	    
	    $args = array(
			'ID'           => $_POST['post_id'],
			'post_status'   => $_POST['status'],
		);


	    if ( wp_update_post($args) != 0){
	    	$response = '<div class="alert alert-success">The status of this photo is now set to '.$_POST['status'].'.</div>';	
	    } else {
	    	$response = '<div class="alert alert-danger">ERROR: Something went wrong :(  <br> Please contact the web administrator.</div>';	
	    }

	    wp_send_json($response);

	    die();
	}
	
	function update_profile() {
		$response = false;

	    if ( ! isset( $_POST['nonce_field'] )  || ! wp_verify_nonce( $_POST['nonce_field'], 'edit_profile_nonce') ) {
	 	        exit('The form is not valid'); 
	    }


		$user_id = $_POST['userID'];

		$update_user = wp_update_user( array( 'ID' => $user_id, 'user_url' => $website ) );


		$metas = array( 
		    'bolt_profilePic'   => $_POST['j_photo'],
		);

		foreach($metas as $key => $value) {
		    $success = update_user_meta( $user_id, $key, $value );
		    if(!$success) break;
		}

	    if( !is_wp_error($update_user) ){
	 		$response = '<div class="alert alert-success">Profile updated</div>';
	    } else {
	    	$response = '<div class="alert alert-danger">ERROR: Something went wrong :(  <br> Please contact the web administrator.</div>';
	    }
		
		wp_send_json($response);

	    die();
	}


	function update_member(){
		$response = false;

	    if ( ! isset( $_POST['nonce_field'] )  || ! wp_verify_nonce( $_POST['nonce_field'], 'edit_member_nonce') ) {
	 	        exit('The form is not valid'); 
	    }
		
		
	    $capabilities['allow_chapter'] = array( 'publish_chapters', 'edit_chapters', 'edit_others_chapters', 'delete_chapters', 'delete_others_chapters', 'read_private_chapters', 'edit_chapters', 'delete_chapters', 'read_chapters', 'upload_files');
	    $capabilities['allow_buoy_status'] = array('publish_buoy_status', 'edit_buoy_status', 'edit_others_buoy_status', 'delete_buoy_status', 'delete_others_buoy_status', 'read_private_buoy_status', 'edit_buoy_status', 'delete_buoy_status', 'read_buoy_status', 'upload_files');
	    $capabilities['allow_buoy_site'] = array('publish_buoy_site', 'edit_buoy_site', 'edit_others_buoy_site', 'delete_buoy_site', 'delete_others_buoy_site', 'read_private_buoy_site', 'edit_buoy_site', 'delete_buoy_site', 'read_buoy_site', 'upload_files');
	    $capabilities['allow_events'] = array('edit_tribe_events', 'edit_others_tribe_events', 'edit_private_tribe_events', 'edit_published_tribe_events', 'delete_tribe_events', 'delete_others_tribe_events', 'delete_private_tribe_events', 'delete_published_tribe_events', 'publish_tribe_events', 'read_private_tribe_venues', 'edit_tribe_venues', 'edit_others_tribe_venues', 'edit_private_tribe_venues', 'edit_published_tribe_venues', 'delete_tribe_venues', 'delete_others_tribe_venues', 'delete_private_tribe_venues', 'delete_published_tribe_venues', 'publish_tribe_venues', 'read_private_tribe_organizers', 'edit_tribe_organizers', 'edit_others_tribe_organizers', 'edit_private_tribe_organizers', 'edit_published_tribe_organizers', 'delete_tribe_organizers', 'delete_others_tribe_organizers', 'delete_private_tribe_organizers' , 'delete_published_tribe_organizers', 'publish_tribe_organizers', 'upload_files');
	    $capabilities['allow_newsletter'] = array('send_newsletter', 'upload_files');	
	    $capabilities['manage_chapter_members'] = array('manage_chapter_members', 'upload_files');		
	    $capabilities['manage_products'] = array('edit_products', 'edit_others_products', 'publish_products', 'read_private_products', 'delete_products', 'delete_published_products', 'edit_published_products');

		$caps = [];
		$diff = [];

		foreach( $_POST['boltcap'] as $c){
			$caps[$c] = $capabilities[$c];
		}

		$diff = array_diff_assoc($capabilities, $caps);

    
		$user_id = $_POST['userID'];

		$u = new WP_User( $user_id );
			//remove caps
			foreach($diff as $old_caps){
				foreach($old_caps as $o){
					$u->remove_cap($o);
				}
			}

			//add capabilities
			foreach($caps as $new_caps){
				foreach($new_caps as $n){
					$u->add_cap($n);
				}
			}
		$u->set_role( $_POST['role'] );		

		
		$member = get_userdata($user_id);

	    $option = get_option('email_permission');

		$subject = ( $option['title'] != "" ) ? $option['title'] : "Your SOS Membership Was Upgraded";
        $headers = 'From: Save Ontario Shipwrecks <wordpress@saveontarioshipwrecks.ca>' . "\r\n";

        $permissions = null;
        $permissions .= '<table cellpadding="15" cellspacing="5" border="1" width="100%">';
			if($_POST['role'] === "bolt_chapter_editor"){
				$permissions .= "<tr><td>Manage the whole Chapter as editor</td></tr>";
			} else {	

				$user_cap['allow_chapter'] = "Manage the chapter";
				$user_cap['allow_buoy_status'] = "Manage the buoy status";
			    $user_cap['allow_buoy_site'] = "Manage the buoy site";
			    $user_cap['allow_events'] = "Create an event";
			    $user_cap['allow_newsletter'] = 'Send newsletter to our chapter members';	
			    $user_cap['manage_chapter_members'] = 'Manage Chapter Members';		
			    $user_cap['manage_products'] = 'Manage products';

			    $permissions .= '<tr>';
			    	$permissions .= '<td width="80%" align="center"><strong>Capability</strong></td>';
			    	$permissions .= '<td width="10%" align="center"><strong>Yes</strong></td>';
			    	$permissions .= '<td width="10%" align="center"><strong>No</strong></td>';
			    $permissions .= '</tr>';

			    foreach( $user_cap as $k => $c ){
			    	$yes = ( in_array($k, $_POST['boltcap']) ) ? '✔' : '✘';
			    	$no = ( !in_array($k, $_POST['boltcap']) ) ? '✔' : '✘';
				    $permissions .= '<tr>';
				    	$permissions .= '<td>'.$c.'</td>';
				    	$permissions .= '<td align="center">'.$yes.'</td>';
				    	$permissions .= '<td align="center">'.$no.'</td>';
				    $permissions .= '</tr>';					
				}
			}
		$permissions .= '</table>';

		//$response = $permissions;		
		//wp_send_json($response);
		//die();		

        $content = ( $option['content'] != "") ? $option['content'] : 'This needs to be configured in the dashboard.';

        $search = array("{lname}","{fname}","{permissions}");
        $replace = array($member->billing_last_name, $member->billing_first_name, $permissions);

        $content = str_replace($search, $replace, $content);		

        $mail = wp_mail( $member->user_email, $subject, $content, $headers );
		
		
		$response = '<div class="alert alert-success">Member Role updated!</div>';		
		wp_send_json($response);

		die();
	}


	function remind_member(){
		$response = false;
		$headers = null;

	    if ( ! isset( $_POST['nonce_field'] )  || ! wp_verify_nonce( $_POST['nonce_field'], 'remind_member_nonce') ) {
	 	        exit('The form is not valid'); 
	    }

	    $option = get_option('email_renewal');



		$subject = ( $option['title'] != "" ) ? $option['title'] : "Your SOS Membership Reminder";
        
        $headers .= 'From: Save Ontario Shipwrecks <wordpress@saveontarioshipwrecks.ca>' . "\r\n";
        $headers .= array('Content-Type: text/html; charset=UTF-8');


        $content = ( $option['content'] != "") ? $option['content'] : 'This needs to be configured in the dashboard.';

        $search = array("{lname}","{fname}","{expiration}");
        $replace = array($_POST["userLname"], $_POST["userFname"], $_POST["userExpired"]);

        $content = str_replace($search, $replace, $content);

        $mail = wp_mail( $_POST['userEmail'], $subject, $content, $headers );	    

		$response = '<div class="alert alert-success alert-dismissible" style="position: absolute;width: 100%;right: 15px;z-index: 9;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Member Notification Sent.</div>';		
		wp_send_json($response);

		die();
	}


	function add_event(){
		$response = false;

	    if ( ! isset( $_POST['nonce_field'] )  || ! wp_verify_nonce( $_POST['nonce_field'], 'add_event_nonce') ) {
	 	        exit('The form is not valid'); 
	    }

	    if( $_POST['userID'] = "" || $_POST['post_category'] = ""){ 
	    	$response = '<div class="alert alert-danger">ERROR: Category or Author Missing.</div>';
	    	wp_send_json($response);
	    	return;
	    }
		
	    
		$user_id = $_POST['userID'];

		$args = array(
			  'post_title'    => wp_strip_all_tags( $_POST['post_title'] ),
			  'post_content'  => $_POST['bolt_event'],
			  'post_status'   => 'publish',
			  'post_author'   => $_POST['userID'],
			  'post_category' => array( $_POST['post_category'] ),
			  'post_type'	  => 'tribe_events'
		);

		$insert = wp_insert_post($args, true);
		
		$response = '<div class="alert alert-success">Event added.</div>';		

		wp_send_json($response);

		die();
	}


	function newsletter_opt(){
		$response = false;


	    if ( ! isset( $_POST['newsletter_nonce_field'] )  || ! wp_verify_nonce( $_POST['newsletter_nonce_field'], 'newsletter_opt_nonce') ) {
	 	        exit('The form is not valid'); 
	    }

	    if( $_POST['userID'] === "" ){ 
	    	$response = '<div class="alert alert-danger">ERROR: ID Missing.</div>';
	    	wp_send_json($response);
	    	return;
	    }
		
	    $have_meta = get_user_meta( $_POST['userID'], 'newslatter', false);
	    $have_meta2 = get_user_meta( $_POST['userID'], 'global_newslatter', false);

	    if($have_meta){
			$return = update_user_meta( $_POST['userID'], 'newslatter', $_POST['newslatter'], get_user_meta( $_POST['userID'], 'newslatter', true) );
		} else {
			$return = add_user_meta( $_POST['userID'], 'newslatter', $_POST['newslatter'] );
		}

	    if($have_meta2){
			$return = update_user_meta( $_POST['userID'], 'global_newslatter', $_POST['global_newslatter'], get_user_meta( $_POST['userID'], 'global_newslatter', true) );
		} else {
			$return = add_user_meta( $_POST['userID'], 'global_newslatter', $_POST['global_newslatter'] );
		}		

		
		
		//if( !$return){
		//	$response = '<div class="alert alert-success">Error! Optin not updated.</div>';		
		//} else {
			$response = '<div class="alert alert-success">Newsletter Optin updated. Page will reload...</div>';		
		//}

		wp_send_json($response);

		die();		
	}



	function billing_phone(){
		$response = false;


	    if ( ! isset( $_POST['phone_nonce_field'] )  || ! wp_verify_nonce( $_POST['phone_nonce_field'], 'billing_phone_nonce') ) {
	 	        exit('The form is not valid'); 
	    }

	    if( $_POST['userID'] === "" ){ 
	    	$response = '<div class="alert alert-danger">ERROR: ID Missing.</div>';
	    	wp_send_json($response);
	    	return;
	    }
		
	    $have_meta = get_user_meta( $_POST['userID'], 'billing_phone', false);

	    
		update_user_meta( $_POST['userID'], 'billing_phone', $_POST['billing_phone'], get_user_meta( $_POST['userID'], 'billing_phone', true) );

		update_user_meta( $_POST['userID'], 'billing_address_1', $_POST['billing_address_1'], get_user_meta( $_POST['userID'], 'billing_address_1', true) );
		update_user_meta( $_POST['userID'], 'billing_address_2', $_POST['billing_address_2'], get_user_meta( $_POST['userID'], 'billing_address_2', true) );
		update_user_meta( $_POST['userID'], 'billing_city', $_POST['billing_city'], get_user_meta( $_POST['userID'], 'billing_city', true) );

		
		update_user_meta( $_POST['userID'], 'billing_postcode', $_POST['billing_postcode'], get_user_meta( $_POST['userID'], 'billing_postcode', true) );
		update_user_meta( $_POST['userID'], 'billing_country', $_POST['billing_country'], get_user_meta( $_POST['userID'], 'billing_country', true) );
		update_user_meta( $_POST['userID'], 'billing_state', $_POST['billing_state'], get_user_meta( $_POST['userID'], 'billing_state', true) );

		update_user_meta( $_POST['userID'], 'billing_first_name', $_POST['billing_first_name'], get_user_meta( $_POST['userID'], 'billing_first_name', true) );
		update_user_meta( $_POST['userID'], 'billing_last_name', $_POST['billing_last_name'], get_user_meta( $_POST['userID'], 'billing_last_name', true) );

		
		$response = '<div class="alert alert-success">Member details updated.</div>';		

		wp_send_json($response);

		die();		
	}	


	function userinfo_edit(){
		$response = false;

		if( !array_key_exists('newslatter', $_POST) ){
			$_POST['newslatter'] = "";
		}

		if( !array_key_exists('global_newslatter', $_POST) ){
			$_POST['global_newslatter'] = "";
		}		



		foreach($_POST as $k => $v ) {

			if( in_array($k, array('userID', 'action', 'nonce_field', '_wp_http_referer') ) ) continue;

		    $have_meta = get_user_meta( $_POST['userID'], $k, false);

		    if($have_meta){
				$return = update_user_meta( $_POST['userID'], $k, $v, get_user_meta( $_POST['userID'], $k, true) );
			} else {
				$return = add_user_meta( $_POST['userID'], $k, $v );
			}			
		}

		$response = '<div class="alert alert-success">User info updated.</div>';		

		wp_send_json($response);		

		die();
	}

    function array_sort_by_column(&$arr, $col, $dir) {
        $users_full = array();
        foreach ($arr as $key=> $row) {
            $sort_col[$key] = $row[$col];
        }

        array_multisort($users_full, $dir, $arr);
    }

	function import_members(){
		global $wpdb;
		$response = false;

		$fields = array();
		array_push($fields, $_POST['import']['ID']);
		array_push($fields, $_POST['import']['user_login']);
		array_push($fields, $_POST['import']['user_email']);
		array_push($fields, $_POST['import']['user_registered']);
		$fields = array_filter($fields);
		
        $args = array(
            'meta_key'     => 'chapter',
            'meta_value'   => $_POST['chapter'],
            'role__in'     => array('bolt_chapter_editor', 'bolt_chapter_member'),
            'count_total'  => false,
            'fields'       => $fields,
         ); 

        $users = get_users( $args );  

        $users_full = array();

        $filename = get_the_title($_POST['chapter']).'-member-'.date('Y-m-d-H_i_s').'.csv';
        $csv_file = fopen($_SERVER['DOCUMENT_ROOT']. "/wp-content/uploads/member-export/".$filename, 'w');


        if( $_POST['import']['ID'] != null ) {
        	$users_full[0]['ID'] = "User ID";
        }

        if( $_POST['import']['user_login'] != null ) {
        	$users_full[0]['user_login'] = "Username";
        }        

        if( $_POST['import']['user_email'] != null ) {
        	$users_full[0]['user_email'] = "Email";
        }               

        if( $_POST['import']['user_registered'] != null ) {	
        	$users_full[0]['user_registered'] ="Registration Date";
        }        
        
        if( $_POST['import']['fname'] != null ) {
        	$users_full[0]['fname'] = "First Name";
        }
        
        if( $_POST['import']['lname'] != null ) {
        	$users_full[0]['lname'] = "Last Name";
    	}
    	
    	if( $_POST['import']['membership'] != null ) {
        	$users_full[0]['membership'] = "Membership";
    	}

    	if( $_POST['import']['expiry'] != null ) {
            //$u->expiry =  date('F j, Y', strtotime($subs->expiration_date));
            $users_full[0]['expiry'] = "Membership Expiry";
    	}

    	if( $_POST['import']['status'] != null ) {
        	$users_full[0]['status'] = "Membership Status";
        }
        
        if( $_POST['import']['chapter'] != null ) {	
        	$users_full[0]['chapter'] = "Chapter";
        }        

 

        
        foreach($users as $u){
           
            $table = $wpdb->prefix."pms_member_subscriptions";
            $subs = $wpdb->get_row("SELECT * FROM $table WHERE `user_id` = $u->ID");   

            
            if($_POST['import']['filter1'] === "0" && $subs->status === "active") continue;
            if($_POST['import']['filter1'] === "1" && $subs->status === "Inactive") continue;
            
            if( $_POST['import']['fname'] != null ) {
            	$u->fname = get_user_meta($u->ID,'billing_first_name', true);
            }
            
            if( $_POST['import']['lname'] != null ) {
            	$u->lname = get_user_meta($u->ID,'billing_last_name', true);
        	}

        	
        	if( $_POST['import']['membership'] != null ) {
            	$u->membership = str_replace("&#8211;", "-", get_the_title($subs->subscription_plan_id) );
        	}

        	if( $_POST['import']['expiry'] != null ) {
	            //$u->expiry =  date('F j, Y', strtotime($subs->expiration_date));
	            $u->expiry =  $subs->expiration_date;
        	}

        	if( $_POST['import']['status'] != null ) {
            	$u->status = $subs->status;
            }
            
            if( $_POST['import']['chapter'] != null ) {	
            	$u->chapter = get_the_title(get_user_meta($u->ID,'chapter', true));
            }	
            array_push($users_full, (array) $u);
        }
        
        //$this->array_sort_by_column($users_full, 'ID', SORT_DESC );

	    $keys = array_column($users_full, $_POST['import']['sort_by'] );
	    $result = array_multisort($keys, SORT_DESC, $users_full);   

        foreach( $users_full as $csv_data){
        	header("Content-Type: text/csv; charset=UTF-8");
        	fputcsv($csv_file, $csv_data);
        }
		
		//print_r($users_full); exit;
        $response = '<div class="alert alert-success">CSV Generated, Download <a href="/wp-content/uploads/member-export/'.$filename.'">'.$filename.'</a></div>';
		wp_send_json($response);

		die();
	}	


}