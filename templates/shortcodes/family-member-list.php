<?php
/**
 * Family list shortcode.
 */

if ( 1 != get_user_meta( get_current_user_id(), 'parent_id', true ) ) {
	return;
}
$memberlist = get_users(
	[
		'meta_key'   => 'parent_family_id',
		'meta_value' => get_current_user_id(),
	]
);

?>
<div class="table-responsive">

	<table class="table data-table table-striped">

		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Action</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ( $memberlist as $user ) : ?>
				<tr>
					<td>
						<?php echo esc_html( $user->user_login ); ?>
					</td>
					<td>
						<?php echo esc_html( $user->user_email ); ?>
					</td>
					<td>
						<a href="<?php echo home_url( '/dashboard/manage-membership/edit-family-member/?member_id=' . $user->ID ); ?>">Edit</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>

	</table>

</div>
