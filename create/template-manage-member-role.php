<?php
global $shortname;
acf_form_head();
        wp_enqueue_style('table-sort', get_stylesheet_directory_uri().'/customization/assets/tablesorter-master/dist/css/theme.default.min.css');    
        wp_enqueue_script('table-sort-js', get_stylesheet_directory_uri().'/customization/assets/tablesorter-master/dist/js/jquery.tablesorter.min.js');  
get_header();
?> 

	<div class="page_header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1>Member Roles</h1>
				</div>

				<div class="col-sm-6">
					<div class="bcrumbs">
						<div class="container">
							 <ul>
								<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
								<li><span>Member Roles</span></li>
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

			<div class="role-history">
				<div class="container">
					<div class="row">
							<?php $user_info = wp_get_current_user(); ?>
							
							<?php if ( 
								$user_info->ID != 0 &&
								(
									in_array("provincial_membership", $user_info->roles)
									|| in_array("administrator", $user_info->roles)
									|| in_array("bolt_chapter_editor", $user_info->roles)
								)
							) : ?>
							<?php		
						        if( isset($_POST['mode']) && $_POST['mode'] === "submit") {
						            foreach ($_POST['order'] as $post_id => $order) {
										  $order_args = array(
										      'ID'           => $post_id,
										      'menu_order'   => $order,
										  );
										  wp_update_post($order_args);
						            }				            	
						        }

								$variable = get_user_meta( 
												get_current_user_id(),
												'chapter'
											);


						        $args = array(
						            'meta_query' => array(
						                array(
						                    'key'    => 'committee',
						                    'value'  => $variable
						                ),
						            ),
						            'post_type'      => 'memberroles',
						            'post_status'    => 'publish',
						            'posts_per_page' => -1,
						            'paged'          => $paged,
						            'meta_key'		 => 'role',
									'orderby'		 => 'menu_order',
									'order'			 => 'ASC'

						        );  
						        
						    ?>    
						    <form method="post">
						    	<input type="hidden" name="mode" value="submit">
								<table border="0" cellpadding="0" cellspacing="0" class="sortable">
								<thead>	
									<tr>  	 
										<th>Name</th>
										<th>Role</th>			
										<th>Date Started</th>
										<th>Date Ended</th>
										<th>Order</th>
										<th>&nbsp;</th>
									</tr>
								</thead>
								<tbody>
								<?php  
								$articles = new WP_Query($args );
								if ($articles->have_posts()) : while ($articles->have_posts()) : $articles->the_post();
									//
									?>

								<?php global $wpdb;//the_field('committee');
								$thepost = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}postmeta WHERE post_id = ".get_the_ID()." and meta_key='committee'"  );

									//echo $committee = get_field('committee',get_the_ID());
									$user = get_field('member');
									$user_info = get_userdata($user);

									$roles = get_field_object('field_5af0c06ba99fd');
									$r = get_field('role');
									$role = ( array_key_exists($r, $roles['choices']) ) ? $roles['choices'][$r] : $r;							
								?>

								<tr>
									<td><?php echo get_user_meta($user_info->ID, 'billing_first_name', true).' '.get_user_meta($user_info->ID, 'billing_last_name', true); ?></td>
									<td><?php echo $role; ?></td>
									<td><?php the_field('date_started'); ?></td>
									<td><?php the_field('date_ended'); ?></td>
									<td><input type="text" name="order[<?php echo get_the_ID(); ?>]" value="<?php echo get_post_field( 'menu_order', get_the_ID(), true ); ?>" style="width:30px"></td>
									<td><a href="<?php the_permalink(); ?>?post=<?php echo get_the_ID(); ?>">Edit</a></td>
								</tr>

								<?php endwhile; ?>

								<?php endif; ?>
								</tbody>
								</table>
								<input type="submit" value="Update Order">
							</form>						
							<script type="text/javascript">
							jQuery(".sortable").tablesorter({
								headers: {7: {sorter: false}}
							});							
							</script>
						<?php else : ?>
							<h3>Permission error. You are not allowed to access this page.</h3>	
						<?php endif; ?>	
					</div>
				</div>
			</div>

			</div>
		</div>

			<div class="col-md-4 col-sm-5 about-single-sidebar">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div>

	</div>
</div>

<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>
