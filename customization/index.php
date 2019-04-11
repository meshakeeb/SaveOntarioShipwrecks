<?php
/**
 * SOS Customizations
 *
 * PHP version 7.1.2
 *
 * @category Null
 * @package  SOS_Customizations
 * @author   Japol <japol69@gmail.com>
 * @
 */

require 'class/class.php';
require 'class/class.frontend.php';
@require 'class/class.ajax.actions.php';
require 'class/class.image.php';
require 'class/class.pdf.php';
require 'class/class.pms-override.php';
require 'class/class.buoy.php';
require 'assets/pms_purge_expired_users/index.php';

$bolt      = new BoltMedia;
$boltFront = new BoltMediaFront;
$boltAjax  = new BoltMediaAjax;
$boltImage = new BoltImage;
$boltPDF   = new BoltPDF;
$boltPMS   = new BoltPMS;
$boltBuoy  = new BoltMediaBuoy;

//GET/LOAD ALL FUNCTION FILES @ 'customization/includes' DIRECTORY
$files = glob(get_template_directory().'/customization/includes/' . "*.php");
foreach($files as $file):
	include $file;
endforeach;

//generate post types
add_action( 'init', 'Boltmedia\\Includes\\PostTypes\\GeneratePostTypes', 10 );

add_filter( 'wp_get_nav_menu_items', array( $boltFront,'exclude_menu_items' ), 99, 3 );

add_action( 'user_new_form', array( $bolt, 'profile_fields' ) );
add_action( 'show_user_profile', array( $bolt, 'profile_fields' ) );
add_action( 'edit_user_profile', array( $bolt, 'profile_fields' ) );

add_action( 'user_register', array( $bolt, 'save_profile_fields' ), 10, 1 );

add_action( 'personal_options_update', array( $bolt, 'save_profile_fields' ) );
add_action( 'edit_user_profile_update', array( $bolt, 'save_profile_fields' ) );

add_action( 'publish_post', array( $bolt, 'new_post_notification' ) );
add_action( 'save_post', array( $bolt, 'new_post_notification' ) );

add_action( 'after_setup_theme', array( $boltFront, 'admin_bar' ) );

// AJAX.
add_action( 'wp_ajax_edit_profile', array( $boltAjax, 'update_profile' ) );
add_action( 'wp_ajax_nopriv_edit_profile', array( $boltAjax, 'deny' ) );

add_action( 'wp_ajax_edit_member', array( $boltAjax, 'update_member' ) );
add_action( 'wp_ajax_nopriv_edit_member', array( $boltAjax, 'deny' ) );

add_action( 'wp_ajax_moderate_photos', array( $boltAjax, 'moderate_photos' ) );
add_action( 'wp_ajax_nopriv_moderate_photos', array( $boltAjax, 'deny' ) );

add_action( 'wp_ajax_add_event', array( $boltAjax, 'add_event' ) );
add_action( 'wp_ajax_nopriv_add_event', array( $boltAjax, 'deny' ) );

add_action( 'wp_ajax_remind_member', array( $boltAjax, 'remind_member' ) );
add_action( 'wp_ajax_nopriv_remind_member', array( $boltAjax, 'deny' ) );

add_action( 'wp_ajax_newsletter_opt', array( $boltAjax, 'newsletter_opt' ) );
add_action( 'wp_ajax_nopriv_newsletter_opt', array( $boltAjax, 'deny' ) );

add_action( 'wp_ajax_billing_phone', array( $boltAjax, 'billing_phone' ) );
add_action( 'wp_ajax_nopriv_billing_phone', array( $boltAjax, 'deny' ) );

add_action( 'wp_ajax_userinfo_edit', array( $boltAjax, 'userinfo_edit' ) );
add_action( 'wp_ajax_nopriv_userinfo_edit', array( $boltAjax, 'deny' ) );

add_action( 'wp_ajax_import_members', array( $boltAjax, 'import_members' ) );
add_action( 'wp_ajax_nopriv_import_members', array( $boltAjax, 'deny' ) );

add_action( 'wp_ajax_exportBuoy', array( $boltBuoy, 'exportBuoy' ) );
add_action( 'wp_ajax_nopriv_exportBuoy', array( $boltAjax, 'deny' ) );

//for edit profile
add_filter( 'parse_query', array($bolt,'show_current_user_attachments' ) );

//for upload photo
add_filter(
	'ajax_query_attachments_args',
	array($bolt,'show_current_user_attachments_upload_photos'),
	10,
	1
);

// for /dashboard/create-role/ page (members)
add_filter(
	'acf/fields/user/query/key=field_5af0c052a99fc',
	array($boltFront,'acf_filter_users'),
	10,
	99
);

// for /dashboard/create-role/ page (committee)
add_filter(
	'acf/fields/post_object/query/key=field_5af1eb7c94786',
	array($boltFront,'acf_filter_commitee'),
	10,
	3
);

// for /dashboard/create-role/ page (committee)
add_filter(
	'acf/fields/post_object/query/key=field_5b1aa10babab9',
	array($boltFront,'acf_filter_commitee'),
	10,
	3
);

add_action(
	'pms_member_subscription_inserted',
	array($boltPMS,'userPostMeta'),
	1,
	2
);


add_action(
	'pms_member_subscription_inserted',
	array($boltPDF,'generatePDFArgs'),
	15,
	2
);

add_action(
	'pms_member_subscription_update',
	array($boltPDF,'generatePDFArgs2'),
	15,
	2
);

add_action('pdf_hook', array($boltPDF,'generatePDF'), 99, 2);

// PMS REGISTRATION FORM OVERRIDE
add_action('wp_enqueue_scripts', array($boltPMS,'cssOverride'), 100);
add_action('pms_register_form_bottom', array($boltPMS,'registerFormAfter'), 1);

add_action(
	'pms_register_form_validation',
	array($boltPMS,'registerValidation'),
	10,
	1
);

//ACF user-gallery after submitting new gallery
add_action('acf/save_post', 'Boltmedia\\Includes\\ACF\\acfSavePost', 99);

//wp-admin/users page to add new columns
add_filter( 'manage_users_columns', array($boltPMS, 'pmsUserTable'), 9999, 1 );
add_filter( 'manage_users_custom_column', array($boltPMS, 'pmsTableRow'), 9999, 3 );

/*
**DEBUG
**
* /japol-test-69 is for running custom hooks for debugging.
* password for this page is "japolsostest"
*/
if (is_page('japol-test-69') ) {

	global $wp_roles;
	$wp_roles->add_cap('provincial_membership', 'send_newsletter');
	$wp_roles->add_cap('administrator', 'send_newsletter');

	add_action('init', array($boltPDF,'generatePDFArgs'), 99, 1);
	add_action('pdf_hook', array($boltPDF,'generatePDF'), 10, 1);
}


/**
 * Custom $_GET params
 *
 * @param array $vars - get parameters in URL
 *
 * @var    array $vars
 * @return array
 */
function customQueryVarsFilter($vars)
{
	$vars[] .= 'edit';
	return $vars;
}
add_filter( 'query_vars', 'customQueryVarsFilter' );


add_action( 'init', function()
{
	remove_action( 'register_new_user',   'wp_send_new_user_notifications');
} );


if ( ! function_exists( 'wp_new_user_notification' ) ) :
	function wp_new_user_notification( $user_id, $deprecated = null, $notify = '' ) {
		return;
	}
endif;
