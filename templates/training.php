<?php
/* Template Name: Training Videos */
get_header();

$current_user = wp_get_current_user();
$username = $current_user->user_login;
?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

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

	<div class="about-single account-page">
		<div class="container row-eq-height">
			<div class="col-md-8 col-sm-7 about-single-content">

				<div class="about-single-info">
					<h2>Welcome, <strong><?php echo $username; ?></strong> <span>Not <?php echo $username; ?>? <a href="<?php echo wp_logout_url(); ?>">Logout</a>.</span></h2>
					<p>Please use the training videos below to help you better navigate the Save Ontario Shipwrecks website. You will only see videos that correspond with the access level you have to the website. Videos will open and play automatically in a popup window. Once a video is open, click the 'X' in the upper right corner of your screen to close the video so you can choose another.</p>

					<hr/>
				</div>

				<div class="account-navigation training-videos">
					<div class="container">
						<div class="row">

							<h2>Individual, Corporate and Family Members</h2>

							<div class="col-sm-6">
								<a href="https://www.youtube.com/watch?v=WZYjhtettRI" class="item" data-lity>
									<div class="content">
										<h4>Editing Your Personal Information</h4>
										<span class="rmore">Watch <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="col-sm-6">
								<a href="https://www.youtube.com/watch?v=wWh8Hh6KOGE" class="item" data-lity>
									<div class="content">
										<h4>Locating Your Membership Card</h4>
										<span class="rmore">Watch <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="clearfix"></div>

							<div class="col-sm-6">
								<a href="https://www.youtube.com/watch?v=lVUDYzpP5UE" class="item" data-lity>
									<div class="content">
										<h4>Renewing An Active Membership</h4>
										<span class="rmore">Watch <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="col-sm-6">
								<a href="https://www.youtube.com/watch?v=VbhdWB-5Yi8" class="item" data-lity>
									<div class="content">
										<h4>Renewing An Expired Membership</h4>
										<span class="rmore">Watch <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="clearfix"></div>

							<h2>Shopping at the Ships Store</h2>

							<div class="col-sm-6">
								<a href="https://www.youtube.com/watch?v=yGH8XK2cHH8" class="item" data-lity>
									<div class="content">
										<h4>Navigating the Ships Store</h4>
										<span class="rmore">Watch <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="col-sm-6">
								<a href="https://www.youtube.com/watch?v=rL220hG8Oi4" class="item" data-lity>
									<div class="content">
										<h4>Editing Billing/Shipping Addresses</h4>
										<span class="rmore">Watch <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="clearfix"></div>

							<?php /*

							<h2>Adding/Editing Content</h2>

							<div class="col-sm-6">
								<a href="https://www.youtube.com/watch?v=tNJ71n2M4uE" class="item" data-lity>
									<div class="content">
										<h4>Adding Chapter News</h4>
										<p>Manage your Save Ontario Shipwrecks membership, build your profile, and change your password.</p>
										<span class="rmore">Watch <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="col-sm-6">
								<a href="https://www.youtube.com/watch?v=tNJ71n2M4uE" class="item" data-lity>
									<div class="content">
										<h4>Adding Chapter Event</h4>
										<p>Manage your Save Ontario Shipwrecks membership, build your profile, and change your password.</p>
										<span class="rmore">Watch <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="clearfix"></div>

							<div class="col-sm-6">
								<a href="https://www.youtube.com/watch?v=tNJ71n2M4uE" class="item" data-lity>
									<div class="content">
										<h4>Adding/Editing User Roles</h4>
										<p>Manage your Save Ontario Shipwrecks membership, build your profile, and change your password.</p>
										<span class="rmore">Watch <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="clearfix"></div>

							<div class="col-sm-6">
								<a href="https://www.youtube.com/watch?v=tNJ71n2M4uE" class="item" data-lity>
									<div class="content">
										<h4>Adding A New Page</h4>
										<p>Manage your Save Ontario Shipwrecks membership, build your profile, and change your password.</p>
										<span class="rmore">Watch <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="col-sm-6">
								<a href="https://www.youtube.com/watch?v=tNJ71n2M4uE" class="item" data-lity>
									<div class="content">
										<h4>Uploading Photographs</h4>
										<p>Manage your Save Ontario Shipwrecks membership, build your profile, and change your password.</p>
										<span class="rmore">Watch <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="clearfix"></div>

							<h2>Administrator Capabilities</h2>

							<div class="clearfix"></div>

							<h2>Chapter Editor Capabilities</h2>

							<div class="clearfix"></div>

							<h2>Buoy Editor Capabilities</h2>

							<div class="col-sm-6">
								<a href="https://www.youtube.com/watch?v=tNJ71n2M4uE" class="item" data-lity>
									<div class="content">
										<h4>Creating a Buoy Status</h4>
										<p>Manage your Save Ontario Shipwrecks membership, build your profile, and change your password.</p>
										<span class="rmore">Watch <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="col-sm-6">
								<a href="https://www.youtube.com/watch?v=tNJ71n2M4uE" class="item" data-lity>
									<div class="content">
										<h4>Adding a Buoy Site</h4>
										<p>Manage your Save Ontario Shipwrecks membership, build your profile, and change your password.</p>
										<span class="rmore">Watch <i class="fa fa-arrow-right"></i></span>
									</div>
								</a>
							</div>

							<div class="clearfix"></div>

							*/ ?>

						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-5 about-single-sidebar">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div>

		</div>
	</div>

<?php endwhile; ?>
<?php endif; ?>

<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>
