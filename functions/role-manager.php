<?php
add_action( 'init', 'create_memberrole' );


function create_memberrole() {
register_post_type( 'memberroles',
array(
'labels' => array(
'name' => 'Member Roles',
'singular_name' => 'Member Role',
'add_new' => 'Add New',
'add_new_item' => 'Add New Member Role',
'edit' => 'Edit',
'edit_item' => 'Edit Member Role',
'new_item' => 'New Member Role',
'view' => 'View',
'view_item' => 'View Member Role',
'search_items' => 'Search Member Roles',
'not_found' => 'No Member Roles found',
'not_found_in_trash' =>
'No Member Roles found in Trash',
'parent' => 'Parent Member Role'
),
'public' => true,
'menu_position' => 10,
'hierarchical' => true,
'supports' =>
array( 'page-attributes' ),
'taxonomies' => array( 'post_tag' ),
'menu_icon' => null,
/* plugins_url( '', __FILE__ ), */
'has_archive' => true,
)
);
}
