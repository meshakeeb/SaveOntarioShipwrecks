<?php global $shortname; ?>

<?php
/* Template Name: Affiliates */
get_header(); ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

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
				                <li><span><?php the_title(); ?></span></li>
			                 </ul>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>
	
	<div class="about-single">
		<div class="container row-eq-height">
			<div class="col-md-8 col-sm-7 about-single-content">
				<img src="images/get-involved.jpg" class="pull-right" alt=""/>
				<div class="clearfix"></div>
				<div class="get-involved">
					<br>
					
					<?php if( have_rows('affiliates') ): ?>
					
					<ul>
					
						<?php while ( have_rows('affiliates') ) : the_row(); ?>
					
						<li class="col-sm-12">
							<div class="item">
								<img src="<?php the_sub_field('affiliate_logo'); ?>" alt="<?php the_sub_field('affiliate_name'); ?>"/>
								
								<h4><?php the_sub_field('affiliate_name'); ?></h4>
								<span><?php the_sub_field('affiliate_description'); ?></span>
								
								<a href="<?php the_sub_field('affiliate_link'); ?>" target="_blank">Visit Website</a>
							</div>
						</li>
						
						<?php endwhile; ?>
					
					</ul>
					
					<?php endif; ?>
					
				</div>
			</div>

<?php get_sidebar(); ?>
			
		</div>
	</div>
			
<?php endwhile; ?>
<?php endif; ?>

<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>
