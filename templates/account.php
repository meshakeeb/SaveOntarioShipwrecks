<?php
/**
 * The template for creating new products.
 * Template Name: Account
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @since   1.0.0
 * @package Ontario
 * @author  BoltMedia <info@boltmedia.ca>
 */

global $shortname;

acf_form_head();

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		$current_user = wp_get_current_user();
		$username     = $current_user->user_login;
		?>
		<div class="page_header">

			<div class="container">

				<div class="row">

					<div class="col-sm-6">
						<h1><?php the_title(); ?></h1>
					</div>

					<div class="col-sm-6">

						<div class="bcrumbs">
							<ul>
								<li><a href="<?php home_url(); ?>">Home</a></li>
								<?php if ( is_page( 'dashboard' ) ) { ?>
								<li><span><?php the_title(); ?></span></li>
								<?php } else { ?>
								<li><a href="<?php home_url( '/dashboard' ); ?>">Dashboard</a></li>
								<li><span><?php the_title(); ?></span></li>
								<?php } ?>
							</ul>
						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="about-single account-page">

			<div class="container row-eq-height">

				<div class="col-md-8 col-sm-7 about-single-content">

					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'feature-image', array( 'class' => 'pull-right' ) );
					}
					?>

					<div class="about-single-info">
						<h2>Welcome, <strong><?php echo $username; ?></strong> <span>Not <?php echo $username; ?>? <a href="<?php echo wp_logout_url(); ?>">Logout</a>.</span></h2>
					</div>

					<?php if ( is_page( 'account' ) ) { ?>

					<div class="account-navigation">

						<div class="row">

							<h2>General Settings</h2>

							<div class="col-sm-12">
								<a href="settings" class="item">
									<div class="content">
										<h4>Account Settings</h4>
										<p>Manage your Save Ontario Shipwrecks subscription, build your profile, and change your password.</p>
										<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="col-sm-12">
								<a href="shop-settings" class="item">
									<div class="content">
										<h4>Shop Settings</h4>
										<p>View your past orders, and update your shipping and billing information.</p>
										<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<?php if ( $current_user->has_cap( 'chapter_editor' ) || $current_user->has_cap( 'administrator' ) ) { ?>

							<h2>Content Management</h2>

							<div class="col-sm-12">
								<a href="edit-chapter" class="item">
									<div class="content">
										<h4>Edit Chapter</h4>
										<p>Edit your chapter page.</p>
										<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="col-md-6">
								<a href="edit-posts" class="item">
									<div class="content">
										<h4>Manage Posts</h4>
										<p>Edit and delete posts.</p>
										<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="col-md-6">
								<a href="add-post" class="item">
									<div class="content">
										<h4>Add New Post</h4>
										<p>Add a new post.</p>
										<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<?php } ?>

							<?php if ( $current_user->has_cap( 'administrator' ) ) { ?>

							<div class="col-md-6">
								<a href="edit-pages" class="item">
									<div class="content">
										<h4>Manage Pages</h4>
										<p>Edit and delete pages.</p>
										<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="col-md-6">
								<a href="add-page" class="item">
									<div class="content">
										<h4>Add New Page</h4>
										<p>Add a new page.</p>
										<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="col-md-6">
								<a href="edit-products" class="item">
									<div class="content">
										<h4>Manage Products</h4>
										<p>Edit and delete products in the SOS shop.</p>
										<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="col-md-6">
								<a href="add-product" class="item">
									<div class="content">
										<h4>Add New Product</h4>
										<p>Add a new product to the SOS shop.</p>
										<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<?php } ?>

							<?php if ( $current_user->has_cap( 'buoy_editors' ) || $current_user->has_cap( 'buoy_site_administrator' ) || $current_user->has_cap( 'administrator' ) ) { ?>

							<div class="col-md-6">
								<a href="<?php bloginfo( 'url' ); ?>/account/add-buoy-status/" class="item">
									<div class="content">
										<h4>Create Buoy Status</h4>
										<p>Send out a Buoy Status and notify NOTSHIP.</p>
										<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="col-md-6">
								<a href="<?php bloginfo( 'url' ); ?>/account/add-buoy-site/" class="item">
									<div class="content">
										<h4>Add Buoy Site</h4>
										<p>Add a new Buoy Site.</p>
										<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<?php } ?>

							<?php if ( $current_user->has_cap( 'administrator' ) ) { ?>

							<h2>User Management</h2>

							<div class="col-sm-12">
								<a href="user-directory" class="item">
									<div class="content">
										<h4>User Directory</h4>
										<p>View and manage registered SOS users.</p>
										<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<?php } ?>

						</div>

					</div>

						<?php
					} else {
						the_content();
					}
					?>

				</div>

				<div class="col-md-4 col-sm-5 about-single-sidebar">

					<?php dynamic_sidebar( 'sidebar-1' ); ?>

				</div>

			</div>

		</div>

		<p>&nbsp;</p>

	<?php endwhile; ?>

<?php endif; ?>

<div class="cta-dark">
	<div class="container">
		<div class="cta">
			<p>Save Ontario Shipwrecks gratefully acknowledge the Ministry of Tourism, Culture and Sport, Culture Programs Unit and our many sponsors for their support. We also gratefully acknowledge the financial support of the Ontario Trillium Foundation, an agency of the Ministry of Culture.</p>
			<img src="<?php bloginfo( 'template_url' ); ?>/images/logos-dark.jpg" alt=""/>
		</div>
	</div>
</div>

<?php
get_footer();
