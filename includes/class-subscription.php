<?php
/**
 * The Subscription
 *
 * @since      1.0.0
 * @package    Ontario
 * @subpackage Ontario\Core
 * @author     BoltMedia <info@boltmedia.ca>
 */

namespace Ontario;

use DateTime;
use Ontario\Traits\Hooker;

defined( 'ABSPATH' ) || exit;

/**
 * Subscription class.
 */
class Subscription {

	use Hooker;

	/**
	 * The class constructor.
	 */
	public function __construct() {
		$this->action( 'pms_member_update_subscription', 'renew_family_members', 10, 6 );
		$this->action( 'pms_check_subscription_status', 'check_subscription_status' );
		$this->filter( 'pms_members_list_table_columns', 'members_list_table_columns', 10 );
		$this->filter( 'pms_members_list_table_entry_data', 'members_list_table_entry_data', 10 );
		$this->filter( 'pms_recover_password_form_password_changed_message', 'recover_password_form_password_changed_message' );
	}

	/**
	 * Renew family memebers.
	 *
	 * @param bool   $update_result
	 * @param int    $user_id
	 * @param int    $subscription_id
	 * @param string $start_date
	 * @param string $expiration_date
	 * @param string $status
	 */
	public function renew_family_members( $update_result, $user_id, $subscription_id, $start_date, $expiration_date, $status ) {
		if (
			true !== $update_result ||
			'active' !== $status ||
			! self::is_family_parent( $user_id )
		) {
			return;
		}

		$memberlist = get_users(
			[
				'meta_key'   => 'parent_family_id',
				'meta_value' => $user_id,
			]
		);

		if ( empty( $memberlist ) ) {
			return;
		}

		$this->remove_action( 'pms_member_update_subscription', 'renew_family_members' );

		foreach ( $memberlist as $user ) {
			$member = pms_get_member( $user->ID );
			$member->update_subscription( $subscription_id, $start_date, $expiration_date, $status );
		}

		$this->action( 'pms_member_update_subscription', 'renew_family_members', 10, 6 );
	}

	/**
	 * Check status if 15 days to expire send a reminder.
	 */
	public function check_subscription_status() {
		$users = $this->get_users_about_to_expire();
		if ( empty( $users ) ) {
			return;
		}

		$sender = new Emails;
		$email  = get_option( 'email_reminder' );
		$search = [ '{fname}', '{lname}', '{days}', '{expiration}', '{account_type}', '{login_link}' ];
		foreach ( $users as $user ) {
			$replace = array(
				get_user_meta( $user->ID, 'billing_first_name', true ),
				get_user_meta( $user->ID, 'billing_last_name', true ),
				'15 days', //$date->diff( $now )->format( '%d days' )
				date_format( date_create( $user->expiration_date ), 'F d, Y' ),
				get_the_title( $user->subscription_plan_id ),
				get_bloginfo( 'url' ) . '/login',
			);
			$content = str_replace( $search, $replace, $email['content'] );
			$sender->send( $user->user_email, $email['title'], wpautop( $content ) );
		}
	}

	/**
	 * Get users to send reminder.
	 *
	 * @return array
	 */
	private function get_users_about_to_expire() {
		global $wpdb;

		return $wpdb->get_results(
			"SELECT * FROM
			{$wpdb->prefix}pms_member_subscriptions as SUBSCRIPTION
			LEFT JOIN {$wpdb->prefix}users AS USER
			ON SUBSCRIPTION.user_id = USER.id
			WHERE SUBSCRIPTION.status = 'active'
			AND SUBSCRIPTION.expiration_date = DATE_FORMAT( ADDDATE( NOW(), INTERVAL 15 DAY ), \"%Y-%m-%d 00:00:00\" )"
		);
	}

	/**
	 * Add new column in member list.
	 *
	 * @param array $columns List of columns.
	 *
	 * @return array
	 */
	public function members_list_table_columns( $columns ) {
		$columns['family_parent_account'] = 'Family Parent';

		return $columns;
	}

	/**
	 * Add family account data for display.
	 *
	 * @param array $data Current row member data.
	 *
	 * @return array
	 */
	public function members_list_table_entry_data( $data ) {
		$parent = get_user_meta( $data['user_id'], 'parent_family_id', true );
		$parent = pms_get_member( $parent );

		$data['family_parent_account'] = $parent->username;
		return $data;
	}

	/**
	 * Change recover password message.
	 *
	 * @return string
	 */
	public function recover_password_form_password_changed_message() {
		$url = $this->get_pms_login_page_url();
		if ( '' !== $url ) {
			$url = sprintf( ' <a href="%s">Click here to login</a>.', $url );
		}
		return '<p>' . 'Your password was successfully changed!' . $url . '</p>';
	}

	/**
	 * Get PMS login page url.
	 *
	 * @return bool|string
	 */
	private function get_pms_login_page_url() {
		$settings = get_option( 'pms_general_settings' );

		return isset( $settings['login_page'] ) && -1 !== $settings['login_page'] ? get_permalink( $settings['login_page'] ) : '';
	}

	/**
	 * Is user parent-user for family subscription.
	 *
	 * @param int  $user_id User id.
	 *
	 * @return bool
	 */
	public static function is_family_parent( $user_id = null ) {
		if ( is_null( $user_id ) ) {
			$user_id = get_current_user_id();
		}

		if ( metadata_exists( 'user', $user_id, 'parent_id' ) && get_user_meta( $user_id, 'parent_id', true ) ) {
			return true;
		}

		$member_subscriptions = pms_get_member_subscriptions( [ 'user_id' => $user_id ] );
		$subscription_plan    = pms_get_subscription_plan( $member_subscriptions[0]->subscription_plan_id );
		if ( strpos( strtolower( $subscription_plan->name ), 'family' ) !== false ) {
			return true;
		}

		return false;
	}

	/**
	 * Is sub-account for a family subscrption.
	 *
	 * @param int  $user_id User id.
	 *
	 * @return bool
	 */
	public static function is_family_member( $user_id = null ) {
		if ( is_null( $user_id ) ) {
			$user_id = get_current_user_id();
		}

		if ( ! metadata_exists( 'user', $user_id, 'family_plan_member' ) || '1' !== get_user_meta( $user_id, 'family_plan_member', true ) ) {
			return false;
		}

		return true;
	}
}
