<?php

  register_post_type( 'bolt_user_gallery',
    array(
      'labels' => array(
        'name' => __( 'User Uploaded Galleries' ),
        'singular_name' => __( 'User Gallery' ),
        'add_new_item' =>  __( 'Add User Gallery' ),
		'edit_item' => __( 'Edit User Gallery' ),
		'new_item' => __( 'New User Gallery' ),
		'view_item' => __( 'View User Gallery' ),
		'view_items' => __( 'View User Gallery' ),
		'search_items' => __( 'Search User Gallery' ),
		'not_found' => __( 'No User Gallery found' ),
		'not_found_in_trash' => __( 'No User Gallery found in trash' ),
		'all_items' => __( 'All Galleries' ),
		'archives' => __( 'Our User Gallery Archive' ),
		'attributes' => __( 'User Gallery Attributes' ),
		'insert_into_item' => __( 'Insert in User Gallery' ),
		'uploaded_to_this_item' => __( 'Uploaded to this User Gallery' ),
		'featured_image' => __( 'User Gallery Cover' ),
		'set_featured_image'  => __( 'Set User Gallery Cover' ),
		'remove_featured_image'  => __( 'Remove User Gallery Cover' ),
		'use_featured_image'  => __( 'Use as User Gallery Cover' ),
		'menu_name'  => __( 'User Gallery' ), //wp-admin sidebar label
  		),

		'public' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'rewrite' => array(
						'slug' => 'uploaded-galleries',
						'with_front' => false,
		             ),	

		'show_ui' => true, //show of hide in wp-admin
		'menu_icon' => 'dashicons-format-image',

		'supports' => array(
			'title',
			'author'
			//'editor',
			//'thumbnail',
			//'custom-fields',
			//'page-attributes'
		)

    )
  );
