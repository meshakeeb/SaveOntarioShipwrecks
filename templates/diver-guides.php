<?php global $shortname; ?>

<?php
/* Template Name: Diver Guides */
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
			<div class="col-md-8 col-sm-7 resources-guides">
			
				<?php $the_query = new WP_Query( 'posts_per_page=-1&post_type=diverguides' ); //Check the WP_Query docs to see how you can limit which posts to display ?>
				<?php if ( $the_query->have_posts() ) : ?>
			
				<ul>
				
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				
					<li class="col-sm-4">
						<a href="<?php the_permalink(); ?>">
							<div class="item text-center">
								<?php if ( has_post_thumbnail() ) { ?>
								<?php the_post_thumbnail('full', ['class' => 'img-responsive center-block']); ?>
								<?php } ?>
								<span><?php the_title(); ?></span>
							</div>
							
							<div class="guide-overlay">
								<i class="fa fa-eye"></i>
								View Details
							</div>
						</a>
					</li>
				
					<?php endwhile; ?>
		
				</ul>
				
				<?php endif; ?>
				
			</div>

<?php get_sidebar(); ?>
			
		</div>
	</div>
			
<?php endwhile; ?>
<?php endif; ?>

<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>
