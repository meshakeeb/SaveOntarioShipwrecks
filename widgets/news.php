<?php global $shortname; ?>

<?php $the_query = new WP_Query( 'posts_per_page=5' ); //Check the WP_Query docs to see how you can limit which posts to display ?>
<?php if ( $the_query->have_posts() ) : ?>
<?php $i = 0; ?>

	<div class="home-blog">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-7">
					<div class="row">
						<div class="col-sm-7 col-xsl-7">
							<h3 class="heading">News, meetings & Updates</h3>
						</div>
						<div class="col-sm-5 col-xsl-5">
							<div class="dropdown custom-dropdown">
								
<?php

$categories = get_categories( array(  
    'hide_empty'               => 1,    
    'exclude'                  =>array(1,43) // desire id
)); ?>
<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filter by chapter
								<span class="fa fa-angle-down"></span></button>
								<ul class="dropdown-menu" id="category-menu">

    <li id="cat-all"><a class=" ajax" onclick="cat_ajax_get('all');" href="javascript:void(0);">All</a></li>
    <?php foreach ( $categories as $cat ) { ?>
    <li id="cat-<?php echo $cat->term_id; ?>"><a class="<?php echo $cat->slug; ?> ajax" onclick="cat_ajax_get('<?php echo $cat->term_id; ?>');" href="javascript:void(0);"><?php echo $cat->name; ?></a></li>

    <?php } ?>
</ul>
							</div>
						</div>
					</div>
					
					<div class="blog-listing">
					<div id="loading-animation" style="display: none;"><img src="<?php echo admin_url ( 'images/loading.gif' ); ?>"/></div>
<div id="category-post-content">
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<?php $category = get_the_category(); ?>
					
						<article style="display:block;">
							<div class="row row-eq-height">
								<div class="col-sm-5">
									<a href="<?php the_permalink(); ?>">
										<div class="thumb">
											<?php if ( has_post_thumbnail() ) { ?>
											<?php the_post_thumbnail('blog-thumb', ['class' => 'img-full']); ?>
											<?php } else { ?>
											<img src="<?php bloginfo('template_url'); ?>/images/news-default.png" class="img-full" />
											<?php } ?>
										</div>
									</a>
								</div>
								<div class="col-sm-7">
									<div class="excerpt">
										<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
										<?php the_excerpt(); ?>
										<div class="blog-meta">
											<div class="post-date">
												<span>Date Posted:</span>
												<?php the_time('F jS, Y'); ?>
											</div>
											<div class="chapter-name">
												<span>Category:</span>
												<?php echo $category[0]->cat_name; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</article>
						
						<?php endwhile; ?>
                                                 </div>
					</div>
				</div>
				<div class="col-sm-5" style="background:#f1f1f1;">

<?php include('volunteer.php'); ?>
				
                    <br>
                    <hr/>
                    <h3 class="heading">SOS on Facebook</h3>
                    <?php // echo do_shortcode('[custom-facebook-feed]'); ?>
                    
                    <a href="https://www.facebook.com/SaveOntarioShipwrecks/" target="_blank" class="bttn bttn-alt">Follow Us On Facebook!</a>
				</div>
			</div>
		</div>
	</div>
	
<?php endif; ?>
<?php wp_reset_query(); ?>