<?php
/*
 * This file contains front end matters
 */
add_shortcode('dashboard', [BoltMediaFront::class, 'dashboard_shortcode']);

class BoltMediaFront {

	public function __construct()
	{
		//make $wpdb accessible to all functions/methods
		//global $wpdb;
		//$this->db = $wpdb;
		//set plugin directory path
		//$this->plugin_path = dirname(__DIR__);

	}

	/***********************
	 * REDIRECT CHAPTER EDITOR/MEMBER TO CUSTOM PAGES
	 */
	function login_redirect( $url, $request, $user )
	{
		if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
			if( $user->has_cap( 'bolt_chapter_editor') || $user->has_cap( 'bolt_chapter_member') ) {
				$url = home_url('/dashboard/');
			}
		}
		return $url;
	}



	/***********************
	 REDIRECT on LOGOUT
	 ************************/
	function logout_redirect()
	{
	  wp_redirect(  home_url() );
	  exit();
	}

	/***********************
	FORCE TO ALWAYS CHOOSE FULL SIZE IN IMAGE UPLOADER
	************************/
	public static function default_image_size()
	{
		return 'full';
	}

	/***********************
	SHORTCODES
	************************/
	public static function dashboard_shortcode( $atts )
	{
		if( !is_user_logged_in() ) {
		  echo 'You need to be logged in to access this page';
		  return;
		}

		if ( ! is_array($atts) ) return;
		$field = $atts[0];

		$bolt_user = wp_get_current_user();

		//echo '<pre>'; print_r($bolt_user); echo '</pre>';

		if ( ! $bolt_user->data->ID ) return 'Invalid User ID.';
		//if ( @$bolt_user->data->chapter === null) return 'You are not a member of any Chapter';

		$bolt_user->data->first_name = get_user_meta($bolt_user->ID,'billing_first_name',true);
		$bolt_user->data->last_name = get_user_meta($bolt_user->ID,'billing_last_name',true);

		$bolt_user->data->chapter = get_user_meta($bolt_user->ID,'chapter',true);
		$bolt_user->data->facebook = get_user_meta($bolt_user->ID,'facebook',true);
		$bolt_user->data->twitter = get_user_meta($bolt_user->ID,'twitter',true);
		$bolt_user->data->googleplus = get_user_meta($bolt_user->ID,'googleplus',true);
		$bolt_user->data->_profile_picture = get_user_meta($bolt_user->ID,'_profile_picture',true);
		$bolt_user->data->_mycode = get_user_meta($bolt_user->ID,'_mycode',true);

		return call_user_func("BoltMediaFront::get_dashboard_$field", $bolt_user);

	}

	public static function get_dashboard_usergallery($user_info)
	{
		remove_action('save_post', 'add_buoysite_fields');
		remove_action('save_post', 'add_buoystatus_fields');
		remove_action('save_post', 'add_chapter_fields');
		remove_action('save_post', 'add_diverguide_fields');
		remove_action('save_post', 'add_gallery_fields');
		remove_action('save_post', 'add_newsletter_fields');
		remove_action('save_post', 'add_memberrole_fields');
		require ( get_theme_file_path().'/customization/views/dashboard-user-gallery.php');
	}


	public static function get_dashboard_moderatePhotos($user_info)
	{
		//print_r($user_info); exit;
		if( in_array("provincial_membership", $user_info->roles) || in_array("administrator", $user_info->roles) ){
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$photos = BoltMediaFront::getGalleries( array('posts_per_page' => 10, 'post_status' => 'any', 'paged' => $paged ) );
			require ( get_theme_file_path().'/customization/views/dashboard-moderate-photos.php');
		} else {
			return "ERROR: Photo Moderation is for Provincial and Administrator only.";
		}
	}

	/**
	 * Fetch email templates from options table
	 *
	 * @param array $user_info informatiob about the user
	 *
	 * @return null
	 */
	public static function get_dashboard_email_templates($user_info)
	{

		if (
			$user_info->has_cap( 'edit_email_templates' ) ||
			in_array( 'provincial_membership', $user_info->roles) ||
			in_array( 'administrator', $user_info->roles )
		) {

			if (@$_POST['action'] === "email_template") {
				BoltMediaFront::saveMailTemplate($_POST);
			}

			$newmember = get_option('email_newmember');
			$family = get_option('email_family');
			$newpost = get_option('email_newpost');
			$newbuoy =  get_option('email_newbuoy');
			$badges = get_option('email_badges');
			$renewal = get_option('email_renewal');
			$reminder = get_option('email_reminder');
			$news = get_option('email_news');
			$permission = get_option('email_permission');
			$pms =  get_option('pms_settings');

		} else {
			return "ERROR: Email template editing is for Provincial and Administrator only.";
		}

		include get_theme_file_path().'/customization/views/dashboard-email_templates.php';
	}


	/**
	 * Saving Email Template/s
	 *
	 * @param array $data $_POST data
	 *
	 * @return null
	 */
	public static function saveMailTemplate($data)
	{

		$pms =  get_option('pms_emails_settings');

		$pms_new = array();
		foreach ( $data['template'] as $k => $v ) {
			switch ($k) {
			case "pms_activate":
				$pms_new['activate_sub_subject'] = $_POST['template'][$k]['title'];
				$pms_new['activate_sub'] = $data[$k];
				break;
			case "pms_cancel":
				$pms_new['cancel_sub_subject'] = $_POST['template'][$k]['title'];
				$pms_new['cancel_sub'] = $data[$k];
				break;
			case "pms_expired":
				$pms_new['expired_sub_subject'] = $_REQUEST['template'][$k]['title'];
				$pms_new['expired_sub'] = $data[$k];
				break;
			case "pms_register":
				$pms_new['register_sub_subject'] = $_POST['template'][$k]['title'];
				$pms_new['register_sub'] = $data[$k];
				break;
			default:
				$option = array(
					'title' => $_POST['template'][$k]['title'],
					'content' => $data[$k]
				);
				update_option('email_'.$k, $option);
			}
		}
		$pms_final = array_merge($pms, $pms_new);

		wp_cache_delete('alloptions', 'options');
		update_option('pms_emails_settings', $pms_final);
	}


	public static function get_dashboard_profile($user_info)
	{
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('thickbox');
		$profilePic = get_the_author_meta('bolt_profilePic', $user_info->ID);
		add_filter( 'pre_option_image_default_size', BoltMediaFront::default_image_size() );


		global $wpdb;
		$date =  $wpdb->get_row("SELECT `expiration_date` FROM `{$wpdb->prefix}pms_member_subscriptions` WHERE `user_id`= $user_info->ID", OBJECT);
		$expiration = (count($date) > 0 ) ? date('F j, Y', strtotime($date->expiration_date ) ) : "N/A";

		$card_args = array(
			'ID'    => $user_info->ID,
			'fname' => $user_info->first_name,
			'lname' => $user_info->last_name,
			'chapter' => get_the_title( $user_info->chapter ),
			'expiry' => $expiration,
		);
		$badge = BoltImage::PDFBadge($card_args);
		require ( get_theme_file_path().'/customization/views//dashboard-profile.php');
	}

	public static function get_dashboard_buoystatus($user_info)
	{
		if( in_array("administrator", $user_info->roles) ) {
			require ( get_theme_file_path().'/customization/views/dashboard-buoystatus.php');
		} else {
			echo '<h3>You are not allowed to add buoy status.</h3>';
		}
	}

	public static function get_dashboard_members($user_info)
	{

		if( in_array("provincial_membership", $user_info->roles) || in_array("administrator", $user_info->roles) ){
			$chapter = @$_GET['chapter'];
		} else {
			$chapter = $user_info->chapter;
		}

		$args = array(
			'meta_key'     => 'chapter',
			'meta_value'   => $chapter,
			'role__in'     => array('bolt_chapter_editor', 'bolt_chapter_member'),
			'orderby'      => 'name',
			'order'        => 'ASC',
			'count_total'  => false,
			'fields'       => 'all',
			'exclude'      => array($user_info->ID),
		 );
		$users = get_users( $args );
		require ( get_theme_file_path().'/customization/views//dashboard-members.php');
	}


	/**
	 * Shortcode :: Events Page
	 *
	 * @param array $user_info - current user info (ID, chapter etc)
	 *
	 * @return string message
	 */
	public static function get_dashboard_event($user_info)
	{

		if ($user_info->has_cap('publish_tribe_events')
			|| in_array("provincial_membership", $user_info->roles)
			|| in_array("administrator", $user_info->roles)
		) {

			if (@$_POST['action'] === "add_event") {
				//BoltMediaFront::addEvent($_POST);
			} else if (@$_POST['action'] === "edit_event" ) {
				BoltMediaFront::EditEvent($_POST);
			}

			$category = get_term_by(
				'name',
				get_the_title($user_info->chapter),
				"tribe_events_cat"
			);

			if (!$category) {
				$message = null;
				$message .= '<div class="alert alert-warning">';
				$message .= 'Cannot Post Event. No Event category found for ';
				$message .= get_the_title($user_info->chapter);
				$message .= '</div>';
				return $message;
			}

			include get_theme_file_path().'/customization/views/dashboard-event.php';

		} else {
			return "<h3>You are not allowed to add an Event</h3>";
		}
	}


	/**
	 * Custom $_GET params
	 *
	 * @param array $data - $_POST data from the add events form
	 *
	 * @return string message
	 */
	public static function addEvent($data)
	{

		remove_action('save_post', 'my_project_updated_send_email', 10);

		if (!isset($data['nonce_field'])
			|| !wp_verify_nonce($data['nonce_field'], 'add_event_nonce')
		) {
			exit('The form is not valid');
		}

		$message = null;

		if ($data['post_title'] === ""
			|| $data['userID'] === ""
			|| $data['post_category'] === ""
		) {
			$message .= '<div class="alert alert-danger">';
			$message .= 'ERROR: Title or Chapter is Missing.';
			$message .= '</div>';

		} else {

			$user_id = $data['userID'];

			$args = array(
				  'post_title'    => wp_strip_all_tags($data['post_title']),
				  'post_content'  => $data['bolt_event'],
				  'post_status'   => 'publish',
				  'post_author'   => $_POST['userID'],
				  'post_type'     => 'tribe_events',
					'meta_input' => array(
						'_EventStartDate' => $data['eventstart_date'].' '.$data['eventstart_time'],
						'_EventEndDate' => $data['eventend_date'].' '.$data['eventend_time']
					)
			);
			$insert = wp_insert_post($args);

			if ($insert != 0) {
				flush_rewrite_rules();
				wp_set_object_terms($insert, $_POST['post_category'], 'tribe_events_cat');
				$message .= '<div class="alert alert-success">';
				$message .= 'Event Updated. ';
				$message .= '<a href="'.get_permalink($insert).'">View<a>';
				$message .= '</div>';
			}

		}

		return $message;

	}


	public static function EditEvent($data)
	{

		remove_action( 'save_post', 'my_project_updated_send_email', 10);

		if ( ! isset( $data['nonce_field'] )  || ! wp_verify_nonce( $data['nonce_field'], 'add_event_nonce') ) {
				exit('The form is not valid');
		}

		if( $data['post_title'] === "" || $data['userID'] === "" || $data['post_category'] === "") {

			echo '<div class="alert alert-danger">ERROR: Title or Chapter is Missing.</div>';

		} else {

			$args = array(
				  'ID'            => $_GET['post'],
				  'post_title'    => wp_strip_all_tags( $data['post_title'] ),
				  'post_content'  => $data['bolt_event'],
				  'post_status'   => 'publish',

					'meta_input' => array(
						'_EventStartDate' => $data['eventstart_date'].' '.$data['eventstart_time'],
						'_EventEndDate' => $data['eventend_date'].' '.$data['eventend_time']
					)
			);


			$insert = wp_update_post($args);

			if($insert != 0){
				flush_rewrite_rules();
				wp_set_object_terms( $insert, $_POST['post_category'], 'tribe_events_cat' );
				echo '<div class="alert alert-success">Event Added. <a href="'.get_permalink($insert).'">View<a></div>';
			}

		}


	}


	public static function get_dashboard_news($user_info)
	{

		if( !$user_info->has_cap('publish_chapters') ) return "<h3>You are not allowed to add news.</h3>";
		//remove_action('media_buttons', 'media_buttons');

		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		add_filter( 'pre_option_image_default_size', array('BoltMediaFront', 'default_image_size') );

		if( @$_POST['action'] === "add_news") {
			BoltMediaFront::AddNews($_POST);
		}

		$category = get_term_by('name', get_the_title($user_info->chapter), "category");
			if(!$category) return '<div class="alert alert-warning">Cannot Post Event. No Event category found for '.get_the_title($user_info->chapter).'</div>';
		require ( get_theme_file_path().'/customization/views//dashboard-news.php');
	}

	public static function AddNews($data)
	{
		//print_r($data); exit;
		remove_action( 'save_post', 'my_project_updated_send_email', 10);

		if ( ! isset( $data['nonce_field'] )  || ! wp_verify_nonce( $data['nonce_field'], 'add_event_nonce') ) {
				exit('The form is not valid');
		}

		if( $data['post_title'] === "" || $data['userID'] === "" || $data['post_category'] === "" || $data['content_type'] === "" ) {

			echo '<div class="alert alert-danger">ERROR: Title, Content Type or Chapter is Missing.</div>';

		} else {

			$user_id = $data['userID'];


			$categories = ( $data['content_type'] === "post") ? $_POST['post_category'] : "News";


			$args = array(
				  'post_title'    => wp_strip_all_tags( $data['post_title'] ),
				  'post_content'  => $data['bolt_news'],
				  'post_status'   => 'publish',
				  'post_author'   => $_POST['userID'],
				  'post_category' => $categories,
				  'post_type'     => 'post',
			);

			$insert = wp_insert_post($args);

			if($insert != 0){
				set_post_thumbnail( $insert, $data['j_photo'] );
				flush_rewrite_rules();
				wp_set_object_terms( $insert, array($categories), 'category' );

				$subfields = array();
				if( $_POST['j_attachment'] && count($_POST['j_attachment']) > 0 ){
					foreach( $_POST['j_attachment'] as $k => $v ){
						array_push($subfields, array( 'multi_attachment' => $v) );
					}
				}
				$value = array( $subfields );
				update_field( 'attachments', $subfields, $insert );

				update_field( 'add_multiple_attachments', array(1), $insert );

				echo '<div class="alert alert-success">News Added. <a href="'.get_permalink($insert).'">View<a></div>';
			}

		}




	}


	public static function get_dashboard_newsletter($user_info)
	{

		if (
			in_array("provincial_membership", $user_info->roles)
			|| in_array("administrator", $user_info->roles)
			|| in_array("bolt_chapter_editor", $user_info->roles)
			|| ( in_array("bolt_chapter_member", $user_info->roles) && $user_info->has_cap( 'send_newsletter') )
		) {
			//remove_action('media_buttons', 'media_buttons');

			$category = get_the_title($user_info->chapter);

			if( @$_POST['action'] === "send_to_members") {
				BoltMediaFront::AddNewsletter($_POST);
			}

			require ( get_theme_file_path().'/customization/views//dashboard-newsletter.php');

		} else {
			echo '<h3>You are not allowed to send newsletter</h3>'; return;
		}


	}


	public static function get_dashboard_management($user_info)
	{

		if( !$user_info->has_cap( 'manage_chapter_members') ) return "<h3>You are not allowed to manage members</h3>";

		if(  in_array("provincial_membership", $user_info->roles) || in_array("administrator", $user_info->roles) ){
			$chapter = ( isset($_GET['chapter']) ) ? $_GET['chapter'] : $user_info->chapter;
		} else {
			$chapter = $user_info->chapter;
		}

		//print_r($user_info); exit;

		add_action('wp_footer',BoltMediaFront::TableSort(),10);

		$args = array(

			'meta_key'     => 'chapter',
			'meta_value'   => $chapter,
			'role__in'     => array('bolt_chapter_editor', 'bolt_chapter_member'),
			'orderby'      => 'name',
			'order'        => 'ASC',
			'count_total'  => false,
			'fields'       => 'all',
			//'exclude'      => array($user_info->ID),
		 );
		$users = get_users( $args );

		require ( get_theme_file_path().'/customization/views//dashboard-manage.php');
	}

	public static function AddNewsletter($data)
	{

		if ( ! isset( $data['nonce_field'] )  || ! wp_verify_nonce( $data['nonce_field'], 'add_event_nonce') ) exit('The form is not valid');


		if( $data['userID'] = "" || $data['post_category'] = ""){
			$response = '<div class="alert alert-danger">ERROR: Category or Author Missing.</div>';
			return $response;
		}



		global $wpdb;
		$table = $wpdb->prefix."pms_member_subscriptions";


		if( isset($_POST['non_subscribers']) && $_POST['non_subscribers'] === "1"){
			$subscribers = array();
		} else {
			$subscribers =  array(
								'key' => 'newslatter',
								'value' => 'on',
								'compare' => '='
							);
		}

		$exclude = ( isset($_POST['send_me']) && $_POST['send_me'] === "1") ? null : array($_POST['userID']) ;

		if( isset($_POST['include']) ) {

			$args = array(
				'meta_query' => array(
					array(
						'key' => 'chapter',
						'value' => ( $_POST['post_category'] === "all" ) ? '' : $_POST['post_category'],
						'compare' => ( $_POST['post_category'] === "all" ) ? '!=' : '='
					),
					$subscribers
				),

				'orderby'      => 'name',
				'order'        => 'ASC',
				'count_total'  => false,
				'fields'       => 'all',
				'exclude'      => $exclude
			 );

		} else {


			$args = array(
				'meta_query' => array(
					array(
						'key' => 'chapter',
						'value' => $_POST['post_category'],
						'compare' => '='
					),
					$subscribers
				),

				'orderby'      => 'name',
				'order'        => 'ASC',
				'count_total'  => false,
				'fields'       => 'all',
				'exclude'      => $exclude
			 );
		}

		$users = get_users( $args );


		$to = array();
		foreach ($users as $u) {
			$subs = $wpdb->get_row("SELECT * FROM $table WHERE `user_id` = $u->ID");

			if( !in_array( $subs->status, $_POST['members_status']) || get_the_title ( get_user_meta($u->ID,'chapter',true) ) === "" ) continue;

			array_push($to, $u->user_email);
		}

		//print_r($to);

		$headers = null;
		$headers .= 'From: Save Ontario Shipwrecks <wordpress@saveontarioshipwrecks.ca>' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		 $mail = wp_mail( $to, $_POST['post_title'], $_POST['bolt_newsletter'], $headers );

		 if($mail){
			echo '<div class="alert alert-success">Newsletter Sent</div>';
		 } else {
			echo '<div class="alert alert-danger">ERROR: Mail Not Sent!</div>';
		 }



	}

	public static function get_dashboard_chapters($user_info)
	{

		if( !$user_info->has_cap( 'edit_chapters') ) return "<p>You are not allowed to manage chapters</p>";

		require ( get_theme_file_path().'/customization/views//dashboard-chapters.php');
	}

	public static function get_dashboard_userinfo($user_info)
	{

		if( !$user_info->has_cap( 'manage_chapter_members') ) return "<p>You are not allowed to edit member info</p>";

		if( !isset($_GET['u']) ) return "<p>Invalid user ID</p>";

		if( in_array("provincial_membership", $user_info->roles) || in_array("administrator", $user_info->roles) ) {
			/*do something*/
		} else {
			if ( $user_info->chapter !== get_user_meta( $_GET['u'], 'chapter', true)  ) return "You can only edit members of your chapter";
		}



		$userinfo_meta = get_user_meta($_GET['u']);

		require ( get_theme_file_path().'/customization/views/dashboard-userinfo.php');
	}

	/**
	 * Attach datepicker assets
	 *
	 * @return none
	 */
	public static function datePicker()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_style(
			'jquery-ui-css',
			'//ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css'
		);
	}

	public static function TableSort()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_style('table-sort', get_stylesheet_directory_uri().'/customization/assets/tablesorter-master/dist/css/theme.default.min.css');
		wp_enqueue_script('table-sort-js', get_stylesheet_directory_uri().'/customization/assets/tablesorter-master/dist/js/jquery.tablesorter.min.js');
	}

	public static function RemoveMediaUpload()
	{
		add_action( 'media_buttons_context' , create_function('', 'return;') );
	}


	public static function acf_filter_users( $args, $field, $post_id )
	{
		$chapter = get_user_meta( get_current_user_id() , 'chapter', true );
		if( !current_user_can('administrator') ) :
			$args['meta_key'] = 'chapter';
			$args['meta_value'] = $chapter;
		endif;
			return $args;

	}

	public static function acf_filter_commitee( $args, $field, $post_id )
	{
		$chapter = get_user_meta( get_current_user_id() , 'chapter', true );
		if( !current_user_can('administrator') ) :
			$args['post__in'] = array($chapter);
		endif;
		return $args;
	}



	function exclude_menu_items( $items, $menu, $args )
	{

		if($menu->slug === "account"){

			$bolt_user = wp_get_current_user();
			foreach ( $items as $key => $item ) {
				if ( $item->ID === 3815 && !$bolt_user->has_cap('send_newsletter')  ){
					unset( $items[$key] );//newsletter
				}

				if ( $item->ID === 3511 && !$bolt_user->has_cap('publish_buoy_status')  ){
					unset( $items[$key] );//buoy status
				}

				if ( $item->ID === 3510 && !$bolt_user->has_cap('publish_buoy_site')  ){
					unset( $items[$key] );//buoy site
				}

				if ( $item->ID === 3817 && !$bolt_user->has_cap('publish_tribe_events')  ){
					unset( $items[$key] );
				}

				if ( $item->ID === 3816 && !$bolt_user->has_cap('publish_chapters')  ){
					unset( $items[$key] );
				}

				if ( $item->ID === 4250 && !$bolt_user->has_cap('publish_buoy_status')  ){
					unset( $items[$key] );
				}

				if ( $item->ID === 4249 && !$bolt_user->has_cap('publish_buoy_site')  ){
					unset( $items[$key] );
				}

			}
		}

		return $items;
	}


	public static function dropdowns($type = null)
	{
		global $wpdb;

		$dropdowns = array();
		$args = array(
			'posts_per_page'   => -1,
			'orderby'          => 'title',
			'order'            => 'ASC',
			'post_type'        => 'chapters',
			'post_status'      => 'publish',
			'suppress_filters' => true,
		);
		$dropdowns['chapters'] = get_posts( $args );

		$args = array(
			'posts_per_page'   => -1,
			'orderby'          => 'title',
			'order'            => 'ASC',
			'post_type'        => 'buoysites',
			'post_status'      => 'publish',
			'suppress_filters' => true,
		);
		$dropdowns['sites'] = get_posts( $args );

		$dropdowns['ships'] = $wpdb->get_results( 'SELECT DISTINCT `meta_value` FROM '.$wpdb->prefix.'postmeta WHERE `meta_key`="ship" ORDER BY `meta_value` ASC' );
		$dropdowns['authors'] = $wpdb->get_results( 'SELECT DISTINCT `meta_value` FROM '.$wpdb->prefix.'postmeta WHERE `meta_key`="photo_author" ORDER BY `meta_value` ASC' );
		$dropdowns['waters'] = $wpdb->get_results( 'SELECT DISTINCT `field_bodywater_value` FROM content_type_buoy ORDER BY `field_bodywater_value` ASC' );

		return $dropdowns;

	}


	/* Disable admin bar except for superadmin account */
	function admin_bar()
	{
		if (!current_user_can('administrator') && !is_admin()) {
		  show_admin_bar(false);
		}
	}


	public static function get_chapter_chair($chapter)
	{
		$args = array(
			'meta_query' => array(
				array(
					'key' => 'committee',
					'value' => $chapter
				),
				array(
					'key' => 'role',
					'value' => 'committee_chair'
				),
			),
			'post_type' => 'memberroles',
			'post_status' => 'publish',
			'posts_per_page' => 1
		);
		$post = get_posts($args);

		$chairman = get_userdata (get_post_meta($post[0]->ID, 'member', true) );

		return $chairman;
	}

	public static function get_chapter_treasurer($chapter)
	{
		$args = array(
			'meta_query' => array(
				array(
					'key' => 'committee',
					'value' => $chapter
				),
				array(
					'key' => 'role',
					'value' => 'committee_treasurer'
				),
			),
			'post_type' => 'memberroles',
			'post_status' => 'publish',
			'posts_per_page' => 1
		);
		$post = get_posts($args);

		if(!empty($post)) {
			$treasurer = get_userdata (get_post_meta($post[0]->ID, 'member', true) );
		} else {
			$treasurer = null;
		}



		return $treasurer;
	}

	public static function get_chapter_secretary($chapter)
	{
		$args = array(
			'meta_query' => array(
				array(
					'key' => 'committee',
					'value' => $chapter
				),
				array(
					'key' => 'role',
					'value' => 'committee_secretary'
				),
			),
			'post_type' => 'memberroles',
			'post_status' => 'publish',
			'posts_per_page' => 1
		);
		$post = get_posts($args);

		if(!empty($post)) {
			$secretary = get_userdata (get_post_meta($post[0]->ID, 'member', true) );
		} else {
			$secretary = null;
		}

		return $secretary;
	}

	public static function get_chapter_buoys($chapter)
	{
		$args = array(
			'meta_query' => array(
				array(
					'key' => 'committee',
					'value' => $chapter
				),
				array(
					'key' => 'role',
					'value' => 'committee_buoys'
				),
			),
			'post_type' => 'memberroles',
			'post_status' => 'publish',
			'posts_per_page' => 1
		);
		$post = get_posts($args);

		if(!empty($post)) {
			$buoys = get_userdata (get_post_meta($post[0]->ID, 'member', true) );
		} else {
			$buoys = null;
		}

		return $buoys;
	}


	public static function get_chapter_officers($chapter)
	{
		$args = array(
			'meta_query' => array(
				array(
					'key'    => 'committee',
					'value'  => $chapter
				),
			),
			'post_type'      => 'memberroles',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC'
		);
		$post = get_posts($args);

		if(!empty($post)) {
			$officers = array();
			foreach($post as $p){
				$data = get_userdata (get_post_meta($p->ID, 'member', true) );
				$data->post_info = $p;
				//print_r($data); exit;
				array_push($officers, $data);
			}
		} else {
			$officers = null;
		}

		return $officers;
	}


	public static function getGalleries($data)
	{
		$args = array(
			'posts_per_page'   => $data['posts_per_page'],
			'offset'           => ($data['paged'] - 1)  * $data['posts_per_page'],
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'gallery',
			'post_status'      => $data['post_status'],
			'paged'            => $data['paged']
		);
		$galleries = new WP_Query( $args );

		return $galleries;
	}

	public static function RenewalLink()
	{
		global $wpdb;
		$user =  get_current_user_id();

		if( $user < 1 ) return;

		$query = "SELECT id FROM {$wpdb->prefix}pms_member_subscriptions WHERE user_id = ".get_current_user_id()."";
		$subscription = $wpdb->get_results($query, ARRAY_A);


		$url = site_url().'/dashboard/manage-membership/?pms-action=edit_payment&subscription_id='.$subscription[0]['id'];

		return $url;
	}


	public static function get_provincial_member()
	{

		$args = array(
			'role__in'     => array('provincial_membership'),
			'orderby'      => 'name',
			'order'        => 'ASC',
			'count_total'  => false,
			'fields'       => 'ID',
			//'exclude'      => array($user_info->ID),
		 );
		$provincial = get_users( $args );

		return $provincial;

	}

	public static function membersWithGallery()
	{

		$args = array(
			'posts_per_page'   => -1,
			'post_type'        => 'bolt_user_gallery',
			'post_status'      => 'publish',
			'suppress_filters' => true,
			'fields'           => '',
		);
		$members = get_posts( $args );

		$member_all = array();
		foreach($members as $member){
			array_push( $member_all, $member->post_author);
		}

		return array_unique($member_all);
	}

	/**
	 * Test comment
	 *
	 * @return some_data
	 */
	function testCase()
	{
		echo "test";
	}

}//end of class
