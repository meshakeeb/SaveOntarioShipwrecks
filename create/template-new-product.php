<?php
/**
 * Template Name: Create New Product
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
								<li><span>Add Product</span></li>
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
			'updated_message' => __("Product updated", 'acf'),
			'fields'          => array('_thumbnail_id', '_regular_price', '_sale_price', 'product_image_gallery' ),
			'new_post'		  => array(
				'post_type'     => 'product',
				'post_status'	=> 'publish'
			),
			'submit_value'	=> 'Create Product'
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
