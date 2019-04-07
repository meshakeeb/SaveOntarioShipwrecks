<?php
/* Template Name: Home
*/
global $shortname;
?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php include('widgets/slider.php'); ?>

<?php if( have_rows('menu_items') ): ?>

	<div class="services">
		<div class="container-fluid">
			<div class="row">

				<?php while ( have_rows('menu_items') ) : the_row(); ?>

				<div class="col-sm-2">
					<a href="<?php the_sub_field('item_link'); ?>">
						<div class="item">
							<div class="ico">
								<img src="<?php the_sub_field('item_icon'); ?>" alt=""/>
							</div>
							<h4><?php the_sub_field('item_name'); ?></h4>
							<p><?php the_sub_field('item_description'); ?></p>
						</div>
					</a>
				</div>

				<?php endwhile; ?>

			</div>
		</div>
	</div>

<?php endif; ?>
<?php wp_reset_postdata(); ?>

	<div class="info-wrap">
		<div class="container-fluid row-eq-height">
			<div class="col-sm-2">
				<div class="about-us">
					<?php the_content(); ?>
					<div class="gap60"></div>
					<a href="<?php bloginfo('url'); ?>/membership/register/" class="link">Become a Member <i class="fa fa-arrow-right"></i></a>
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
			<?php endif; ?>

			<div class="col-sm-5">

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
  //'tax_query' => array(
	  //array(
		  //'taxonomy' => 'tribe_events_cat',
		 //'field' => 'slug',
		  //'terms' => 'featured',
		  //'operator' => 'IN'
	  //),
  //)
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

<?php include('widgets/news.php'); ?>

<?php include('widgets/cta.php'); ?>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
