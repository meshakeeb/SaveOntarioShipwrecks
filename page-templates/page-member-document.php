<?php
/**
 * The template for displaying all single posts
 * Template Name: Member Documents
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @since   1.0.0
 * @package Ontario
 * @author  BoltMedia <info@boltmedia.ca>
 */

acf_form_head();

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		get_template_part( 'templates/page', 'header' );

		$current_user = wp_get_current_user();
		?>
		<div class="about-single">

			<div class="container row-eq-height">

				<div class="col-md-8 col-sm-7 about-single-content">

					<div class="about-single-info">
						<?php
						if ( ! isset( $_GET['view'] ) && ( $current_user->has_cap( 'administrator' ) || $current_user->has_cap( 'provincial_membership' ) ) ) :
							acf_form(
								[
									'id'           => 'group_5c9e5f1b6d247',
									'post_title'   => false,
									'post_content' => false,
									'field_groups' => [ 'group_5c9e5f1b6d247' ],
									'submit_value' => 'Update Member Documents',
								]
							);
						else :
							if ( have_rows( 'field_5c9e6181857a0' ) ) :
								while ( have_rows( 'field_5c9e6181857a0' ) ) :
									the_row();
									?>

									<h2><?php the_sub_field( 'field_5c9e629380921' ); ?></h2>

									<?php
									if ( have_rows( 'field_5c9e61f9ccf95' ) ) :
										echo '<div style="margin-bottom: 20px;">';
										while ( have_rows( 'field_5c9e61f9ccf95' ) ) :
											the_row();

											$file     = get_sub_field( 'field_5c9e6225b229d' );
											$file_url = wp_get_attachment_url( $file );
											$filetype = wp_check_filetype( $file_url );

											if ( is_user_logged_in() ) :
												?>
												<a href="<?php echo $file_url; ?>">
													<?php the_sub_field( 'field_5c9e621bb229c' ); ?>
												</a>
												<?php
											else :
												?>
												<?php the_sub_field( 'field_5c9e621bb229c' ); ?>
												<sup>You need to be logged in to view this</sup>
												<?php
											endif;
											?>
											(<?php echo strtoupper( $filetype['ext'] ); ?>)<br>
											<?php
										endwhile;
										echo '</div>';
									endif;
								endwhile;
							endif;
						endif;
						?>
					</div>

				</div>

				<?php get_sidebar(); ?>

			</div>

		</div>

		<?php
	endwhile;

endif;

get_template_part( 'widget/cta' );

get_footer();
