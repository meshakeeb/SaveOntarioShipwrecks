<?php
add_action( 'init', 'create_buoysite' );


function create_buoysite() {
register_post_type( 'buoysites',
array(
'labels' => array(
'name' => 'Buoy Sites',
'singular_name' => 'Buoy Site',
'add_new' => 'Add New',
'add_new_item' => 'Add New Buoy Site',
'edit' => 'Edit',
'edit_item' => 'Edit Buoy Site',
'new_item' => 'New Buoy Site',
'view' => 'View',
'view_item' => 'View Buoy Site',
'search_items' => 'Search Buoy Sites',
'not_found' => 'No Buoy Sites found',
'not_found_in_trash' =>
'No Buoy Sites found in Trash',
'buoysite' => 'Buoy Site Buoy Site'
),
'public' => true,
'menu_position' => 10,
'supports' =>
array( 'title', 'editor', 'comments', 'excerpt',
'thumbnail',  ),
'taxonomies' => array( 'post_tag' ),
'menu_icon' => null,
/* plugins_url( '', __FILE__ ), */
'has_archive' => true,

'capability_type' => 'buoy_site_manager',
'capabilities' => array(
				'publish_posts' => 'publish_buoy_site',
				'edit_posts' => 'edit_buoy_site',
				'edit_others_posts' => 'edit_others_buoy_site',
				'delete_posts' => 'delete_buoy_site',
				'delete_others_posts' => 'delete_others_buoy_site',
				'read_private_posts' => 'read_private_buoy_site',
				'edit_post' => 'edit_buoy_site',
				'delete_post' => 'delete_buoy_site',
				'read_post' => 'read_buoy_site',
			),
)
);
}
