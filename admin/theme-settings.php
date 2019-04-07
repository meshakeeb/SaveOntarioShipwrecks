<?php
add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){

global $themename, $shortname;

//Populate the options array
global $tt_options;
$tt_options = get_option('of_options');

/*-----------------------------------------------------------------------------------*/
/* Create The Custom Site Options Panel
/*-----------------------------------------------------------------------------------*/
$options = array(); // do not delete this line - sky will fall


/*
#############################
####General Theme Options####
#############################
*/

$options[] = array( "name" => __('General','wpstall'),
			"type" => "heading");

$options[] = array( "name" => __('General Site Options','wpstall'),
			"desc" => "",
			"std" => __("Set the general site options.","wpstall"),
			"type" => "info");

$options[] = array( "name" => __('Favicon','wpstall'),
			"desc" => __('Upload a 16px x 16px image that will represent your website\'s favicon.<br /><br /><em>To ensure cross-browser compatibility, we recommend converting the favicon into .ico format before uploading. (<a href="http://www.favicon.cc/">www.favicon.cc</a>)</em>','wpstall'),
			"id" => $shortname."_favicon",
			"std" => "",
			"type" => "upload");

/*
#############################
####Header Theme Options####
#############################
*/

$options[] = array( "name" => __('Header','wpstall'),
			"type" => "heading");

$options[] = array( "name" => __('Header Site Options','wpstall'),
			"desc" => "",
			"std" => __("Set the header site options.","wpstall"),
			"type" => "info");

$options[] = array( "name" => __('Website Logo','wpstall'),
			"desc" => __('Upload a custom logo for your site.','wpstall'),
			"id" => $shortname."_logo",
			"std" => "",
			"type" => "upload");

/*
#############################
#######Footer Options########
#############################
*/
$options[] = array( "name" => __('Footer','wpstall'),
			"type" => "heading");

$options[] = array( "name" => __('Footer Logo','wpstall'),
			"id" => $shortname."_footer_logo",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('Copyright','wpstall'),
			"id" => $shortname."_copyright",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Location','wpstall'),
			"id" => $shortname."_location",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Phone','wpstall'),
			"id" => $shortname."_phone",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Email','wpstall'),
			"id" => $shortname."_email",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Disclaimer','wpstall'),
			"id" => $shortname."_disclaimer",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Tracking Code','wpstall'),
			"desc" => __('Paste Google Analytics (or other) tracking code here. <br /><br />Need Help? Click <a href="http://www.google.com/support/analytics/bin/answer.py?hl=en&answer=55603" target="_blank">here</a>.','wpstall'),
			"id" => $shortname."_tracking_code",
			"std" => "",
			"type" => "textarea");



/*
#############################
#######Social Options########
#############################
*/
$options[] = array( "name" => __('Social Media','wpstall'),
			"type" => "heading");

$options[] = array( "name" => __('Facebook','wpstall'),
			"id" => $shortname."_facebook",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Instagram','wpstall'),
			"id" => $shortname."_instagram",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Linked In','wpstall'),
			"id" => $shortname."_linkedin",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Twitter','wpstall'),
			"id" => $shortname."_twitter",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('YouTube','wpstall'),
			"id" => $shortname."_youtube",
			"std" => "",
			"type" => "text");





update_option('of_template',$options);
update_option('of_themename',$themename);
update_option('of_shortname',$shortname);

}
}
?>
