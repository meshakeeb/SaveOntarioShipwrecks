<?php
/* Template Name: Dashboard
*/
global $shortname;
$current_user = wp_get_current_user();
$username = $current_user->user_login;
$user_id = $current_user->ID;

if( is_page( array('user-gallery', 'add-event', 'add-buoy-status')) ){
	acf_form_head();
}

get_header(); ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php
global $wpdb;
if ( is_user_logged_in() ) {

$subscriptions = $wpdb->get_row( "SELECT subscription_plan_id, start_date, expiration_date, status, payment_profile_id FROM {$wpdb->prefix}pms_member_subscriptions WHERE user_id = $user_id", ARRAY_A );

$expiration_date = $subscriptions['expiration_date'];

if(time() > strtotime($expiration_date)) {
?>

<?php include('templates/dashboard-expired.php'); ?>

<?php } else { ?>

<?php include('templates/dashboard-active.php'); ?>

<?php } } ?>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
