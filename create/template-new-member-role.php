<?php
/**
 * Template Name: Create New Member Role
 *
 * @author ThemeSquard
 * @uses Advanced Custom Fields Pro
 */
 acf_form_head();
 get_header();

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
								<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
								<li><span>Blog</span></li>
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
					<div class="form-block">
							<?php

								$user_info = wp_get_current_user(); 
								if ( 
										is_user_logged_in() &&
										(
											in_array("provincial_membership", $user_info->roles)
											|| in_array("administrator", $user_info->roles)
											|| in_array("bolt_chapter_editor", $user_info->roles)
											|| in_array("board", $user_info->roles)
										)
								) : 
							?>
								<?php
											acf_form(array(
												'post_id'		  => 'new_post',
												'post_title'	  => false,
												'post_content'	  => false,
												'fields'          => array( 'member', 'role', 'committee', 'director', 'officer', 'date_started', 'date_ended' ),
												'updated_message' => __("New Role Created", 'acf'),
												'new_post'		  => array(
													'post_type'     => 'memberroles',
													'post_status'	=> 'publish'
												),
												'submit_value'	=> 'Create Role'
											));

								?>
							<?php else : ?>
								<h3>You are not allowed to create member role</h3>
							<?php endif; ?>

					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-5 about-single-sidebar">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div>

		</div>
	</div>

<?php get_footer(); ?>
