<?php
/**
 * SOS PMS Plugin override
 *
 * PHP version 7.1.2
 *
 * @category Null
 * @package  SOS_PMS_Customizations
 * @author   Japol <japol69@gmail.com>
 * @license  FREE
 * @link     http://www.boltmedia.ca
 */

class BoltPMS
{

	/**
	 * Hook When registering user acf_form
	 *
	 * @param int   $user_id inserted user_id
	 * @param array $data    array pertaining to the inserted user
	 *
	 * @return null
	 */
	public static function userPostMeta($user_id = null, $data = null)
	{

		if (isset($_POST['chapter'])) {
			add_user_meta($data['user_id'], 'chapter', $_POST['chapter']);
		}

		if (isset($_POST['newslatter'])) {
			add_user_meta($data['user_id'], 'newslatter', $_POST['newslatter']);
		}

		if (isset($_POST['agree'])) {
			add_user_meta($data['user_id'], 'agree', $_POST['agree']);
		}

		if (isset($_POST['billing_city'])) {
			add_user_meta($data['user_id'], 'billing_city', $_POST['city']);
		}

		if (isset($_POST['billing_address_1'])) {
			add_user_meta($data['user_id'], 'billing_address_1', $_POST['address']);
		}

		if (isset($_POST['billing_postcode'])) {
			add_user_meta($data['user_id'], 'billing_postcode', $_POST['postalcode']);
		}

		if (isset($_POST['billing_country'])) {
			add_user_meta($data['user_id'], 'billing_country', $_POST['country']);
		}

		if (isset($_POST['billing_state'])) {
			add_user_meta($data['user_id'], 'billing_state', $_POST['Province']);
		}

		if (isset($_POST['billing_phone'])) {
			add_user_meta($data['user_id'], 'billing_phone', $_POST['Phonenumber']);
		}

		$u = new WP_User($data['user_id']);
		$u->add_role(
			str_replace(
				'-',
				'_',
				get_post_field('post_name', $_POST['chapter'])
			)
		);

		$chapter = get_the_title($_POST['chapter']);

		$chairman = BoltMediaFront::get_chapter_chair($_POST['chapter'])->data->user_email;
		$provincial_member = BoltMediaFront::get_provincial_member();

		$bulk_to = array();

		foreach ($provincial_member as $pm) {
			array_push(
				$bulk_to,
				get_userdata($pm)->user_email
			);
		}


		array_push($bulk_to, $chairman);
		array_push($bulk_to, get_option('admin_email'));

		$to = array_filter($bulk_to);


		foreach ($to as $t) {

			$newmember = get_option('email_newmember');

			$user_info = get_userdata($data['user_id']);

			$recipient = get_user_by('email', $t);

			$fname = get_user_meta($recipient->ID, 'billing_first_name',true);
			$lname = get_user_meta($recipient->ID, 'billing_last_name',true);

			$filter_search = array('{chapter}', '{name}', '{member_login}', '{member_email}');
			$filter_replace = array($chapter, $fname.' '.$lname, $user_info->user_login, $user_info->user_email);

			$subject = str_replace($filter_search, $filter_replace, $newmember['title']);
			$message = str_replace($filter_search, $filter_replace, $newmember['content']);

			$headers = null;
			$headers .= 'From: Save Ontario Shipwrecks <wordpress@saveontarioshipwrecks.ca>' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			wp_mail( $t, $subject, $message, $headers );
		}

		return $data;
	}

	/**
	 * Update family member user meta
	 *
	 * @param int $user_id inserted user_id
	 *
	 * @return null
	 */
	public static function familyPostMeta($user_id, $data)
	{

		$chapter = absint(
			get_user_meta(
				get_current_user_id(),
				'chapter',
				true
			)
		);


		add_user_meta($user_id, 'billing_first_name', $_POST['first_name']);
		add_user_meta($user_id, 'billing_last_name', $_POST['last_name']);
		add_user_meta($user_id, 'chapter', $chapter);

	}


	function cssOverride()
	{
		if (is_page(array('register')) ) {
			wp_enqueue_style('pms-override-css', get_template_directory_uri().'/customization/assets/css/register.css', null, null);
		}
	}

	function shortcodeOverride()
	{
		remove_shortcode('pms-register');
		add_shortcode('pms-register', array($this, 'registerForm'));
	}

	function pms_errors()
	{
		static $wp_errors;
		return (isset($wp_errors) ? $wp_errors : ( $wp_errors = new WP_Error(null, null, null) ));
	}

