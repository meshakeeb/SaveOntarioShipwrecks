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
							'post_id'              => 'new_post',
							'new_post'             => array(
								'post_type'   => 'tribe_events',
								'post_status' => 'publish',
							),
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
