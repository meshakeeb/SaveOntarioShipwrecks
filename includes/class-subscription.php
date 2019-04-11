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
