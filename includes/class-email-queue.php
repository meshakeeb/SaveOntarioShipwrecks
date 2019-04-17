<?php
/**
 * Email queue manager.
 *
 * @since      1.0.0
 * @package    Ontario
 * @subpackage Ontario\Core
 * @author     BoltMedia <info@boltmedia.ca>
 */

namespace Ontario;

use WP_Temporary;
use dimadin\WP\Library\Backdrop\Task;

defined( 'ABSPATH' ) || exit;

/**
 * Put email in queue and send it one by one, by limits.
 */
class Email_Queue extends Emails {

	/**
	 * Add all the methods to appropriate hooks.
	 */
	public function __construct() {
		// Add task scheduler early on `shutdown` hook
		add_action( 'shutdown', [ $this, 'maybe_schedule_task' ], 1 );

		// Add temporaries garbage collector
		add_action( 'wp_scheduled_delete', [ 'WP_Temporary', 'clean' ], 1 );

		// Register listener for background processes from Backdrop library.
		add_action( 'admin_init', [ '\dimadin\WP\Library\Backdrop\Main', 'init' ] );
	}

	/**
	 * Initialize Email_Queue object.
	 *
	 * @return Email_Queue $instance Instance of Email_Queue class.
	 */
	public static function &get_instance() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new Email_Queue;
		}

		return $instance;
	}

	/**
	 * Helper wrapper for adding emails to queue.
	 *
	 * @see Email_Queue::add_to_queue()
	 *
	 * @param string|array $to          Array or comma-separated list of email addresses to send message.
	 * @param string       $subject     Email subject.
	 * @param string       $message     Message contents.
	 * @param string|array $headers     Optional. Additional headers.
	 * @param string|array $attachments Optional. Files to attach.
	 */
	public static function add_email_to_queue( $to, $subject, $message, $headers = '', $attachments = array() ) {
		Email_Queue::get_instance()->add_to_queue( $to, $subject, $message, $headers, $attachments );
	}

	/**
	 * Get interval.
	 *
	 * @return int $interval Value of interval. Default 360.
	 */
	public function interval() {
		/**
		 * Filter value of interval.
		 *
		 * @param int $interval Value of interval. Default 360.
		 */
		$interval = absint( apply_filters( 'simple_email_queue_interval', 3 * MINUTE_IN_SECONDS ) );

		return $interval;
	}

	/**
	 * Get number of mails in interval.
	 *
	 * @return int $max Maximum number of emails in interval. Default 10.
	 */
	public function max() {
		/**
		 * Filter maximum number of emails in interval.
		 *
		 * @param int $max Maximum number of emails in interval. Default 10.
		 */
		$max = absint( apply_filters( 'simple_email_queue_max', 20 ) );

		return $max;
	}

	/**
	 * Set/update email queue.
	 *
	 * @param array $queue An array of arrays of email adresses and
	 *                      keys of their content.
	 *
	 * @return bool|mixed False if value was not set and true if value was set.
	 *                    If method is skipped, returned value.
	 */
	public function set_queue( $queue ) {
		/**
		 * Filter the value of queue before it is set.
		 *
		 * Passing a truthy value to the filter will short-circuit setting
		 * of queue value, returning the passed value instead.
		 *
		 * @param bool|mixed $pre_value Value to return instead of the value of setting.
		 *                               Default false to skip it.
		 * @param array      $queue     An array of arrays of email adresses and
		 *                               keys of their content.
		 */
		$pre = apply_filters( 'simple_email_queue_set_pre', false, $queue );
		if ( false !== $pre ) {
			return $pre;
		}

		return WP_Temporary::set( 'simple_email_queue', $queue, WEEK_IN_SECONDS );
	}

	/**
	 * Get emails queue.
	 *
	 * @return array An array of arrays of email adresses and keys of their content.
	 */
	public function get_queue() {
		/**
		 * Filter the value of queue before it is retrieved.
		 *
		 * Passing a truthy value to the filter will short-circuit retrieving
		 * the queue value, returning the passed value instead.
		 *
		 * @param bool|mixed $pre_value Value to return instead of the queue value.
		 *                               Default false to skip it.
		 */
		$pre = apply_filters( 'simple_email_queue_get_pre', false );
		if ( false !== $pre ) {
			return $pre;
		}

		return WP_Temporary::get( 'simple_email_queue' );
	}

	/**
	 * Add email to queue.
	 *
	 * @param string|array $to          Array or comma-separated list of email addresses to send message.
	 * @param string       $subject     Email subject.
	 * @param string       $message     Message contents.
	 * @param string|array $headers     Optional. Additional headers.
	 * @param string|array $attachments Optional. Files to attach.
	 */
	public function add_to_queue( $to, $subject, $message, $headers = '', $attachments = array() ) {
		// Make an array with attributes
		$atts = compact( 'subject', 'message', 'headers', 'attachments' );

		// Get unique key based on values
		$key = md5( serialize( $atts ) );

		// If email attributes don't exist, add them
		if ( ! WP_Temporary::get( 'seq_' . $key ) ) {
			WP_Temporary::set( 'seq_' . $key, $atts, WEEK_IN_SECONDS );
		}

		// Look for existing addresses
		$existing = $this->get_queue();
		if ( ! is_array( $existing ) ) {
			$existing = array();
		}

		// Loop through all addresses and add them to queue
		foreach ( (array) $to as $address ) {
			$existing[] = array( $address => $key );
		}

		$this->set_queue( $existing );

		// Save temporary that stores existing of temporary based on existence mail in queue
		WP_Temporary::set( 'simple_email_queue_exist', 1, WEEK_IN_SECONDS );
	}

	/**
	 * Send email from queue.
	 *
	 * @param string $email_to  Email address that should be emailed to.
	 * @param string $email_key Key of content of that email.
	 */
	public function send_email( $email_to, $email_key ) {
		/**
		 * Filter the value of email send before it is retrieved.
		 *
		 * Passing a truthy value to the filter will short-circuit retrieving
		 * the option value, returning the passed value instead.
		 *
		 * @param bool|mixed $pre_value Value to return instead of the status of sending email.
		 *                               Default false to skip it.
		 * @param string     $email_to  Email address that should be emailed to.
		 * @param string     $email_key Key of content of that email.
		 */
		$pre = apply_filters( 'simple_email_queue_send_email_pre', false, $email_to, $email_key );
		if ( false !== $pre ) {
			return $pre;
		}

		// Get attributes of email and bail if they don't exists
		$atts = WP_Temporary::get( 'seq_' . $email_key );
		if ( ! $atts ) {
			return false;
		}

		return $this->send( $email_to, $atts['subject'], $atts['message'], $atts['headers'], $atts['attachments'] );
	}

	/**
	 * Process items from queue.
	 *
	 * By default, every six minutes send ten emails.
	 */
	public function process_queue() {
		// Look for existing addresses
		$existing = $this->get_queue();
		if ( ! is_array( $existing ) && $existing ) {
			return false;
		}

		// Check how much emails are already sent in this interval
		$sent = WP_Temporary::get( 'simple_email_queue_sent' );
		if ( ! $sent ) {
			$sent = 0;
		}

		/*
		 * Maximum number of allowed email to send
		 * is difference between maximum allowed and
		 * number of sent emails in this interval.
		 */
		$max = $this->max() - $sent;

		$num_sent = 0;

		foreach ( $existing as $key => $value ) {
			if ( $num_sent >= $max ) {
				break;
			}

			$email_to  = key( $value );
			$email_key = $value[ $email_to ];

			$this->send_email( $email_to, $email_key );

			// Remove item from array
			unset( $existing[ $key ] );

			// Increase number of sent emails
			$num_sent++;
		}

		// Save temporary that stores existing of temporary based on existence mail in queue
		if ( $existing ) {
			WP_Temporary::set( 'simple_email_queue_exist', 1, WEEK_IN_SECONDS );
		} else {
			WP_Temporary::delete( 'simple_email_queue_exist' );
		}

		// Save new queue
		$this->set_queue( $existing );

		// Save new number of sent emails in this interval
		$new_sent = $sent + $num_sent;
		WP_Temporary::update( 'simple_email_queue_sent', $new_sent, $this->interval() );
	}

	/**
	 * Schedule task if it's needed.
	 */
	public function maybe_schedule_task() {
		// Check if this is Backdrop request
		if ( did_action( 'wp_ajax_nopriv_hm_backdrop_run' ) ) {
			return;
		}

		// Check if queue exists
		$exists = WP_Temporary::get( 'simple_email_queue_exist' );
		if ( ! $exists ) {
			return;
		}

		// Check how much emails are already sent in this interval
		$sent = WP_Temporary::get( 'simple_email_queue_sent' );
		if ( ! $sent ) {
			$sent = 0;
		}

		// If number of sent is smaller than maximum number, schedule task
		if ( $sent < $this->max() ) {
			$task = new Task( array( $this, 'process_queue' ) );
			$task->schedule();
		}
	}
}