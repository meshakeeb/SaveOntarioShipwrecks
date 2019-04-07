<?php
/**
 * Template Name: Create New Diverguides
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
			'post_id'		  => 'new_post',
			'post_title'	  => true,
			'post_content'	  => true,
			'fields'          => array('_thumbnail_id' ),
			'updated_message' => __("Diverguides Created", 'acf'),
			'new_post'		  => array(
				'post_type'     => 'diverguides',
				'post_status'	=> 'publish'
			),
			'submit_value'	=> 'Create Diverguides'
		));

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
