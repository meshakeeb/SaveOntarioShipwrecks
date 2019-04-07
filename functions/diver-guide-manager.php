<?php
add_action( 'init', 'create_diverguide' );

function create_diverguide() {
register_post_type( 'diverguides',
array(
'labels' => array(
'name' => 'Diver Guides',
'singular_name' => 'Diver Guide',
'add_new' => 'Add New',
'add_new_item' => 'Add New Diver Guide',
'edit' => 'Edit',
'edit_item' => 'Edit Diver Guide',
'new_item' => 'New Diver Guide',
'view' => 'View',
'view_item' => 'View Diver Guide',
'search_items' => 'Search Diver Guides',
'not_found' => 'No Diver Guides found',
'not_found_in_trash' =>
'No Diver Guides found in Trash',
'diverguide' => 'Diver Guide Diver Guide'
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
