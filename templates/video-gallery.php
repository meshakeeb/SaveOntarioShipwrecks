<?php global $shortname; ?>

<?php
/* Template Name: Video Gallery */
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
	
	<?php if( have_rows('video_gallery') ): ?>
	
	<div class="gallery-listing">
		<div class="container">
					
			<div class="gallery-list video-list">
				<?php 
                    global $wp_query;
                    
                    if( get_query_var('page') ) {
                      $page = get_query_var( 'page' );
                    } else {
                      $page = 1;
                    }
                    
                    // Variables
                    $row              = 0;
                    $images_per_page  = 20; // How many images to display on each page
                    $images           = get_field( 'video_gallery' );
                    $total            = count( $images );
                    $pages            = ceil( $total / $images_per_page );
                    $min              = ( ( $page * $images_per_page ) - $images_per_page ) + 1;
                    $max              = ( $min + $images_per_page ) - 1;
                    
                    while ( have_rows('video_gallery') ) : the_row(); 
                    
                    
					$id = get_sub_field('video_thumbnail'); 
					$size = "gallery-thumb";
					$image = wp_get_attachment_image_src( $id, $size );
                    
                    $row++;

                    // Ignore this image if $row is lower than $min
                    if($row < $min) { continue; }
                
                    // Stop loop completely if $row is higher than $max
                    if($row > $max) { break; }
				?>
				
				<div class="row center-content">
					<div class="col-sm-6">
						<a href="https://www.youtube.com/watch?v=<?php the_sub_field('video_id'); ?>" data-lity>
						<div class="item">
							<img src="<?php echo $image[0]; ?>" class="img-full" alt=""/>
						</div>
						</a>
					</div>			
					
					<div class="col-sm-6">
						<h4><?php the_sub_field('video_description'); ?></h4>
					</div>
				</div>
				
				<?php endwhile; ?>
						
			</div>
				
			<div class="pagination">
                <?php 
                    // Pagination
                  echo paginate_links( array(
                    'base' => get_permalink() . '%#%' . '/',
                    'format' => '?page=%#%',
                    'current' => $page,
                    'total' => $pages,
                    'type' => 'list',
                    'next_text' => '<i class="fa fa-arrow-right"></i>',
                    'prev_text' => '<i class="fa fa-arrow-left"></i>'
                  ) );
                ?>	
            </div>				

		</div>
	</div>
	
	<?php endif; ?>
			
<?php endwhile; ?>
<?php endif; ?>

<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>
