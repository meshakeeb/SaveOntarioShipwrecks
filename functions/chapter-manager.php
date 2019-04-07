<?php
add_action( 'init', 'create_chapter' );


function create_chapter() {
register_post_type( 'chapters',
array(
'labels' => array(
'name' => 'Chapters',
'singular_name' => 'Chapter',
'add_new' => 'Add New',
'add_new_item' => 'Add New Chapter',
'edit' => 'Edit',
'edit_item' => 'Edit Chapter',
'new_item' => 'New Chapter',
'view' => 'View',
'view_item' => 'View Chapter',
'search_items' => 'Search Chapters',
'not_found' => 'No Chapters found',
'not_found_in_trash' =>
'No Chapters found in Trash',
'chapter' => 'Chapter Chapter',
),
'capability_type' => 'chapters',
'capabilities' => array(
				'publish_posts' => 'publish_chapters',
				'edit_posts' => 'edit_chapters',
				'edit_others_posts' => 'edit_others_chapters',
				'delete_posts' => 'delete_chapters',
				'delete_others_posts' => 'delete_others_chapters',
				'read_private_posts' => 'read_private_chapters',
				'edit_post' => 'edit_chapters',
				'delete_post' => 'delete_chapters',
				'read_post' => 'read_chapters',
			),
'public' => true,
'menu_position' => 10,
'supports' =>
array( 'title', 'editor', 'comments', 'excerpt', 'thumbnail', 'author',  ),
'taxonomies' => array( 'post_tag' ),
'menu_icon' => null,
/* plugins_url( '', __FILE__ ), */
'has_archive' => true
)
);
}
