<?php
add_action( 'init', 'create_newsletter' );

function create_newsletter() {
register_post_type( 'newsletters',
array(
'labels' => array(
'name' => 'Newsletters',
'singular_name' => 'Newsletter',
'add_new' => 'Add New',
'add_new_item' => 'Add New Newsletter',
'edit' => 'Edit',
'edit_item' => 'Edit Newsletter',
'new_item' => 'New Newsletter',
'view' => 'View',
'view_item' => 'View Newsletter',
'search_items' => 'Search Newsletters',
'not_found' => 'No Newsletters found',
'not_found_in_trash' =>
'No Newsletters found in Trash',
'newsletter' => 'Newsletter Newsletter'
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
