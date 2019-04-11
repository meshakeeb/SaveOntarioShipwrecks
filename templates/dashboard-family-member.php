<?php

use Ontario\Subscription;

?>
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
							<li><a href="<?php bloginfo( 'url' ); ?>">Home</a></li>
							<?php if ( is_page( 'dashboard' ) ) { ?>
							<li><span><?php the_title(); ?></span></li>
							<?php } else { ?>
							<li><a href="<?php bloginfo( 'url' ); ?>/dashboard">Dashboard</a></li>
							<li><span><?php the_title(); ?></span></li>
							<?php } ?>
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

			<?php if ( is_page( 'dashboard' ) ) { ?>

			<div class="about-single-info">
				<h2>Welcome, <strong><?php echo $username; ?></strong> <span>Not <?php echo $username; ?>? <a href="<?php echo wp_logout_url(); ?>">Logout</a>.</span></h2>

				<hr/>
			</div>

			<div class="account-navigation">
				<div class="container">
					<div class="row">

						<div class="col-sm-12">
							<a href="training-videos" class="item getting-started">
								<div class="content">
									<h4>Getting Started <span>Training Videos</span></h4>
									<p>Welcome to your Save Ontario Shipwrecks Dashboard. If you are new to the SOS website, please click here to get started with our collection of training videos. These videos will help you discover all the things you can do on our website as an SOS member. If you have any questions or concerns, please contact your Chapter Chair or email the Provincial Chair at membership@saveontarioshipwrecks.ca.</p>
									<span class="rmore">Get Started Now! <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<h2>General Settings</h2>

						<div class="col-sm-12">
							<a href="edit-profile" class="item">
								<div class="content">
									<h4>Edit Profile</h4>
									<p>Manage your Save Ontario Shipwrecks membership, build your profile, and change your password.</p>
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

						<h2>Content Management</h2>

						<div class="col-md-12">
							<a href="upload-photos" class="item">
								<div class="content">
									<h4>Submit Photo</h4>
									<p>Upload your own photos to the SOS website.</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

					</div>
				</div>
			</div>

			<?php } else { ?>

			<div class="about-single-info">
				<h2>Welcome, <strong><?php echo $username; ?></strong> <span>Not <?php echo $username; ?>? <a href="<?php echo wp_logout_url(); ?>">Logout</a>.</span></h2>

				<hr/>
			</div>

				<?php the_content(); ?>

			<?php } ?>
		</div>

		<div class="col-md-4 col-sm-5 about-single-sidebar">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	</div>
</div>
