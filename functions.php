<?php
/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @since        1.0.0
 * @package      Munipay
 * @link         http://http://boltmedia.ca
 * @copyright    Copyright (C) 2018, BoltMedia - info@boltmedia.ca
 */
defined( 'ABSPATH' ) || exit;

/**
 * @package WordPress
 * @subpackage wpstall
 **/

$themename    = 'BOLT Media';
$shortname    = 'wlm';
$themeversion = '1.0';

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
