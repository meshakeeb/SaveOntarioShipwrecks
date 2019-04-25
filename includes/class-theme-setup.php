<?php
/**
 * The Theme Setup
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
 * Theme_Setup class.
 */
class Theme_Setup {

	use Hooker;

	/**
	 * The class constructor.
	 */
	public function __construct() {
		$this->action( 'after_setup_theme', 'setup_theme', 2 );
		$this->action( 'after_setup_theme', 'register_nav_menus' );
		$this->action( 'widgets_init', 'register_sidebars' );

		// Allow shortcodes in widget text.
		add_filter( 'widget_text', 'do_shortcode' );

		$this->filter( 'excerpt_more', 'excerpt_more' );
		$this->filter( 'excerpt_length', 'excerpt_length', 999 );
		$this->filter( 'mc4wp_form_css_classes', 'mc4wp_form_css_classes' );
		$this->filter( 'the_content', 'shortcode_fix_empty_paragraph' );

		// Mail.
		$email = new Emails;
		add_filter( 'wp_mail_from', [ $email, 'mail_from' ], 20, 1 );
		add_filter( 'wp_mail_from_name', [ $email, 'mail_from_name' ], 20, 1 );
		add_filter( 'wp_mail_content_type', [ $email, 'mail_content_type' ] );

		// Search.
		$this->filter( 'posts_join', 'search_join' );
		$this->filter( 'posts_where', 'search_where' );
		$this->filter( 'posts_distinct', 'search_distinct' );

		// Logout Link.
		$this->filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );

		$this->action( 'woocommerce_before_shop_loop', 'cloudways_product_subcategories', 50 );
		$this->action( 'wp_ajax_nopriv_load-filter', 'prefix_load_cat_posts' );
		$this->action( 'wp_ajax_load-filter', 'prefix_load_cat_posts' );