	function registerFormAfter()
	{
		$html = null;

		$html .= '<div class="form-block">';
		  $html .= '<h3>Personal Information</h3>';
			$html .= '<ul style="margin:0;padding:0">';
			  $html .= '<li class="pms-field col-sm-6"> <label for="pms_address">Address</label> <input id="pms_address" name="address" type="text" value="">'. pms_display_field_errors( pms_errors()->get_error_messages('address'), true ).'</li>';
			  $html .= '<li class="pms-field col-sm-6"> <label for="pms_city">City</label> <input id="pms_city" name="city" type="text" value=""> '. pms_display_field_errors( pms_errors()->get_error_messages('city'), true ).'</li>';
			  $html .= '<li class="pms-field col-sm-6"> <label for="pms_postalcode">Postal Code</label> <input id="pms_postalcode" name="postalcode" type="text" value=""> '. pms_display_field_errors( pms_errors()->get_error_messages('postalcode'), true ).'</li>';
			  $html .= '<li class="pms-field col-sm-6"> <label for="pms_country">Country</label> <input id="pms_country" name="country" type="text" value=""> '. pms_display_field_errors( pms_errors()->get_error_messages('country'), true ).'</li>';
			  $html .= '<li class="pms-field col-sm-6"> <label for="pms_Province">Province</label> <input id="pms_Province" name="Province" type="text" value=""> '. pms_display_field_errors( pms_errors()->get_error_messages('Province'), true ).'</li>';
			  $html .= '<li class="pms-field col-sm-6"> <label for="pms_Phonenumber">Phone Number</label> <input id="pms_Phonenumber" name="Phonenumber" type="text" value=""> '. pms_display_field_errors( pms_errors()->get_error_messages('Phonenumber'), true ).'</li>';
			$html .= '</ul>';
			$html .= '<br style="float:none;clear:both">';
		$html .= '</div>';

		$html .='<div class="form-block">';
		$html .= '<h3>Newsletters</h3>';
		$html .= '<p>Please help us fund important marine heritage projects by subscribing to the <br>electronic newsletter</p>';
		  $html .= '<div class="cbox">';
			$html .= '<input type="checkbox" name="newslatter"><label>SOS Newsletter (E-mail)</label>';
		  $html .= '</div>';
		$html .= '</div>';

		$html .='<div class="form-block">';
		  $html .='<h3>Member Information</h3>';

			$html .='<div class="row">';
			  $html .='<div class="col-sm-6">';
				$html .='<div class="custom-select">';
				  $html .='<select name="chapter">';
				  $html .='<option value="">Chapter *</option>';
					foreach( \Ontario\Choices::get_chapters() as $chapter_id => $chapter_title ){
					  $html .= '<option value="' . $chapter_id . '">' . $chapter_title . '</option>';
					}
				  $html .='</select>';
				$html .='</div>';
				$html .='<small>Select which SOS Chapter you would like to belong to. If you are unsure select Provincial.</small>';
			  $html .='</div>';
			$html .='</div>';
			$html .= pms_display_field_errors( pms_errors()->get_error_messages('chapter'), true );

		  $html .='</div>';

		  $html .='<div class="form-block">';
		  $html .='<h3>Terms</h3>';

			$html .='<div class="cbox">';
			  $html .='<input type="checkbox" name="agree">';
			  $html .='<label>I / We promise to abide by the SOS Code of Ethics *</label>';
			$html .='</div>';

			$html .='<small>The Mission of Save Ontario Shipwrecks is the preservation and promotion of marine heritage through research, conservation and education. <a href="#" class="text-uppercase fw500">CLICK HERE TO VIEW THE CODE OF ETHICS</a></small>';
			$html .= '<p>'.pms_display_field_errors( pms_errors()->get_error_messages('agree'), true ).'</p>';
		  $html .='</div>';


		echo $html;
	}

	function registerValidation()
	{
		//$field_errors = pms_errors()->get_error_messages('pms_repeat_password');

		if (!isset($_REQUEST['chapter'])
			|| empty($_REQUEST['chapter'])
			|| $_REQUEST['chapter'] === ""
		) {
			 pms_errors()->add('chapter', 'Please Select Chapter.');
		}

		if (!isset($_REQUEST['agree'])
			|| empty($_REQUEST['agree'])
			|| $_REQUEST['agree'] === ""
		) {
			 pms_errors()->add('agree', 'You must agree to abide by the SOS Code of Ethics.');
		}


		if (!isset($_REQUEST['address'])
			|| empty($_REQUEST['address'])
			|| $_REQUEST['address'] === ""
		) {
			 pms_errors()->add('address', 'Address is required.');
		}

		if (!isset($_REQUEST['city'])
			|| empty($_REQUEST['city'])
			|| $_REQUEST['city'] === ""
		) {
			 pms_errors()->add('city', 'City is required.');
		}

		if (!isset($_REQUEST['postalcode'])
			|| empty($_REQUEST['postalcode'])
			|| $_REQUEST['postalcode'] === ""
		) {
			 pms_errors()->add('postalcode', 'Postal Code is required.');
		}

		if ( !isset($_REQUEST['country'])
			|| empty($_REQUEST['country'])
			|| $_REQUEST['country'] === ""
		) {
			 pms_errors()->add('country', 'Country is required.');
		}

		if (!isset($_REQUEST['Province'])
			|| empty($_REQUEST['Province'])
			|| $_REQUEST['Province'] === ""
		) {
			 pms_errors()->add('Province', 'Province is required.');
		}

		if (!isset($_REQUEST['Phonenumber'])
			|| empty($_REQUEST['Phonenumber'])
			|| $_REQUEST['Phonenumber'] === ""
		) {
			 pms_errors()->add('Phonenumber', 'Phone number is required.');
		}


	}



	function pmsUserTable( $columns )
	{
		$columns['pms_status'] = 'PMS Status';
		return $columns;
	}


	function pmsTableRow( $val, $column_name, $user_id )
	{
		switch ($column_name) {
		case 'pms_status' :
			global $wpdb;
			$table = $wpdb->prefix."pms_member_subscriptions";
			$subs = $wpdb->get_row("SELECT * FROM $table WHERE `user_id` = $user_id");
			return $subs->status;
			break;
		default:
		}
		return $val;
	}
}
