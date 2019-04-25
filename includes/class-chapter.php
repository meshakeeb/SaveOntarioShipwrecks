<?php
/**
 * Chapter Helpers.
 *
 * @since      1.0.0
 * @package    Ontario
 * @subpackage Ontario\Core
 * @author     BoltMedia <info@boltmedia.ca>
 */

namespace Ontario;

defined( 'ABSPATH' ) || exit;

/**
 * Chapter class.
 */
class Chapter {

	/**
	 * Get officers by chapters.
	 *
	 * @param int $chapter Chapter ID.
	 *
	 * @return array
	 */
	public static function get_officers_by_chapter( $chapter ) {
		$officers = get_posts(
			[
				'meta_query'     => [
					[
						'key'   => 'committee',
						'value' => $chapter,
					],
				],
				'post_type'      => 'memberroles',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			]
		);

		return $officers;
	}
}