		new ACF;
		new Post_Types;
		new Frontend;
		new Shortcodes;
		new Subscription;
		new Capabilities;
		new Export_CSV;
		Email_Queue::get_instance();
	}

	/**
	 * Setup theme
	 */
	public function setup_theme() {

		/**
		 * Content Width
		 */
		if ( ! isset( $content_width ) ) {
			$content_width = apply_filters( 'ontario_content_width', 940 );
		}

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Next, use a find and replace
		 * to change 'ontario' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ontario', ONTARIO_PATH . '/languages' );
		load_theme_textdomain( 'wpstall', ONTARIO_PATH . '/languages' );

		/**
		 * Theme Support
		 */
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Add WooCommerce support.
		add_theme_support( 'woocommerce' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 300, 250, true );
		add_image_size( 'slider-image', 1400, 897, true );
		add_image_size( 'feature-image', 1200, 400, true );
		add_image_size( 'blog-thumb', 279, 215, true );
		add_image_size( 'gallery-thumb', 349, 243, true );

		// Switch default core markup for search form, comment form, and comments.
		// to output valid HTML5.
		add_theme_support(
			'html5',
			[
				'search-form',
				'gallery',
				'caption',
			]
		);

		// Post formats.
		add_theme_support(
			'post-formats',
			[
				'gallery',
				'image',
				'link',
				'quote',
				'video',
				'audio',
				'status',
				'aside',
			]
		);

		// Add theme support for Custom Logo.
		add_theme_support(
			'custom-logo',
			[
				'width'       => 180,
				'height'      => 60,
				'flex-width'  => true,
				'flex-height' => true,
			]
		);

		// Customize Selective Refresh Widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-header' );
		add_theme_support( 'custom-background' );
		add_editor_style();
	}

	/**
	 * Register navigation menus.
	 */
	public function register_nav_menus() {
		register_nav_menus(
			[
				'main_menu'    => __( 'Primary Menu', 'ontario' ),
				'header_menu'  => __( 'Header Menu', 'ontario' ),
				'footer_menu1' => __( 'Footer Menu #1', 'ontario' ),
				'footer_menu2' => __( 'Footer Menu #2', 'ontario' ),
				'footer_menu3' => __( 'Footer Menu #3', 'ontario' ),
				'meta_menu'    => __( 'Meta Menu', 'ontario' ),
			]
		);
	}

	/**
	 * Register widget area.
	 */
	function register_sidebars() {
		register_sidebar(
			[
				'id'            => 'news-sidebar',
				'name'          => __( 'News Sidebar', 'ontario' ),
				'description'   => __( 'Add widgets here to appear in your sidebar on news template.', 'ontario' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			]
		);

		register_sidebar(
			[
				'id'            => 'sidebar-1',
				'name'          => __( 'Account Sidebar', 'ontario' ),
				'description'   => __( 'Account', 'ontario' ),
				'before_widget' => '<div class="side-links">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="heading">',
				'after_title'   => '</h3>',
			]
		);

		$custom_sidebars = get_option( 'wlm_sidebars_cp' );
		$sidebars_count  = $custom_sidebars['sidebarsCount'];
		if ( $sidebars_count >= 1 ) {
			for ( $i = 1; $i <= $sidebars_count; $i++ ) {
				if ( $custom_sidebars[ 'wlm_sidebars_cp_url_' . $i ] ) {
					$sidebar_name = $custom_sidebars[ 'wlm_sidebars_cp_url_' . $i ];
					register_sidebar(
						[
							'id'            => strtolower( str_replace( ' ', '-', $sidebar_name ) ),
							'name'          => $sidebar_name,
							'description'   => $sidebar_name,
							'before_widget' => '',
							'after_widget'  => '',
							'before_title'  => '<h4>',
							'after_title'   => '</h4>',
						]
					);
				}
			}
		}

	}

	/**
	 * Custom excerpt length.
	 *
	 * @return int
	 */
	public function excerpt_length() {
		return 30;
	}

	/**
	 * Custom excerpt more text.
	 *
	 * @return string
	 */
	public function excerpt_more() {
		return '...';
	}

	/**
	 * Add custom class to mailchimp newsletter.
	 *
	 * @param  array $classes Array hold css classes.
	 * @return array
	 */
	public function mc4wp_form_css_classes( $classes ) {
		$classes[] = 'newsletter';

		return $classes;
	}

	/**
	 * Fix empty paragraph.
	 *
	 * @param  string $content The content.
	 * @return string
	 */
	public function shortcode_fix_empty_paragraph( $content ) {

		// define your shortcodes to filter, '' filters all shortcodes
		$shortcodes = [ '' ];

		foreach ( $shortcodes as $shortcode ) {

			$array = [
				'<p>[' . $shortcode    => '[' . $shortcode,
				'<p>[/' . $shortcode   => '[/' . $shortcode,
				$shortcode . ']</p>'   => $shortcode . ']',
				$shortcode . ']<br />' => $shortcode . ']',
			];

			$content = strtr( $content, $array );
		}

		return $content;
	}

	/**
	 * Search join.
	 *
	 * @param  string $join Join string.
	 * @return string
	 */
	public function search_join( $join ) {
		global $wpdb;

		if ( is_search() ) {
			$join .= ' LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
		}

		return $join;
	}

	/**
	 * Modify the search query with posts_where
	 *
	 * @param  string $where Where string.
	 * @return string
	 */
	public function search_where( $where ) {
		global $pagenow, $wpdb;

		if ( is_search() ) {
			$where = preg_replace(
				'/\(\s*' . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
				'(' . $wpdb->posts . '.post_title LIKE $1) OR (' . $wpdb->postmeta . '.meta_value LIKE $1)',
				$where
			);
		}

		return $where;
	}

	/**
	 * Prevent duplicates.
	 *
	 * @param  string $distinct [description]
	 * @return string        [description]
	 */
	public function search_distinct( $distinct ) {
		global $wpdb;

		if ( is_search() ) {
			return 'DISTINCT';
		}

		return $distinct;
	}

	/**
	 * Add logout link to both location.
	 *
	 * @param string   $items The HTML list content for the menu items.
	 * @param stdClass $args  An object containing wp_nav_menu() arguments.
	 */
	public function add_loginout_link( $items, $args ) {
		if ( ! is_user_logged_in() || ! in_array( $args->theme_location, [ 'header_menu' ], true ) ) {
			return $items;
		}

		// Logout Link.
		return $items . '<li class="nav-item right"><a class="nav-link" href="' . wp_logout_url() . '">Log Out</a></li>';
	}


	public function cloudways_product_subcategories( $args = [] ) {
		$terms = get_terms( 'product_cat', [ 'parent' => get_queried_object_id() ] );

		if ( is_wp_error( $terms ) || empty( $terms ) ) {
			return;
		}

		echo '<ul class="products columns-4 sub-categories">';

		foreach ( $terms as $term ) {

			echo '<li class="category product">';

			woocommerce_subcategory_thumbnail( $term );

			echo '<h2><a href="' . esc_url( get_term_link( $term ) ) . '" class="' . $term->slug . '">' . $term->name . '</a></h2>';

			echo '</li>';
		}

		echo '</ul>';
	}

	/**
	 * Prefix load cat posts.
	 */
	public function prefix_load_cat_posts() {
		$cat_id    = $_POST['cat'];
		$the_query = 'all' === $cat_id ? new WP_Query( [ 'posts_per_page' => '10' ] ) :
			new WP_Query(
				[
					'posts_per_page' => '5',
					'cat'            => $cat_id,
				]
			);

		if ( $the_query->have_posts() ) {
			$i = 0;
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				$category = get_the_category();
				?>
				<article>
					<div class="row row-eq-height">
						<div class="col-sm-5">
							<a href="<?php the_permalink(); ?>">
								<div class="thumb">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'blog-thumb', [ 'class' => 'img-full' ] );
									} else {
										?>
									<img src="<?php ONTARIO_URL . '/images/news-default.png'; ?>" class="img-full" />
									<?php } ?>
								</div>
							</a>
						</div>
						<div class="col-sm-7">
							<div class="excerpt">
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<?php the_excerpt(); ?>
								<div class="blog-meta">
									<div class="post-date">
										<span>Date Posted:</span>
										<?php the_time( 'F jS, Y' ); ?>
									</div>
									<div class="chapter-name">
										<span>Chapter Name:</span>
										<?php echo $category[0]->cat_name; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</article>
				<?php
			endwhile;
			wp_reset_postdata();
		}
		exit;
	}
}
