<?php global $shortname; ?>

<?php
/* Template Name: Section Landing */
$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
get_header(); ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

	<div class="bcrumbs">
		<div class="container">
			<ul>
				<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
				<li><span><?php the_title(); ?></span></li>
			</ul>
		</div>
	</div>

	<div class="about-info">
		<div class="container">
			<div class="row">
                <div class="col-sm-6">
				    <h3><?php the_title(); ?></h3>
				    <?php the_content(); ?>
                </div>
                
				<div class="about-content-right" style="background: url(<?php echo $url; ?>) no-repeat center; background-size: cover;">
					<p><?php the_field('featured_image_caption'); ?></p>
				</div>
			</div>
		</div>
	</div>

    <?php if( have_rows('featured_pages') ): ?>

	<div class="about-articles">
		<div class="container">
			<div class="row">
                
                <?php while ( have_rows('featured_pages') ) : the_row(); ?>
                
				<div class="col-sm-6">
					<a href="<?php the_sub_field('fp_link'); ?>" class="item">
                        
                        <?php if ( get_field('fp_image') ) : ?>
						<div class="thumb">
							<img src="<?php the_sub_field('fp_image'); ?>" class="img-full" alt=""/>
						</div>
                        <?php endif; ?>
						
						<div class="content">
							<h4><?php the_sub_field('fp_title'); ?></h4>
							<span class="rmore">Read More <i class="fa fa-arrow-right"></i></span>
						</div>
					</a>
				</div>

                <?php endwhile; ?>
				
			</div>
		</div>
	</div>	

    <?php endif; ?>
	
<?php endwhile; ?>
<?php endif; ?>

<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>
