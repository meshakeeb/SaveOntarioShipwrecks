<?php
/**
 * Export as CSV.
 *
 * @since      1.0.0
 * @package    Ontario
 * @subpackage Ontario\Core
 * @author     BoltMedia <info@boltmedia.ca>
 */

namespace Ontario;

defined( 'ABSPATH' ) || exit;

/**
 * Export_CSV class.
 */
class Export_CSV {

	/**
	 * The class constructor.
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'handler' ] );
	}

	/**
	 * Handle for export.
	 */
	public function handler() {
		if ( ! is_user_logged_in() || ! isset( $_POST['export_me'] ) ) {
			return;
		}

		$object = $_POST['export_me'];
		if ( 'buoy-site-list' === $object ) {
			$this->download(
				'buoy-site-list',
				$this->get_buoy_site_list()
			);
		}
	}

	/**
	 * Get buoy site list.
	 *
	 * @return array
	 */
	public function get_buoy_site_list() {
		global $wpdb;

		$search = isset( $_GET['search'] ) ? 'AND ( CONCAT(A.post_name, F.name, E.field_bodywater_value, D.latitude, D.longitude) LIKE "%' . $_GET['search'] . '%" )' : '';
		$order  = isset( $_GET['orderby'] ) ? $_GET['orderby'] . ' ' . $_GET['order'] : 'A.post_name ASC';
		$query  = "SELECT
			A.ID AS postID,
			B.meta_value AS postmetaVID,
			B.meta_value AS postmetaVID,
			C.lid AS lid,
			D.latitude, D.longitude,
			E.field_organization_value,
			E.field_bodywater_value AS water,
			F.name AS group_name,
			G.post_id AS buoystatusID,
			G.meta_key AS buoystatusKEY,
			H.meta_key AS wtf2,
			H.meta_value AS status,
			I.post_status, I.post_type, I.post_name

		FROM {$wpdb->prefix}posts AS A
			LEFT JOIN {$wpdb->prefix}postmeta AS B ON  A.ID = B.post_id AND  B.meta_key = 'vid'
			LEFT JOIN location_instance AS C ON B.meta_value = C.vid
			LEFT JOIN location AS D ON C.lid = D.lid
			LEFT JOIN content_type_buoy AS E ON  C.vid = E.vid
			LEFT JOIN term_data AS F ON  E.field_organization_value = F.tid
			LEFT JOIN {$wpdb->prefix}postmeta AS G ON A.ID = G.meta_value AND G.meta_key = 'site_name'
			LEFT JOIN {$wpdb->prefix}postmeta AS H ON G.post_id = H.post_id AND H.meta_key = 'buoy_status'
			LEFT JOIN {$wpdb->prefix}posts AS I ON G.post_id = I.ID AND I.post_type = 'buoystatus1' AND I.post_name = A.post_name

		WHERE A.post_status = 'publish' AND A.post_type = 'buoysites' $search
		GROUP BY postID
		ORDER BY $order";

		return $wpdb->get_results( $query );
	}

	/**
	 * Dwonload file now.
	 *
	 * @param  string $filename Filename.
	 * @param  string $data     Data stream.
	 */
	public function download( $filename, $data ) {
		header( 'Content-Type: application/csv' );
		header( 'Content-Disposition: attachment; filename=' . $filename . '.csv' );
		header( 'Cache-Control: no-cache, no-store, must-revalidate' );
		header( 'Pragma: no-cache' );
		header( 'Expires: 0' );

		$this->convert_data( $data );
		exit;
	}

	/**
	 * Convert data to CSV.
	 *
	 * @param array $data Array of Data.
	 */
	private function convert_data( $data ) {
		$output = fopen( 'php://output', 'w' );
		fputcsv( $output, array_keys( (array) current( $data ) ) );

		foreach ( $data as $item ) {
			fputcsv( $output, (array) $item );
		}

		fclose( $output );
	}
}
