<?php
/*
 * Template Name: Dashboard
 */
global $wpdb;
$current_user = wp_get_current_user();
$username     = $current_user->user_login;
$user_id      = $current_user->ID;

if ( is_page( array( 'user-gallery', 'add-event', 'add-buoy-status' ) ) ) {
	acf_form_head();
}

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		if ( is_user_logged_in() ) {
			$subscriptions   = $wpdb->get_row( "SELECT subscription_plan_id, start_date, expiration_date, status, payment_profile_id FROM {$wpdb->prefix}pms_member_subscriptions WHERE user_id = $user_id", ARRAY_A );
			$expiration_date = $subscriptions['expiration_date'];
			if ( time() > strtotime( $expiration_date ) ) {
				require locate_template( 'templates/dashboard-expired.php' );
			} elseif ( \Ontario\Subscription::is_family_member( $current_user->ID ) ) {
				require locate_template( 'templates/dashboard-family-member.php' );
			} else {
				require locate_template( 'templates/dashboard-active.php' );
			}
		}
	endwhile;
endif;

get_footer();
