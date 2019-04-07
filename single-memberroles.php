<?php 
global $shortname; 
acf_form_head();
get_header(); 
if (have_posts()) : 
    while (have_posts()) : the_post(); ?>

	<div class="page_header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1>Edit Role</h1>
				</div>
		
				<div class="col-sm-6">
					<div class="bcrumbs">
						<div class="container">
							<ul>
								<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
								<li><a href="<?php bloginfo('url'); ?>/dashboard/">Dashboard</a></li>
								<li><span>Edit Role</span></li>
							</ul>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>
	
	<div class="container">
		<?php
			$user_info = wp_get_current_user();
			if ( 
			$user_info->ID != 0 &&
			(
				in_array("provincial_membership", $user_info->roles)
				|| in_array("administrator", $user_info->roles)
				|| in_array("bolt_chapter_editor", $user_info->roles)
				|| in_array("board", $user_info->roles)
			)
		) : ?>		
		<?php
                acf_form(array(
                    'id'	   => 'group_5af0af59f2518', //Variable that you'll get from the URL
                    'post_title'   => false,
                    'post_content' => false,
                    'field_groups' => array('group_5af0af59f2518'),
                    'fields'       => array('member', 'role', 'committee', 'director', 'officer', 'date_started', 'date_ended'),          
                    'submit_value' => 'Update Role'
                )); 
        ?>     
        <?php else : ?>
        	<h3>Permission Error: Cannot edit member role.</h3>
		<?php endif; ?>           
    </div>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
