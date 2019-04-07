<?php
/**
 * The Shortcodes
 *
 * @since      1.0.0
 * @package    Ontario
 * @subpackage Ontario\Core
 * @author     BoltMedia <info@boltmedia.ca>
 */

namespace Ontario;

defined( 'ABSPATH' ) || exit;

/**
 * Shortcodes class.
 */
class Shortcodes {

	/**
	 * The class constructor.
	 */
	public function __construct() {
		$shortcodes = [
			'newspost',
			'eventpost',
			'family_member_list',
			'editmember_form_familyplan',
			'registration_form_familyplan',
		];

		foreach ( $shortcodes as $shortcode ) {
			add_shortcode( $shortcode, [ $this, 'render' ] );
		}
	}

	/**
	 * Render from template parts.
	 *
	 * @param array|string $attributes User defined attributes for this shortcode instance
	 * @param string|null  $content    Content between the opening and closing shortcode elements
	 * @param string       $shortcode  Name of the shortcode
	 * @return string
	 */
	public function render( $attributes, $content = '', $shortcode ) {
		$shortcode = str_replace( '_', '-', $shortcode );
		$template = locate_template( [ 'templates/shortcodes/' . $shortcode . '.php'  ] );
		if ( $template ) {
			ob_start();
			include $template;
			return ob_get_clean();
		}
	}

	/**
	 * Get chapter slug.
	 *
	 * @return string
	 */
	public function get_chapter_slug() {
		$chapter = get_user_meta( get_current_user_id(), 'chapter' );
		$chapter = get_post( $chapter[0] );

		return $chapter->post_name;
	}
}
