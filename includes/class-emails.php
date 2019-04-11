<?php
/**
 * Email manager.
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
 * Emails class.
 */
class Emails {

	use Hooker;

	/**
	 * Send an email.
	 *
	 * @param string $to Email to.
	 * @param string $subject Email subject.
	 * @param string $message Email message.
	 * @param string $headers Email headers.
	 * @param array  $attachments Email attachments.
	 *
	 * @return bool success
	 */
	private function send( $to, $subject, $message, $headers = '', $attachments = [] ) {
		$this->add_filters();
		$return = wp_mail( $to, $subject, $message, $headers, $attachments );
		$this->remove_filters();

		return $return;
	}

	/**
	 * Get template part
	 *
	 * @param string $template Template name.
	 * @param array  $args     Arguments to use.
	 */
	public function get_message_from_templates( $template, $args ) {
		extract( $args ); // phpcs:ignore
		ob_start();
		include locate_template( 'templates/emails/' . $template . '.php' );
		return ob_get_clean();
	}

	/**
	 * Get email content type.
	 *
	 * @return string
	 */
	public function get_content_type() {
		return 'text/html';
	}

	/**
	 * Email address to send from.
	 *
	 * @param string $from_email Email address to send from.
	 *
	 * @return string
	 */
	public function mail_from( $from_email ) {
		$pms_settings = get_option( 'pms_emails_settings' );
		if ( ! empty( $pms_settings['email-from-email'] ) && is_email( $pms_settings['email-from-email'] ) ) {
			return $pms_settings['email-from-email'];
		}

		return 'membership@saveontarioshipwrecks.ca';
	}
	/**
	 * Name to associate with the “from” email address.
	 *
	 * @param string $from_name Name associated with the "from" email address.
	 *
	 * @return string
	 */
	public function mail_from_name( $from_name ) {
		$pms_settings = get_option( 'pms_emails_settings' );
		if ( ! empty( $pms_settings['email-from-name'] ) ) {
			return $pms_settings['email-from-name'];
		}

		return get_bloginfo( 'name' );
	}

	/**
	 * Add temporary filters.
	 */
	private function add_filters() {
		// Add filter to enable html encoding
		$this->filter( 'wp_mail_content_type', 'get_content_type' );

		// Temporary change the from name and from email
		$this->filter( 'wp_mail_from_name', 'mail_from_name', 20, 1 );
		$this->filter( 'wp_mail_from', 'mail_from', 20, 1 );
	}

	/**
	 * Remove temporary filters.
	 */
	private function remove_filters() {
		$this->remove_filter( 'wp_mail_content_type', 'get_content_type' );
		$this->remove_filter( 'wp_mail_from_name', 'mail_from_name', 20, 1 );
		$this->remove_filter( 'wp_mail_from', 'mail_from', 20, 1 );
	}
}
