<?php
global $paged;

acf_form_head();

wp_enqueue_style( 'table-sort', get_stylesheet_directory_uri() . '/customization/assets/tablesorter-master/dist/css/theme.default.min.css' );
wp_enqueue_script( 'table-sort-js', get_stylesheet_directory_uri() . '/customization/assets/tablesorter-master/dist/js/jquery.tablesorter.min.js', [ 'jquery' ] );

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
					<ul>
						<li><a href="<?php bloginfo( 'url' ); ?>">Home</a></li>
						<li><span>Member Roles</span></li>
					</ul>
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
						<?php
						$current_user = wp_get_current_user();
						if (
							0 !== $current_user->ID &&
							(
								$current_user->has_cap( 'provincial_membership' ) ||
								$current_user->has_cap( 'administrator' ) ||
								$current_user->has_cap( 'bolt_chapter_editor' )
							)
						) :
							if ( isset( $_POST['mode'] ) && 'submit' === $_POST['mode'] ) {
								foreach ( $_POST['order'] as $post_id => $order ) {
									wp_update_post(
										array(
											'ID'         => $post_id,
											'menu_order' => $order,
										)
									);
								}
							}

							if ( isset( $_GET['action'], $_GET['post'] ) && 'delete_member_role' === $_GET['action'] ) {
								wp_delete_post( $_GET['post'], true );
							}

							$articles = new WP_Query(
								array(
									'meta_query'     => array(
										array(
											'key'   => 'committee',
											'value' => $current_user->chapter,
										),
									),
									'post_type'      => 'memberroles',
									'post_status'    => 'publish',
									'posts_per_page' => -1,
									'paged'          => $paged,
									'meta_key'       => 'role',
									'orderby'        => 'menu_order',
									'order'          => 'ASC',
								)
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
									<?php if ( $articles->have_posts() ) : ?>
										<?php
										while ( $articles->have_posts() ) :
											$articles->the_post();
											$user    = get_userdata( get_field( 'member' ) );
											$roles   = get_field_object( 'field_5af0c06ba99fd' );
											$role    = get_field( 'role' );
											$role    = array_key_exists( $role, $roles['choices'] ) ? $roles['choices'][ $role ] : $role;
											$del_url = add_query_arg(
												[
													'post' => get_the_ID(),
													'action' => 'delete_member_role',
												]
											);
											?>
										<tr>
											<td><?php echo get_user_meta( $user->ID, 'billing_first_name', true ) . ' ' . get_user_meta( $user->ID, 'billing_last_name', true ); ?></td>
											<td><?php echo $role; ?></td>
											<td><?php the_field( 'date_started' ); ?></td>
											<td><?php the_field( 'date_ended' ); ?></td>
											<td><input type="text" name="order[<?php echo get_the_ID(); ?>]" value="<?php echo get_post_field( 'menu_order', get_the_ID(), true ); ?>" style="width:30px"></td>
											<td>
												<a href="<?php the_permalink(); ?>?post=<?php echo get_the_ID(); ?>">Edit</a>
												<a href="<?php echo $del_url; ?>">Delete</a>
											</td>
										</tr>

									<?php endwhile; ?>
									<?php endif; ?>
									</tbody>
								</table>

								<input type="submit" value="Update Order">

								<script type="text/javascript">
								jQuery(".sortable").tablesorter({
									headers: { 7: { sorter: false } }
								});
								</script>

							</form>
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

<?php
get_template_part( 'widgets/cta' );

get_footer();
