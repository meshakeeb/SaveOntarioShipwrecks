<?php 
global $shortname;
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
				                <li><span><?php the_title(); ?></span></li>
			                 </ul>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>
	
<div class="gallery-listing">
	<div class="container">

		<?php //print_r( $boltFront->dropdowns() ); ?>
		<?php get_template_part('templates/partials/user-gallery', 'search'); ?>	

			
			
			<?php $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; ?>
			<?php 

				$args = array(
								'paged'             => $paged, 
								'post_type'         => 'bolt_user_gallery', 
								'posts_per_page'    => 12, 	
								'meta_query'	=> array(
									array(
										'key'	  	=> 'u_gallery_public',
										'value'	  	=> 1,
										'compare' 	=> "LIKE",
									),
								),									
						); 

				if( $_GET['uploader'] != "0" && isset($_GET['uploader']) ){
					$args['author__in'] = array(  $_GET['uploader'] );					
				}

				if( $_GET['chapter'] != "0" && isset($_GET['chapter']) ){

					$args['meta_query'] = array(
							'relation'		=> 'AND',
							array(
							    'key' => 'u_gallery_chapter',
							    'value' => $_GET['chapter']
							),
							array(
								'key'	  	=> 'u_gallery_public',
								'value'	  	=> 1,
								'compare' 	=> "LIKE",
							),							
					);					
					$args['orderby'] = 'meta_value';
					$args['order'] = 'ASC';

				}
				
				//echo '<pre>'; print_r($args); echo '</pre>';

			$gallery = new WP_Query( $args ); 
			?>

			<?php if ( $gallery->have_posts() ) : ?>				
			
				<?php while ( $gallery->have_posts() ) : $gallery->the_post(); ?>
				<?php 	
				$bolt_images = get_field('u_gallery_images'); 

				$ctr = 0;
				?>
				<ul class="user-gallery gallery gallery-list col-sm-4">
					<?php foreach($bolt_images as $img) : ?>
						<?php if( $ctr === 0 )  : ?>
						<li>		
							<?php //print_r( get_post_meta( get_the_ID() ) ); ?>
							<a href="<?php echo $img['url']; ?>">
								<div class="item">
									<img src="<?php echo $img['url']; ?>" class="img-full" alt=""/>
									<div class="overlay">
										<div class="overlay-inner">
											<i class="fa fa-search-plus"></i>
											<h4><?php the_field('u_gallery_name'); ?></h4>
										</div>
									</div>
								</div>
							</a>
							<?php if( is_user_logged_in() ) : ?>
							<p align="right"><a class="edit_link" href="<?php echo add_query_arg( array('edit' => get_the_ID() ), '/dashboard/user-gallery/'); ?>">Edit</p><?php endif; ?>							
						</li>	
						<?php $ctr++; else : ?>
						<li><a href="<?php echo $img['url']; ?>"></a></li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>	
				<?php endwhile; ?>
						
			
            
            <div class="pagination">
				
        				<?php 
        				echo paginate_links( array(
        				'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        				'total'        => $gallery->max_num_pages,
        				'current'      => max( 1, get_query_var( 'paged' ) ),
        				'format' => '?paged=%#%',
        				'prev_next'    => true,
        				'prev_text' => '<i class="fa fa-arrow-left"></i>',
        				'next_text' => '<i class="fa fa-arrow-right"></i>',
        				'add_fragment' => '',
        				) );
        				?>
				
            </div>			

		

	<?php else : ?>
	Nothing found...
	<?php endif; ?>
			

	</div>
</div>

<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>
