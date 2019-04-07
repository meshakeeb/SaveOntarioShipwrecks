<?php
/**
 * Template Name: Create New Chapters
 *
 * @author ThemeSquard
 * @uses Advanced Custom Fields Pro
 */
 acf_form_head();
 get_header();
    
    echo '<div class="container">';
    
        acf_form(array(
    		'post_id'		  => 'new_post',
    		'post_title'	  => true,
    		'post_content'	  => true,
            'fields'          => array('_thumbnail_id', 'image_uploader', 'slide_image','slides' ),
            'updated_message' => __("Chapters Created", 'acf'),
            'new_post'		  => array(
    			'post_type'     => 'chapters', 
    			'post_status'	=> 'publish'
    		),
            'submit_value'	=> 'Create Chapters'
    	));
    
    echo '</div>';
    
get_footer();