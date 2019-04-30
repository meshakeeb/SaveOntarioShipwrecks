<?php
/**
 * ACF manager.
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
 * ACF class.
 */
class ACF {

	use Hooker;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		require_once 'acf/member-documents.php';
		require_once 'acf/new-event.php';
		require_once 'acf/new-event-venue.php';
		require_once 'acf/new-event-organizer.php';
		require_once 'acf/new-event-cost.php';
		require_once 'acf/user-gallery.php';
		require_once 'acf/new-product.php';

		$this->action( 'acf/save_post', 'save_post', 99 );
		$this->filter( 'acf/fields/google_map/api', 'acf_google_map_api' );
	}

	/**
	 * Add google map api key to ACF.
	 *
	 * @param  array $api Array of google api.
	 * @return array
	 */
	public function acf_google_map_api( $api ) {
		$api['key'] = 'AIzaSyCOky9W-ZqebN965Vy-X137_Do4jMicjcU';

		return $api;
	}

	/**
	 * Hook When saving acf_form
	 *
	 * @param int $post_id Post ID of inserted/updated post.
	 */
	public function save_post( $post_id ) {
		$post_type = get_post_type( $post_id );

		switch ( $post_type ) {
			case 'bolt_user_gallery':
				$new_title   = sprintf(
					'%s Gallery %d: %s',
					get_the_title( get_field( 'u_gallery_chapter', $post_id ) ),
					$post_id,
					get_field( 'u_gallery_name', $post_id )
				);
				$post_status = 'publish';
				break;

			case 'gallery':
				$new_title   = sprintf(
					'%s Photo %d',
					get_the_title( get_field( 'chapter', $post_id ) ),
					$post_id
				);
				$post_status = 'draft';
				break;

			case 'buoystatus':
				$date        = '' !== $_POST['acf']['field_5abd51db107be'] ? $_POST['acf']['field_5abd51db107be'] : date( 'Ymd' );
				$new_title   = sprintf(
					'%s-%s-%s',
					get_the_title( $_POST['acf']['field_5abd51c5107bd'] ),
					$_POST['acf']['field_5abd51ea107bf'],
					$date
				);
				$post_status = 'publish';
				break;

			case 'tribe_events':
				if ( ! is_admin() ) {
					wp_set_object_terms(
						$post_id,
						[ $_POST['acf']['event_category'] ],
						'tribe_events_cat',
						false
					);

					if ( ! empty( $_POST['acf']['is_course'] ) ) {
						wp_set_object_terms(
							$post_id,
							'courses',
							'tribe_events_cat',
							false
						);
					}
				}

				if ( empty( $_POST['acf']['_EventVenueID'] ) ) {
					$this->create_venue( $post_id );
				}

				if ( empty( $_POST['acf']['_EventOrganizerID'] ) ) {
					$this->create_organizer( $post_id );
				}

				if ( ! empty( $_POST['acf']['has_payment'] ) ) {
					$this->create_ticket( $post_id );
				}

				return;
				break;
			default:
				return;
		}

		$args = [
			'ID'          => $post_id,
			'post_title'  => $new_title,
			'post_status' => $post_status,
			'post_type'   => $post_type,
			'post_author' => get_current_user_id(),
		];

		if ( 0 !== wp_update_post( $args ) ) {
			if ( 'buoystatus' === $post_type ) {
				$this->new_buoy_status_email( $post_id );
			}
		}
	}

	/**
	 * Create venue
	 *
	 * @param int $post_id Post ID of inserted/updated post.
	 */
	private function create_venue( $post_id ) {
		$event_location = wp_insert_post(
			[
				'post_author'    => get_current_user_id(),
				'post_title'     => $_POST['acf']['venue_name'],
				'post_type'      => 'tribe_venue',
				'comment_status' => 'closed',
				'post_status'    => 'publish',
				'meta_input'     => [
					'_VenueAddress'         => $_POST['acf']['_VenueAddress'],
					'_VenueAddress'         => $_POST['acf']['_VenueAddress'],
					'_VenueCity'            => $_POST['acf']['_VenueCity'],
					'_VenueCountry'         => $_POST['acf']['_VenueCountry'],
					'_VenueProvince'        => $_POST['acf']['_VenueProvince'],
					'_VenueZip'             => $_POST['acf']['_VenueZip'],
					'_EventShowMap'         => $_POST['acf']['_EventShowMap'],
					'_VenueOverwriteCoords' => $_POST['acf']['_VenueOverwriteCoords'],
					'_VenueLat'             => isset( $_POST['acf']['_VenueLocation'] ) ? $_POST['acf']['_VenueLocation']['lat'] : '',
					'_VenueLng'             => isset( $_POST['acf']['_VenueLocation'] ) ? $_POST['acf']['_VenueLocation']['lng'] : '',
				],
			]
		);

		if ( $event_location > 0 ) {
			update_post_meta( $post_id, '_EventVenueID', $event_location );
		}
	}

	/**
	 * Create organizer
	 *
	 * @param int $post_id Post ID of inserted/updated post.
	 */
	private function create_organizer( $post_id ) {
		$organizer = wp_insert_post(
			[
				'post_author'    => get_current_user_id(),
				'post_title'     => $_POST['acf']['organizer_name'],
				'post_type'      => 'tribe_organizer',
				'comment_status' => 'closed',
				'post_status'    => 'publish',
				'meta_input'     => [
					'_OrganizerPhone'   => $_POST['acf']['_OrganizerPhone'],
					'_OrganizerWebsite' => $_POST['acf']['_OrganizerWebsite'],
					'_OrganizerEmail'   => $_POST['acf']['_OrganizerEmail'],
				],
			]
		);

		if ( $organizer > 0 ) {
			update_post_meta( $post_id, '_EventOrganizerID', $organizer );
		}
	}

	/**
	 * Create ticket
	 *
	 * @param int $post_id Post ID of inserted/updated post.
	 */
	private function create_ticket( $post_id ) {
		$module    = \Tribe__Tickets__Commerce__PayPal__Main::get_instance();
		$ticket_id = $module->ticket_add(
			$post_id,
			[
				'ticket_name'             => $_POST['acf']['_TicketType'],
				'ticket_price'            => $_POST['acf']['_EventCost'],
				'tribe-ticket'            => [ 'capacity' => $_POST['acf']['_TicketCapacity'] ],
				'ticket_description'      => '',
				'ticket_show_description' => '1',
				'ticket_start_date'       => '',
				'ticket_start_time'       => '',
				'ticket_end_date'         => '',
				'ticket_end_time'         => '',
				'ticket_sku'              => '',
				'ticket_id'               => '',
			]
		);
	}

	/**
	 * New buoy status email.
	 *
	 * @param int $post_id Post ID of updated post.
	 */
	private function new_buoy_status_email( $post_id ) {
		global $wpdb;

		$current_user = wp_get_current_user();
		if ( ! $current_user || wp_is_post_revision( $post_id ) || 'publish' !== get_post_status( $post_id ) ) {
			return;
		}

		$new_buoy    = get_option( 'email_newbuoy' );
		$location_id = get_post_meta(
			get_post_meta(
				$post_id,
				'site_name',
				true
			),
			'vid',
			true
		);

		$latlng = $wpdb->get_row(
			"SELECT
			C.lid AS lid,
			D.latitude, D.longitude
			FROM location_instance AS C
			LEFT JOIN location AS D ON C.lid = D.lid
			WHERE C.vid='" . $location_id . "'" // phpcs:ignore
		);

		$filter_search = [
			'{name}',
			'{post_url}',
			'{buoy_site}',
			'{buoy_status}',
			'{buoy_date}',
			'{lat}',
			'{lng}',
		];

		$filter_replace = [
			get_user_meta( $current_user->ID, 'billing_first_name', true ),
			get_permalink( $post_id ),
			get_field( 'site_name', $post_id ),
			get_field( 'buoy_status', $post_id ),
			get_field( 'record_date', $post_id ),
			$latlng->latitude,
			$latlng->longitude,
		];

		$email = new Emails;
		$email->send(
			$current_user->user_email,
			str_replace( $filter_search, $filter_replace, $new_buoy['title'] ),
			wpautop( str_replace( $filter_search, $filter_replace, $new_buoy['content'] ) )
		);
	}
}
