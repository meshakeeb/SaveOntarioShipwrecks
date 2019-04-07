<?php
/**
* @package WordPress
* @subpackage wpstall
**/

$themename = "BOLT Media";
$shortname = "wlm";
$themeversion = "1.0";

/**
 * Start the engine.
 */
get_template_part( 'includes/class-ontario' );

require_once( get_template_directory() . '/functions/buoy-site-manager.php' );
require_once( get_template_directory() . '/functions/buoy-status-manager.php' );
require_once( get_template_directory() . '/functions/chapter-manager.php' );
require_once( get_template_directory() . '/functions/diver-guide-manager.php' );
require_once( get_template_directory() . '/functions/gallery-manager.php' );
require_once( get_template_directory() . '/functions/newsletter-manager.php' );
require_once( get_template_directory() . '/functions/role-manager.php' );
require_once( get_template_directory() . '/functions/shortcodes.php' );

require_once( get_template_directory() . '/admin/admin-functions.php' );
require_once( get_template_directory() . '/admin/admin-interface.php' );
require_once( get_template_directory() . '/admin/theme-settings.php' );

require_once('wp_bootstrap_navwalker.php');
require 'customization/index.php';
