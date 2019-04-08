<?php
global $shortname;
global $post;
$post_slug=$post->post_name;
acf_form_head();
get_header();

if (have_posts()) :
	while (have_posts()) : the_post();
		include( get_template_directory() . '/widgets/slider.php');
		wp_reset_postdata();


		if( isset( $_GET['chapter'] ) && !empty( $_GET['chapter'] ) && !isset( $_GET['updated'] ) && empty( $_GET['updated']  ) ):
			echo '<div class="container">';

				acf_form(array(
					'post_id'		  => $_GET['chapter'],
					'post_title'	  => true,
					'post_content'	  => true,
					'fields'          => array('_thumbnail_id', 'image_uploader', 'slide_image','slides' ),
					'updated_message' => __("Chapters updated", 'acf'),
					'new_post'		  => array(
						'post_type'     => 'chapters',
						'post_status'	=> 'publish'
					),
					'submit_value'	=> 'Update Chapters'
				));

			echo '</div>';
		else:
	?>
	<div class="info-wrap single-chapters">
		<div class="container-fluid row-eq-height">
			<div class="col-sm-2">
				<div class="about-us">
					<h4>About the chapter</h4>
					<?php the_content(); ?>
					<div class="gap60"></div>
					<a href="<?php bloginfo('url'); ?>/membership/register/" class="link">Become a Member <i class="fa fa-arrow-right"></i></a>
					<?php
					$uid=get_current_user_id();
					 $variable = get_user_meta($uid,'chapter'); //echo $variable[0];
					 if($variable[0]==get_the_ID()){
					?>
					<a href="<?php the_permalink(); ?>?chapter=<?php echo get_the_ID(); ?>" class="edit-btn">Edit Chapter</a>
				<?php } ?>
				</div>
			</div>

			<?php if( have_rows('image_uploader') ): ?>
			<div class="col-sm-5">
				<div class="gallery">
					<ul>
						<?php while ( have_rows('image_uploader') ) : the_row(); ?>
						<?php
							$id = get_sub_field('fi_image');
							$size = "large";
							$image = wp_get_attachment_image_src( $id, $size );
						?>
						<li style="background:url(<?php echo $image[0]; ?>);"></li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div>

			<div class="col-sm-5">
			<?php else: ?>
			<div class="col-sm-10">
			<?php endif; ?>

<?php
$args = array(
  'post_status'=>'publish',
  'post_type'=>array(Tribe__Events__Main::POSTTYPE),
  'posts_per_page'=>1,
  //order by startdate from newest to oldest
  'meta_key'=>'_EventStartDate',
  'orderby'=>'_EventStartDate',
  'order'=>'ASC',
  //required in 3.x
  'list'=>'upcoming',
  //query events by category
  'tax_query' => array(
	  'relation' => 'OR',
	  array(
		  'taxonomy' => 'tribe_events_cat',
		  'field' => 'slug',
		  'terms' => ''. $post_slug .'',
		  'operator' => 'IN'
	  ),
	  array(
		  'taxonomy' => 'tribe_events_cat',
		  'field' => 'slug',
		  'terms' => 'general',
		  'operator' => 'IN'
	  ),
  )
);
$get_posts = null;
$get_posts = new WP_Query();
$get_posts->query($args);
if($get_posts->have_posts()) : while($get_posts->have_posts()) : $get_posts->the_post(); ?>
<?php $event_cats = get_the_terms( $post_id, 'tribe_events_cat' ); ?>

				<div class="event-item">
					<div class="cat">Events</div>
					<h3><?php the_title(); ?></h3>
					<time>Starts on <?php echo tribe_get_start_date(null, false, 'F'); ?> <?php echo tribe_get_start_date(null, false, 'd'); ?>, <?php echo tribe_get_start_date(null, false, 'Y'); ?></time>
					<div class="thumb">
						<?php if ( has_post_thumbnail() ) { ?>
							<?php the_post_thumbnail( 'feature-image', array( 'class' => 'img-full' ) ); ?>
						<?php } ?>
						<span>Meetings</span>
					</div>
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" class="rmore">Get Full Details <i class="fa fa-arrow-right"></i></a>
				</div>


<?php endwhile; ?>

<?php else : ?>

				<div class="event-item">
					<div class="cat">Events</div>
					<h3>No scheduled events.
				</div>

<?php endif; ?>

			</div>
		</div>
	</div>

<?php $the_query = new WP_Query( 'posts_per_page=10&category_name='. $post_slug .', news' ); //Check the WP_Query docs to see how you can limit which posts to display ?>
<?php if ( $the_query->have_posts() ) : ?>
<?php $i = 0; ?>

	<div class="home-blog">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-7">
					<div class="row">
						<div class="col-sm-7 col-xsl-7">
							<h3 class="heading">News, Meetings &amp; Updates</h3>
						</div>
						<div class="col-sm-5 col-xsl-5">
							&nbsp;
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
										</div>
									</div>
								</div>
							</div>
						</article>

						<?php endwhile; ?>
						<?php wp_reset_query(); ?>

						</div>
					</div>
				</div>

<?php endif; ?>

				<div class="col-sm-5">

					<?php get_template_part( 'templates/chapter', 'officers' ); ?>

					<h3 class="heading">Quick Contact</h3>
					<?php echo do_shortcode( '[contact-form-7 id="4" title="Contact"]' ); ?>

				</div>

			</div>
		</div>
	</div>
</div>


<?php endif; ?>

<?php endwhile; ?>
<?php endif; ?>

<?php include('widgets/cta.php'); ?>

<?php get_footer(); ?>
