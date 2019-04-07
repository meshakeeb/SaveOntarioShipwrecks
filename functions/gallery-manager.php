<?php
add_action( 'init', 'create_gallery' );

function create_gallery() {
register_post_type( 'gallery',
array(
'labels' => array(
'name' => 'Gallery',
'singular_name' => 'Gallery',
'add_new' => 'Add New',
'add_new_item' => 'Add New Gallery',
'edit' => 'Edit',
'edit_item' => 'Edit Gallery',
'new_item' => 'New Gallery',
'view' => 'View',
'view_item' => 'View Gallery',
'search_items' => 'Search Gallery',
'not_found' => 'No Gallery found',
'not_found_in_trash' =>
'No Gallery found in Trash',
'gallery' => 'Gallery Gallery'
),
'public' => true,
'menu_position' => 10,
'supports' =>
array( 'title', 'editor', 'comments', 'excerpt',
'thumbnail',  ),
'taxonomies' => array( 'post_tag' ),
'menu_icon' => null,
/* plugins_url( '', __FILE__ ), */
'has_archive' => true
)
);
}
