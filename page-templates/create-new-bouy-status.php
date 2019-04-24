<?php
/**
 * The template for creating new buoy status.
 * Template Name: Add Buoy Status
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @since   1.0.0
 * @package Ontario
 * @author  BoltMedia <info@boltmedia.ca>
 */

acf_form_head();

get_header();

$current_user = wp_get_current_user();
$is_allowed   = array_filter(
	[
		$current_user->has_cap( 'administrator' ),
		$current_user->has_cap( 'chapter_editor' ),
		$current_user->has_cap( 'buoy_editors' ),
		$current_user->has_cap( 'bolt_chapter_editor' ),
		$current_user->has_cap( 'publish_buoy_site' ),
		$current_user->has_cap( 'publish_buoy_status' ),
		$current_user->has_cap( 'activate_plugins' ),
	]
);
?>
<div class="page_header">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<h1 class="text-capitalize"><?php echo get_the_title(); ?></h1>
			</div>

			<div class="col-sm-6">
				<div class="bcrumbs">
					<ul>
						<li><a href="<?php bloginfo( 'url' ); ?>">Home</a></li>
						<li><span>Buoy Status</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="about-single">

	<div class="container row-eq-height">

		<div class="col-md-8 col-sm-7 about-single-content">

			<div class="about-single-info">

				<?php if ( ! empty( $is_allowed ) ) : ?>
				<p>
					<b>Note to Buoy Managers:</b> When you submit this Buoy Status Update, the system will immediately send you an email that you will then need to forward to NOTSHIPs.
				</p>

				<div class="form-block">

					<?php
					acf_form(
						[
							'post_id'         => 'new_post',
							'updated_message' => 'New Buoy Status successfully created',
							'new_post'        => [
								'post_type'   => 'buoystatus',
								'post_status' => 'publish',
								'product_cat' => [],
							],
							'submit_value'    => 'Create Buoy Status',
						]
					);

					?>

				</div>
				<?php else : ?>
					<h1>You are not allowed to add Buoy Status</h1>
				<?php endif; ?>

			</div>

		</div>

		<div class="col-md-4 col-sm-5 about-single-sidebar">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>

	</div>

</div>
<?php
get_footer();
