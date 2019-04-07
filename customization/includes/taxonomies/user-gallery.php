<?php

    register_taxonomy(
        'user-gallery-category',
        'bolt_user_gallery',
        array(
            'label' => __( 'Category' ),
            'rewrite' => array( 'slug' => 'chapter' ),
            'hierarchical' => true,
        )
    );