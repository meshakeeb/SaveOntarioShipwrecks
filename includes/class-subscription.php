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
			1 !== absint( get_user_meta( $user_id, 'parent_id', true ) )
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
}
