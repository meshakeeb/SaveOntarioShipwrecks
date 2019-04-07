<?php global $shortname; ?>

<?php
/* Template Name: News */
get_header(); ?>

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
								<li><span>News</span></li>
							</ul>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>

<?php $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; ?>
<?php $args = array( 'paged' => $paged, 'post_type' => 'post' ); ?>
<?php $the_query = new WP_Query( $args ); ?>
<?php if ( $the_query->have_posts() ) : ?>

	<div class="blog-listing">
		<div class="container">
			<div class="row row-eq-height">
                <div class="col-md-8 col-sm-7 blog-single">
					<div class="row">
						<div class="col-sm-6">
							<h3 class="title"><?php _e( 'NEWS, MEETINGS & UPDATES', 'shipwrecks' ); ?></h3>
						</div>
						<div class="col-sm-6">
								<?php 
								// Fetch categories
								$categories = get_categories( 'parent=0' );
						 
								if( !empty( $categories ) && !is_wp_error( $categories ) ) {
							?>
								<div class="dropdown custom-dropdown pull-right">
									<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filter by chapter
									<span class="fa fa-angle-down"></span></button>
									<ul class="dropdown-menu">
										<?php 
											foreach ( $categories as $category ) {
												printf( '<li><a href="%s">%s</a></li>', esc_url( get_category_link( $category->term_id ) ), $category->name );
											}
										?>
									</ul>
								</div>
							<?php } ?>
						</div>
					</div>
					
                    <div class="search-results">

        				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        
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
                                    <div class="post-meta">Published on <a href="#"><?php the_time('F j, Y'); ?></a></div>
        							<?php the_excerpt(); ?>

									<?php if ( in_array( 'administrator', (array) $current_user->roles ) || in_array( 'provincial', (array) $current_user->roles ) ) : ?> 
										<a href="<?php the_permalink(); ?>?post=<?php echo get_the_ID(); ?>">Edit Post</a>
									<?php elseif ( in_array( 'bolt_chapter_editor', (array) $current_user->roles ) && in_category( get_the_title( get_user_meta($current_user->ID, 'chapter', true) ), get_the_ID() )  ) : ?>
                                        <a href="<?php the_permalink(); ?>?post=<?php echo get_the_ID(); ?>">Edit Post</a>
                                    <?php endif; ?>    
        						</div>
        					</div>
        				</div>
        
                        <?php endwhile; ?>
                        
                    </div>
                        
                    <div class="pagination">
        				
        				<?php 
        				echo paginate_links( array(
        				'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        				'total'        => $the_query->max_num_pages,
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
					
            <p>No posts found.</p>
                
            <?php endif; ?>
            
        </div>
    </div>

<?php get_footer(); ?>