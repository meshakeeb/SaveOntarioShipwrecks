<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @since   1.0.0
 * @package Ontario
 * @author  BoltMedia <info@boltmedia.ca>
 */

global $shortname;
$current_user = wp_get_current_user();
acf_form_head();
get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		get_template_part( 'templates/page', 'header' );

		if ( isset( $_GET['page-id'] ) && ! empty( $_GET['page-id'] ) && ! isset( $_GET['updated'] ) && empty( $_GET['updated'] ) && $current_user->has_cap( 'administrator' ) ) :
			echo '<div class="container">';
				acf_form(
					[
						'post_id'      => $_GET['page-id'],
						'post_title'   => true,
						'post_content' => true,
						'fields'       => array( '_thumbnail_id' ),
						'submit_value' => 'Update Content',
					]
				);
			echo '</div>';
		else :
			?>
			<div class="about-single">

				<div class="container row-eq-height">

					<div class="col-md-8 col-sm-7 about-single-content">
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'feature-image', array( 'class' => 'pull-right' ) );
						}

						if ( is_page( '181' ) || is_page( '183' ) || is_page( '210' ) ) :
							if ( $current_user->has_cap( 'buoy_site_administrator' ) ) :
								?>
						<a href="<?php the_permalink(); ?>?page-id=<?php echo get_the_ID(); ?>" class="edit-btn">Edit Post</a>
								<?php
							endif;
						endif;
						?>

						<?php if ( $current_user->has_cap( 'administrator' ) ) : ?>
						<a href="<?php the_permalink(); ?>?page-id=<?php echo get_the_ID(); ?>" class="edit-btn">Edit Post</a>
						<?php endif; ?>

						<div class="about-single-info">
							<?php the_content(); ?>
						</div>

					</div>

					<?php get_sidebar(); ?>

				</div>

			</div>

			<?php
		endif;

	endwhile;

endif;

get_template_part( 'widget/cta' );

get_footer();
