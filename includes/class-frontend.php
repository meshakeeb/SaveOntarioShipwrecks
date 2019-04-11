<?php
/**
 * Frontend manager.
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
 * Frontend class.
 */
class Frontend {

	use Hooker;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		// Login / Logout.
		$this->filter( 'login_redirect', 'login_redirect', 10, 3 );
		$this->action( 'wp_logout', 'logout_redirect' );
	}

	/*
	 * Redirect chapter editor or member to dashbaord.
	 */
	public function login_redirect( $url, $request, $user ) {
		$condition = ! is_wp_error( $user ) && is_a( $user, 'WP_User' );
		return $condition ? home_url( '/dashboard/' ) : $url;
	}

	/**
	 * Redirect on Logout.
	 */
	public function logout_redirect() {
		wp_redirect( home_url() );
		exit;
	}
}
