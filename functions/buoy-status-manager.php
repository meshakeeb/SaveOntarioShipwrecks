<?php
add_action( 'init', 'create_buoystatus' );


function create_buoystatus() {
register_post_type( 'buoystatus',
array(
'labels' => array(
'name' => 'Buoy Status',
'singular_name' => 'Buoy Status',
'add_new' => 'Add New',
'add_new_item' => 'Add New Buoy Status',
'edit' => 'Edit',
'edit_item' => 'Edit Buoy Status',
'new_item' => 'New Buoy Status',
'view' => 'View',
'view_item' => 'View Buoy Status',
'search_items' => 'Search Buoy Status',
'not_found' => 'No Buoy Status found',
'not_found_in_trash' =>
'No Buoy Status found in Trash',
'buoystatus' => 'Buoy Status Buoy Status'
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

'capability_type' => 'buoy_status_manager',
'capabilities' => array(
				'publish_posts' => 'publish_buoy_status',
				'edit_posts' => 'edit_buoy_status',
				'edit_others_posts' => 'edit_others_buoy_status',
				'delete_posts' => 'delete_buoy_status',
				'delete_others_posts' => 'delete_others_buoy_status',
				'read_private_posts' => 'read_private_buoy_status',
				'edit_post' => 'edit_buoy_status',
				'delete_post' => 'delete_buoy_status',
				'read_post' => 'read_buoy_status',
			),
)
);
}
