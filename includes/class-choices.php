<?php
/**
 * Choices.
 *
 * @since      1.0.0
 * @package    Ontario
 * @subpackage Ontario\Core
 * @author     BoltMedia <info@boltmedia.ca>
 */

namespace Ontario;

defined( 'ABSPATH' ) || exit;

/**
 * Choices class.
 */
class Choices {

	public static function get_chapters( $index_key = 'ID' ) {
		remove_all_filters( 'posts_orderby' );
		$chapters = get_posts(
			[
				'posts_per_page'   => -1,
				'offset'           => 0,
				'orderby'          => 'title',
				'order'            => 'ASC',
				'post_type'        => 'chapters',
				'post_status'      => 'publish',
				'suppress_filters' => false,
			]
		);

		return wp_list_pluck( $chapters, 'post_title', $index_key );
	}
}
