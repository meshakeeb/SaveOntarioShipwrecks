<?php
/**
 * Register Post Type.
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
 * Post_Types class.
 */
class Post_Types {

	use Hooker;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$this->action( 'init', 'buoysites' );
		$this->action( 'init', 'buoystatus' );
		$this->action( 'init', 'chapters' );
		$this->action( 'init', 'divers' );
		$this->action( 'init', 'gallery' );
		$this->action( 'init', 'newsletter' );
		$this->action( 'init', 'member_roles' );
	}

	/**
	 * Register buoysites post type.
	 */
	public function buoysites() {
		$labels = [
			'name'               => 'Buoy Sites',
			'singular_name'      => 'Buoy Site',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Buoy Site',
			'edit'               => 'Edit',
			'edit_item'          => 'Edit Buoy Site',
			'new_item'           => 'New Buoy Site',
			'view'               => 'View',
			'view_item'          => 'View Buoy Site',
			'search_items'       => 'Search Buoy Sites',
			'not_found'          => 'No Buoy Sites found',
			'not_found_in_trash' => 'No Buoy Sites found in Trash',
			'buoysite'           => 'Buoy Site',
		];

		$args = [
			'label'           => 'Buoy Site',
			'labels'          => $labels,
			'description'     => 'To create buoy sites.',
			'supports'        => [ 'title', 'editor', 'comments', 'excerpt', 'thumbnail' ],
			'taxonomies'      => [ 'post_tag' ],
			'public'          => true,
			'menu_position'   => 10,
			'menu_icon'       => 'dashicons-post-status',
			'has_archive'     => true,
			'capability_type' => 'buoy_site_manager',
			'capabilities'    => [
				'publish_posts'       => 'publish_buoy_site',
				'edit_posts'          => 'edit_buoy_site',
				'edit_others_posts'   => 'edit_others_buoy_site',
				'delete_posts'        => 'delete_buoy_site',
				'delete_others_posts' => 'delete_others_buoy_site',
				'read_private_posts'  => 'read_private_buoy_site',
				'edit_post'           => 'edit_buoy_site',
				'delete_post'         => 'delete_buoy_site',
				'read_post'           => 'read_buoy_site',
			],
		];

		register_post_type( 'buoysites', $args );
	}

	/**
	 * Register buoystatus post type.
	 */
	public function buoystatus() {
		$labels = [
			'name'               => 'Buoy Status',
			'singular_name'      => 'Buoy Status',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Buoy Status',
			'edit'               => 'Edit',
			'edit_item'          => 'Edit Buoy Status',
			'new_item'           => 'New Buoy Status',
			'view'               => 'View',
			'view_item'          => 'View Buoy Status',
			'search_items'       => 'Search Buoy Status',
			'not_found'          => 'No Buoy Status found',
			'not_found_in_trash' => 'No Buoy Status found in Trash',
			'buoystatus'         => 'Buoy Status',
		];

		$args = [
			'label'           => 'Buoy Status',
			'labels'          => $labels,
			'description'     => 'To create buoy status.',
			'supports'        => [ 'title', 'editor', 'comments', 'excerpt', 'thumbnail' ],
			'taxonomies'      => [ 'post_tag' ],
			'public'          => true,
			'menu_position'   => 10,
			'menu_icon'       => 'dashicons-format-status',
			'has_archive'     => true,
			'capability_type' => 'buoy_status_manager',
			'capabilities'    => [
				'publish_posts'       => 'publish_buoy_status',
				'edit_posts'          => 'edit_buoy_status',
				'edit_others_posts'   => 'edit_others_buoy_status',
				'delete_posts'        => 'delete_buoy_status',
				'delete_others_posts' => 'delete_others_buoy_status',
				'read_private_posts'  => 'read_private_buoy_status',
				'edit_post'           => 'edit_buoy_status',
				'delete_post'         => 'delete_buoy_status',
				'read_post'           => 'read_buoy_status',
			],
		];

		register_post_type( 'buoystatus', $args );
	}

	/**
	 * Register chapters post type.
	 */
	public function chapters() {
		$labels = [
			'name'               => 'Chapters',
			'singular_name'      => 'Chapter',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Chapter',
			'edit'               => 'Edit',
			'edit_item'          => 'Edit Chapter',
			'new_item'           => 'New Chapter',
			'view'               => 'View',
			'view_item'          => 'View Chapter',
			'search_items'       => 'Search Chapters',
			'not_found'          => 'No Chapters found',
			'not_found_in_trash' => 'No Chapters found in Trash',
			'chapter'            => 'Chapter',
		];

		$args = [
			'label'           => 'Chapters',
			'labels'          => $labels,
			'description'     => 'To create chapters.',
			'supports'        => [ 'title', 'editor', 'comments', 'excerpt', 'thumbnail', 'author' ],
			'taxonomies'      => [ 'post_tag' ],
			'public'          => true,
			'menu_position'   => 10,
			'menu_icon'       => 'dashicons-book-alt',
			'has_archive'     => true,
			'capability_type' => 'chapters',
			'capabilities'    => [
				'publish_posts'       => 'publish_chapters',
				'edit_posts'          => 'edit_chapters',
				'edit_others_posts'   => 'edit_others_chapters',
				'delete_posts'        => 'delete_chapters',
				'delete_others_posts' => 'delete_others_chapters',
				'read_private_posts'  => 'read_private_chapters',
				'edit_post'           => 'edit_chapters',
				'delete_post'         => 'delete_chapters',
				'read_post'           => 'read_chapters',
			],
		];

		register_post_type( 'chapters', $args );
	}

	/**
	 * Register divers post type.
	 */
	public function divers() {
		$labels = [
			'name'               => 'Diver Guides',
			'singular_name'      => 'Diver Guide',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Diver Guide',
			'edit'               => 'Edit',
			'edit_item'          => 'Edit Diver Guide',
			'new_item'           => 'New Diver Guide',
			'view'               => 'View',
			'view_item'          => 'View Diver Guide',
			'search_items'       => 'Search Diver Guides',
			'not_found'          => 'No Diver Guides found',
			'not_found_in_trash' => 'No Diver Guides found in Trash',
			'diverguide'         => 'Diver Guide',
		];

		$args = [
			'label'         => 'Diver Guide',
			'labels'        => $labels,
			'description'   => 'To create diver guides.',
			'supports'      => [ 'title', 'editor', 'comments', 'excerpt', 'thumbnail' ],
			'taxonomies'    => [ 'post_tag' ],
			'public'        => true,
			'menu_position' => 10,
			'menu_icon'     => 'dashicons-sos',
			'has_archive'   => true,
		];

		register_post_type( 'diverguides', $args );
	}

	/**
	 * Register gallery post type.
	 */
	public function gallery() {
		$labels = [
			'name'               => 'Gallery',
			'singular_name'      => 'Gallery',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Gallery',
			'edit'               => 'Edit',
			'edit_item'          => 'Edit Gallery',
			'new_item'           => 'New Gallery',
			'view'               => 'View',
			'view_item'          => 'View Gallery',
			'search_items'       => 'Search Gallery',
			'not_found'          => 'No Gallery found',
			'not_found_in_trash' => 'No Gallery found in Trash',
			'gallery'            => 'Gallery',
		];

		$args = [
			'label'         => 'Gallery',
			'labels'        => $labels,
			'description'   => 'To create galleries.',
			'supports'      => [ 'title', 'editor', 'comments', 'excerpt', 'thumbnail' ],
			'taxonomies'    => [ 'post_tag' ],
			'public'        => true,
			'menu_position' => 10,
			'menu_icon'     => 'dashicons-sos',
			'has_archive'   => true,
		];

		register_post_type( 'gallery', $args );
	}

	/**
	 * Register newsletter post type.
	 */
	public function newsletter() {
		$labels = [
			'name'               => 'Newsletters',
			'singular_name'      => 'Newsletter',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Newsletter',
			'edit'               => 'Edit',
			'edit_item'          => 'Edit Newsletter',
			'new_item'           => 'New Newsletter',
			'view'               => 'View',
			'view_item'          => 'View Newsletter',
			'search_items'       => 'Search Newsletters',
			'not_found'          => 'No Newsletters found',
			'not_found_in_trash' => 'No Newsletters found in Trash',
			'newsletter'         => 'Newsletter Newsletter',
		];

		$args = [
			'label'         => 'Newsletter',
			'labels'        => $labels,
			'description'   => 'To create newsletters.',
			'supports'      => [ 'title', 'editor', 'comments', 'excerpt', 'thumbnail' ],
			'taxonomies'    => [ 'post_tag' ],
			'public'        => true,
			'menu_position' => 10,
			'menu_icon'     => 'dashicons-email',
			'has_archive'   => true,
		];

		register_post_type( 'newsletters', $args );
	}

	/**
	 * Register member_roles post type.
	 */
	public function member_roles() {
		$labels = [
			'name'               => 'Member Roles',
			'singular_name'      => 'Member Role',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Member Role',
			'edit'               => 'Edit',
			'edit_item'          => 'Edit Member Role',
			'new_item'           => 'New Member Role',
			'view'               => 'View',
			'view_item'          => 'View Member Role',
			'search_items'       => 'Search Member Roles',
			'not_found'          => 'No Member Roles found',
			'not_found_in_trash' => 'No Member Roles found in Trash',
			'parent'             => 'Parent Member Role',
		];

		$args = [
			'label'         => 'Member Role',
			'labels'        => $labels,
			'description'   => 'To create member roles.',
			'supports'      => [ 'page-attributes' ],
			'taxonomies'    => [ 'post_tag' ],
			'public'        => true,
			'hierarchical'  => true,
			'menu_position' => 10,
			'menu_icon'     => 'dashicons-id',
			'has_archive'   => true,
		];

		register_post_type( 'memberroles', $args );
	}
}
