<?php
/**
 * Template Name: Create New Newsletters
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
            'fields'          => array('_thumbnail_id' ),
            'updated_message' => __("Newsletters Created", 'acf'),
            'new_post'		  => array(
    			'post_type'     => 'newsletters', 
    			'post_status'	=> 'publish'
    		),
            'submit_value'	=> 'Create Newsletters'
    	));
    
    echo '</div>';
    
get_footer();