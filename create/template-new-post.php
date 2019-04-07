<?php
/**
 * Template Name: Create New Post
 *
 * @author ThemeSquard
 * @uses Advanced Custom Fields Pro
 */
 acf_form_head();
 get_header();

 ?>

	<div class="page_header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1><?php the_title(); ?></h1>
				</div>

				<div class="col-sm-6">
					<div class="bcrumbs">
						<div class="container">
							<ul>
								<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
								<li><span>Blog</span></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="about-single account-page">
		<div class="container row-eq-height">
			<div class="col-md-8 col-sm-7 about-single-content">
				<div class="about-single-info">
					<div class="form-block">

<?php

		acf_form(array(
			'post_id'		=> 'new_post',
			'post_title'	=> true,
			'post_content'	=> true,
			'new_post'		=> array(
				'post_status'	=> 'publish'
			),
			'submit_value'	=> 'Create Post'
		));

		/**
		 * Back-end creation of new candidate post
		 * @uses Advanced Custom Fields Pro
		 */
		add_filter('acf/pre_save_post' , 'tsm_do_pre_save_post' );
		function tsm_do_pre_save_post( $post_id ) {
			// Bail if not logged in or not able to post
			if ( ! ( is_user_logged_in() || current_user_can('publish_posts') ) ) {
				return;
			}
			// check if this is to be a new post
			if( $post_id != 'new_post' ) {
				return $post_id;
			}
			// Create a new post
			$post = array(
				'post_type'     => 'post', // Your post type ( post, page, custom post type )
				'post_status'   => 'publish', // (publish, draft, private, etc.)
				'post_title'    => wp_strip_all_tags($_POST['acf']['field_54dfc93e35ec4']), // Post Title ACF field key
				'post_content'  => $_POST['acf']['field_54dfc94e35ec5'], // Post Content ACF field key
			);
			// insert the post
			$post_id = wp_insert_post( $post );
			// Save the fields to the post
			do_action( 'acf/save_post' , $post_id );
			return $post_id;
		}

		function acf_set_featured_image( $value, $post_id, $field  ){

			if($value != ''){
				//Add the value which is the image ID to the _thumbnail_id meta data for the current post
				add_post_meta($post_id, '_thumbnail_id', $value);
			}

			return $value;
		}

		// acf/update_value/name={$field_name} - filter for a specific field based on it's name
		add_filter('acf/update_value/name=post_image', 'acf_set_featured_image', 10, 3);

?>

					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-5 about-single-sidebar">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div>

		</div>
	</div>

<?php get_footer(); ?>
