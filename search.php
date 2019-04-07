<?php global $shortname; ?>

<?php

get_header(); ?>

	<div class="page_header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="text-capitalize">Search</h1>
				</div>
		
				<div class="col-sm-6">
					<div class="bcrumbs">
						<div class="container">
							<ul>
								<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
								<li><span>Search Results</span></li>
							</ul>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>

<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; if (have_posts()) : ?>
<?php $search_query = get_search_query(); ?>

	<div class="blog-listing">
		<div class="container">
			<div class="row row-eq-height">
                <div class="col-md-8 col-sm-7 blog-single">
			
			<div class="search-results">
				<h1><b><?php echo $wp_query->found_posts; ?> Search Results</b> for keyword "<span><?php echo get_search_query(); ?></span>"</h1>

				<?php 
					$args = array(
						'paged' => get_query_var('paged')
					);
					// query_posts( $args );
					while (have_posts()) : the_post(); 
				?>   

				<div class="search-item">
					<div class="row">
						<div class="col-sm-4">
							<a href="<?php the_permalink(); ?>">
								<div class="thumb">
                                    <?php if ( has_post_thumbnail() ) { ?>
                                    <?php the_post_thumbnail( 'feature-image', array( 'class' => 'img-full' ) ); ?>
                                    <?php } else { ?>
									<img src="<?php bloginfo('template_url'); ?>/images/search/1.jpg" class="img-full" alt=""/>
                                    <?php } ?>
                                    
								</div>
							</a>
						</div>
			
						<div class="col-sm-8">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>

                <?php endwhile; ?>
                
            </div>
                
            <div class="pagination">
				
				<?php 
				echo paginate_links( array(
				'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
				'total'        => $wp_query->max_num_pages,
				'current'      => max( 1, get_query_var( 'paged' ) ),
				'format' => '?paged=%#%',
				'prev_next'    => true,
				'prev_text'    => sprintf( '<i class="fa fa-arrow-left"></i> %1$s', __( '', 'text-domain' ) ),
				'next_text'    => sprintf( '%1$s <i class="fa fa-arrow-right"></i>', __( '', 'text-domain' ) ),
				'add_fragment' => '',
				) );
				?>
					
            </div>
</div>
                <div class="col-md-4 col-sm-5 about-single-sidebar">
                    <div class="sidebar">
                        <?php dynamic_sidebar( 'news-sidebar' ); ?>
                    </div>
                </div>
            </div>
            <?php else : ?>
					
            <p>Your search for <strong><?php echo get_search_query(); ?></strong> returned <strong>zero</strong> results. Please try again below.</p>
                
            <?php endif; ?>
            
        </div>
    </div>

<?php get_footer(); ?>