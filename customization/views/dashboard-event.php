<?php
// Delete news.
$delete_id = isset( $_GET['delete_event_id'] ) ? absint( $_GET['delete_event_id'] ) : 0;
if ( $delete_id > 0 ) {
	wp_delete_post( $delete_id, true );
}
?>
<div class="form-block">

	<form id="post" class="acf-form" action="" method="post">

		<div class="panel-group">

			<div class="panel panel-default">

				<div class="panel-heading">

					<h4 class="panel-title">
						<a data-toggle="collapse" href="#details">Event Details</a>
					</h4>

				</div>

				<div id="details" class="panel-collapse collapse in">

					<div class="panel-body">

						<?php
						function validate_form_args( $args ) {
							$args['new_post'] = array(
								'post_type'   => 'tribe_events',
								'post_status' => 'publish',
							);

							$args['post_id'] = isset( $_GET['event_id'] ) ? absint( $_GET['event_id'] ) : 'new_post';

							return $args;
						}
						add_action( 'acf/validate_form', 'validate_form_args' );
						acf_form(
							array(
								'id'                   => 'bolt_user_events',
								'post_id'              => 'new_post',
								'new_post'             => array(
									'post_type'   => 'tribe_events',
									'post_status' => 'publish',
								),
								'post_title'           => true,
								'post_content'         => true,
								'form'                 => false,
								'field_groups'         => array( 'bolt_user_events' ),
								'html_updated_message' => '<div class="alert alert-success">Event Added</div>',
								'submit_value'         => 'Submit',
							)
						);
						?>

					</div>

				</div>

			</div>

			<div class="panel panel-default">

				<div class="panel-heading">

					<h4 class="panel-title">
						<a data-toggle="collapse" href="#venue">Venue</a>
					</h4>

				</div>

				<div id="venue" class="panel-collapse panel-collapse">

					<div class="panel-body">
					<?php
					acf_form(
						array(
							'id'                   => 'bolt_event_venues',
							'post_id'              => false,
							'new_post'             => false,
							'post_title'           => false,
							'post_content'         => false,
							'form'                 => false,
							'field_groups'         => array( 'bolt_event_venues' ),
							'html_updated_message' => null,
						)
					);
					?>
					</div>

				</div>

			</div>

			<div class="panel panel-default">

				<div class="panel-heading">

					<h4 class="panel-title">
						<a data-toggle="collapse" href="#organizer">Organizer</a>
					</h4>

				</div>

				<div id="organizer" class="panel-collapse collapse">
					<div class="panel-body">
					<?php
					acf_form(
						array(
							'id'                   => 'bolt_event_organizer',
							'post_id'              => false,
							'new_post'             => false,
							'post_title'           => false,
							'post_content'         => false,
							'form'                 => false,
							'field_groups'         => array( 'bolt_event_organizer' ),
							'html_updated_message' => null,
						)
					);
					?>
					</div>
				</div>

			</div>

			<div class="panel panel-default">

				<div class="panel-heading">

					<h4 class="panel-title">
						<a data-toggle="collapse" href="#cost">Cost</a>
					</h4>

				</div>

				<div id="cost" class="panel-collapse collapse">

					<div class="panel-body">

					<?php
					acf_form(
						array(
							'id'                   => 'bolt_event_cost',
							'post_id'              => false,
							'new_post'             => false,
							'post_title'           => false,
							'post_content'         => false,
							'form'                 => false,
							'field_groups'         => array( 'bolt_event_cost' ),
							'html_updated_message' => null,
						)
					);
					?>

					</div>

				</div>

			</div>

		</div>

		<div class="acf-form-submit">

			<p align="center">
				<input type="submit" class="acf-button button button-primary button-large btn button-primary" value="Submit">
				<span class="acf-spinner"></span>
			</p>

		</div>

	</form>

</div>

<div class="form-block">

	<?php
	$events = tribe_get_events(
		array(
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
			'tax_query'      => [
				[
					'taxonomy' => 'tribe_events_cat',
					'field'    => 'slug',
					'terms'    => get_post_field( 'post_name', $user_info->data->chapter ),
				],
			],
		)
	);
	?>
	<h3>Chapter Events</h3>

	<ul class="list-group">
	<?php
	foreach ( $events as $event ) :
		$edit_url   = home_url( 'dashboard/add-event/?event_id=' );
		$delete_url = home_url( 'dashboard/add-event/?delete_event_id=' );
		?>
		<li class="list-group-item"><?php echo $event->post_title; ?> <a href="<?php echo $delete_url . $event->ID; ?>" class="badge badge-error">Delete</a> <a href="<?php echo $edit_url . $event->ID; ?>" class="badge badge-error">Edit</a></li>
	<?php endforeach; ?>
	</ul>

</div>
