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
							<a href="manage-membership" class="item">
								<div class="content">
									<h4>Manage Membership</h4>
									<p>Change, renew and cancel your SOS membership.</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<div class="col-sm-12">
							<a href="payment-history" class="item">
								<div class="content">
									<h4>Payment History</h4>
									<p>View your SOS membership payment history.</p>
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

						<?php if ( $current_user->has_cap( 'publish_chapters' ) ) { ?>

						<div class="col-md-6">
							<a href="add-news" class="item">
								<div class="content">
									<h4>Add Chapter News</h4>
									<p>Add a news post to your chapter page.</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<?php } ?>

						<?php if ( $current_user->has_cap( 'publish_tribe_events' ) ) { ?>

						<div class="col-md-6">
							<a href="add-event" class="item">
								<div class="content">
									<h4>Add Chapter Event</h4>
									<p>Add an event to your chapter page.</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<?php } ?>

						<?php if ( $current_user->has_cap( 'send_newsletter' ) ) { ?>

						<div class="col-md-12">
							<a href="newsletter" class="item">
								<div class="content">
									<h4>Send Chapter Members A Message</h4>
									<p>A mass message to every member within your chapter. Send notes, news or site updates here.</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<?php } ?>

						<?php if ( in_array( 'bolt_chapter_editor', (array) $current_user->roles ) || in_array( 'administrator', (array) $current_user->roles ) ) { ?>

						<div class="col-md-6">
							<a href="create-role" class="item">
								<div class="content">
									<h4>Create New Role</h4>
									<p>Assign a member a new role</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<div class="col-md-6">
							<a href="role-history" class="item">
								<div class="content">
									<h4>Manage Roles</h4>
									<p>Manage existing roles</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<?php } ?>

						<?php if ( in_array( 'administrator', (array) $current_user->roles ) ) { ?>

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
							<a href="add-post" class="item">
								<div class="content">
									<h4>Add New Post</h4>
									<p>Add a new post.</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<div class="col-md-12">
							<a href="add-diver-guide" class="item">
								<div class="content">
									<h4>Add Diver Guide</h4>
									<p>Add a new diver guide.</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<?php } ?>

						<?php if ( in_array( 'administrator', (array) $current_user->roles ) || in_array( 'shop_manager', (array) $current_user->roles ) ) { ?>

						<div class="col-md-12">
							<a href="add-product" class="item">
								<div class="content">
									<h4>Add New Product</h4>
									<p>Add a new product to the SOS shop.</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<?php } ?>

						<div class="<?php echo $current_user->has_cap( 'moderate_upload_photos' ) ? 'col-md-6' : 'col-md-12'; ?>">
							<a href="upload-photos" class="item">
								<div class="content">
									<h4>Submit Photo</h4>
									<p>Upload your own photos to the SOS website.</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<?php if ( $current_user->has_cap( 'moderate_upload_photos' ) ) { ?>

						<div class="col-md-6">
							<a href="<?php bloginfo( 'url' ); ?>/dashboard/moderate-photos/" class="item">
								<div class="content">
									<h4>Moderate Upload Photos</h4>
									<p>Approve or Disapprove uploaded photos.</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<?php } ?>

						<?php if ( $current_user->has_cap( 'edit_email_templates' ) ) { ?>

						<div class="col-md-12">
							<a href="<?php bloginfo( 'url' ); ?>/dashboard/email-templates/" class="item">
								<div class="content">
									<h4>Edit Email Templates</h4>
									<p>Edit the email templates sent to users.</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<?php } ?>

						<?php if ( $current_user->has_cap( 'publish_buoy_status' ) || $current_user->has_cap( 'activate_plugins' ) ) { ?>

						<div class="col-md-6">
							<a href="<?php bloginfo( 'url' ); ?>/account/add-buoy-status/" class="item">
								<div class="content">
									<h4>Create Buoy Status</h4>
									<p>Send out a Buoy Status and notify NOTSHIP.</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<?php } ?>

						<?php if ( $current_user->has_cap( 'publish_buoy_status' ) || $current_user->has_cap( 'activate_plugins' ) ) { ?>

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

						<?php if ( in_array( 'bolt_chapter_editor', (array) $current_user->roles ) ) { ?>

						<h2>User Management</h2>

						<div class="col-sm-6">
							<a href="member-management" class="item">
								<div class="content">
									<h4>SOS Member List</h4>
									<p>View and manage registered SOS users in your chapter.</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<div class="col-sm-6">
							<a href="members" class="item">
								<div class="content">
									<h4>Manage Member Permissions</h4>
									<p>Add and remove permissions for specific users in your chapter.</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<div class="col-md-12">
							<a href="email-templates" class="item">
								<div class="content">
									<h4>Email Templates</h4>
									<p>Edit membership renewal, member permissions, and new post emails to members.</p>
								</div>
							</a>
						</div>

						<?php } ?>

						<?php if ( in_array( 'provincial', (array) $current_user->roles ) ) { ?>

						<div class="col-sm-12">
							<a href="chapters-list" class="item">
								<div class="content">
									<h4>Manage All Members</h4>
									<p>View and manage registered SOS users and manage permissions for all users.</p>
									<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
								</div>
							</a>
						</div>

						<?php } ?>

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
