<?php global $shortname; ?>

<?php
/* Template Name: Publications */
get_header(); ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

	<div class="page_header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="text-capitalize"><?php the_title(); ?></h1>
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
		
			<?php if( have_rows('publications') ): ?>
		
			<div class="col-md-8 col-sm-7 resources-publications">
				<ul>
					
					<?php while ( have_rows('publications') ) : the_row(); ?>
					<?php 
						$id = get_field('pub_image'); 
						$size = "full";
						$image = wp_get_attachment_image_src( $id, $size );
					?>
				
					<li class="col-sm-6">
						<a href="<?php the_sub_field('pub_pdf'); ?>" target="_blank">
							<div class="item text-center">
								<img src="<?php bloginfo('template_url'); ?>/images/resources/publications.jpg" class="img-responsive center-block" alt=""/>
								<span><?php the_sub_field('pub_title'); ?></span>
							</div>
							
							<div class="guide-overlay">
								<img src="<?php bloginfo('template_url'); ?>/images/resources/icon-pdf.png" class="center-block" alt=""/>
								View Details <span>(PDF Download)</span>
							</div>
						</a>
					</li>
				
					<?php endwhile; ?>
							
				</ul>
			</div>
			
			<?php endif; ?>
			
			<?php get_sidebar(); ?>
		
		</div>
	</div>
			
<?php endwhile; ?>
<?php endif; ?>

<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>