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

		$theme_shortcodes = [
			'column',
			'button',
			'content',
			'narrow',
			'image-block',
			'center',
			'accordion',
			'panel',
			'tabs',
			'tab',
			'tab-wrapper',
			'tab-content',
			'clear',
		];

		foreach ( $theme_shortcodes as $shortcode ) {
			$func = str_replace( '-', '_', $shortcode );
			add_shortcode( $shortcode, [ $this, $func ] );
		}
	}

	/**
	 * Render from template parts.
	 *
	 * @param array|string $attributes User defined attributes for this shortcode instance
	 * @param string|null  $content    Content between the opening and closing shortcode elements
	 * @param string       $shortcode  Name of the shortcode
	 *
	 * @return string
	 */
	public function render( $attributes, $content = '', $shortcode ) {
		$shortcode = str_replace( '_', '-', $shortcode );
		$template  = locate_template( [ 'templates/shortcodes/' . $shortcode . '.php' ] );
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

	/**
	 * Columns [column][/column].
	 *
	 * @param array|string $atts    User defined attributes for this shortcode instance
	 * @param string|null  $content Content between the opening and closing shortcode elements
	 *
	 * @return string
	 */
	public function column( $atts, $content = '' ) {
		extract( // phpcs:ignore
			shortcode_atts(
				[ 'number' => '' ],
				$atts
			)
		);

		return '<div class="col-sm-' . $number . ' columns no-padding">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 * Button [button][/button].
	 *
	 * @param array|string $atts    User defined attributes for this shortcode instance
	 * @param string|null  $content Content between the opening and closing shortcode elements
	 *
	 * @return string
	 */
	public function button( $atts, $content = '' ) {
		extract( // phpcs:ignore
			shortcode_atts(
				[ 'link' => '' ],
				$atts
			)
		);

		return '<a href="' . $link . '" class="bttn-inline">' . do_shortcode( $content ) . '</a>';
	}

	/**
	 * Content [content][/content].
	 *
	 * @param array|string $atts    User defined attributes for this shortcode instance
	 * @param string|null  $content Content between the opening and closing shortcode elements
	 *
	 * @return string
	 */
	public function content( $atts, $content = '' ) {
		extract( // phpcs:ignore
			shortcode_atts(
				[ 'src' => '' ],
				$atts
			)
		);
		return '
			<div class="about-inner">
				<div class="container">
				   <div class="about-info">
					  <div class="row">
							' . do_shortcode( $content ) . '
						</div>
					</div>
				</div>
			</div>';
	}

	/**
	 * Narrow [narrow][/narrow].
	 *
	 * @param array|string $atts    User defined attributes for this shortcode instance
	 * @param string|null  $content Content between the opening and closing shortcode elements
	 *
	 * @return string
	 */
	public function narrow( $atts, $content = '' ) {
		return '<div class="col-md-8 col-md-offset-2">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 * Narrow [image-block][/image-block].
	 *
	 * @param array|string $atts    User defined attributes for this shortcode instance
	 * @param string|null  $content Content between the opening and closing shortcode elements
	 *
	 * @return string
	 */
	public function image_block( $atts, $content = '' ) {
		extract( // phpcs:ignore
			shortcode_atts(
				[
					'src'  => '',
					'side' => '',
				],
				$atts
			)
		);

		$template = '
			<div class="about-inner">
				<div class="container">
				   <div class="about-info">
					  <div class="row">
							<div class="col-sm-6">
								%1$s
							</div>
							<div class="col-sm-6">
								%2$s
							</div>
						</div>
					</div>
				</div>
			</div>';

		$is_left = 'left' === $side;
		return sprintf(
			$template,
			$is_left ? '<img src="' . $src . '" alt="" class="img-full" />' : do_shortcode( $content ),
			! $is_left ? do_shortcode( $content ) : '<img src="' . $src . '" alt="" class="img-full" />'
		);
	}

	/**
	 * Center [center][/center].
	 *
	 * @param array|string $atts    User defined attributes for this shortcode instance
	 * @param string|null  $content Content between the opening and closing shortcode elements
	 *
	 * @return string
	 */
	public function center( $atts, $content = '' ) {
		return '<div class="text-center">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 * Accordion [accordion][/accordion].
	 *
	 * @param array|string $atts    User defined attributes for this shortcode instance
	 * @param string|null  $content Content between the opening and closing shortcode elements
	 *
	 * @return string
	 */
	public function accordion( $atts, $content = '' ) {
		return '<ul class="accordion-wrapper">' . do_shortcode( $content ) . '</ul>';
	}

	/**
	 * Panel [panel][/panel].
	 *
	 * @param array|string $atts    User defined attributes for this shortcode instance
	 * @param string|null  $content Content between the opening and closing shortcode elements
	 *
	 * @return string
	 */
	public function panel( $atts, $content = '' ) {
		extract( // phpcs:ignore
			shortcode_atts(
				[
					'title' => '',
					'class' => '',
				],
				$atts
			)
		);

		return '
		<li>
			<button class="accordion ' . $class . '"><span></span>' . $title . '</button>
			<div class="accordion-panel">' . do_shortcode( $content ) . '
			</div>
		</li>';
	}

	/**
	 * Tabs [tabs][/tabs].
	 *
	 * @param array|string $atts    User defined attributes for this shortcode instance
	 * @param string|null  $content Content between the opening and closing shortcode elements
	 *
	 * @return string
	 */
	public function tabs( $atts, $content = '' ) {
		return '<ul class="nav nav-tabs">' . do_shortcode( $content ) . '</ul>';
	}

	/**
	 * Tab [tab][/tab].
	 *
	 * @param array|string $atts    User defined attributes for this shortcode instance
	 * @param string|null  $content Content between the opening and closing shortcode elements
	 *
	 * @return string
	 */
	public function tab( $atts, $content = '' ) {
		extract( // phpcs:ignore
			shortcode_atts(
				[
					'id'    => '',
					'class' => '',
				],
				$atts
			)
		);

		return sprintf(
			'<li%1$s><a data-toggle="tab" href="#%2$s">%3$s</a></li>',
			$class ? ' class="' . $class . '"' : '',
			$id,
			do_shortcode( $content )
		);
	}

	/**
	 * Tab Wrapper [tab-wrapper][/tab-wrapper].
	 *
	 * @param array|string $atts    User defined attributes for this shortcode instance
	 * @param string|null  $content Content between the opening and closing shortcode elements
	 *
	 * @return string
	 */
	public function tab_wrapper( $atts, $content = '' ) {
		return '<div class="tab-content">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 * Tab Content [tab-content][/tab-content].
	 *
	 * @param array|string $atts    User defined attributes for this shortcode instance
	 * @param string|null  $content Content between the opening and closing shortcode elements
	 *
	 * @return string
	 */
	public function tab_content( $atts, $content = '' ) {
		extract( // phpcs:ignore
			shortcode_atts(
				[
					'id'    => '',
					'class' => '',
				],
				$atts
			)
		);

		return '<div id="' . $id . '" class="tab-pane fade ' . $class . '">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 * Clearfix [clear].
	 *
	 * @return string
	 */
	public function clear() {
		return '<div class="clearfix"></div>';
	}
}
