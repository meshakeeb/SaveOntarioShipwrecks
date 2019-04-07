<?php

function spam_cleanup() {
	global $wpdb;

	$args = array(
		'role'         => 'subscriber',
		'meta_key'     => '',
		'meta_value'   => '',
		'meta_compare' => '',
		'meta_query'   => array(),
		'date_query'   => array(),
		'orderby'      => 'ID',
		'order'        => 'DESC',
	 );

	$members = get_users( $args );
	$output = null;
	ob_start();
	$output .= '<div id="jlog" style="width: 300px; height: 300px; position: fixed; bottom: 0px; right: 0; padding:15px; background: #000; color: #fff; overflow-y: scroll; font: 12px Arial; z-index: 9999;" >';

	$output .= '<div align="right"><a href="#" onclick="(function(){ jQuery(\'#jlog\').hide(\'fast\'); return false;  })()">Close this</a></div>';
	$output .= '<ol>';
	$ctr = 0;
	foreach($members as $member){
		$subscription =  $wpdb->get_row( "SELECT * FROM `{$wpdb->prefix}pms_member_subscriptions` WHERE `user_id`= $member->ID", OBJECT );


		if( $subscription && $subscription->status === "pending" && ( strtotime($subscription->start_date) < strtotime( '-5 days' ) ) ){
			$output .= '<li>';

			$payments = pms_get_payments( array( 'user_id' => $member->ID ));

			foreach( $payments as $payment ){
				$payment->remove();
			}

			require_once(ABSPATH.'wp-admin/includes/user.php');
			wp_delete_user( $member->ID );

			$args = array (
				'numberposts' => -1,
				'post_type'   => 'attachment',
				'author'      => $member->ID,
				'fields'      => array( 'ID' ),
			);

			$attachments = get_posts( $args );

			foreach ( $attachments as $attachment ) {
				wp_delete_attachment( $attachment->ID, true );
			}


			$output .= $member->user_login .' subscribed on <br>'. $subscription->start_date .' deleted.';
			$output .= '</li>';
			ob_flush();
			$ctr++;
		} else {
			continue;
		}

	}
	$output .= '</ol>';
	$output .= '</div>';

	if($ctr > 0) {
		echo $output;
	}

	ob_flush();
	ob_end_flush();
}


$bolt_user = wp_get_current_user();
if ( is_user_logged_in() && (in_array("provincial", $bolt_user->roles) || in_array("administrator", $bolt_user->roles)) ) {
   add_action('init', 'spam_cleanup', 99 );
}
