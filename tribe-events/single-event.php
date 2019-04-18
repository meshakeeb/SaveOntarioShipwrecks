<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.3
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();
?>
<div class="event-block">

	<div class="row">

		<div class="col-sm-8">
			<?php echo tribe_event_featured_image( get_the_ID(), 'full', false ); ?>
		</div>

		<div class="col-sm-4">
			<ul>
				<?php tribe_get_template_part( 'modules/meta/details' ); ?>
				<?php tribe_get_template_part( 'modules/meta/venue' ); ?>
			</ul>

			<?php if ( tribe_get_cost() ) : ?>
				<span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ); ?></span>
			<?php endif; ?>

			<?php do_action( 'tribe_events_single_event_after_the_meta' ); ?>

		</div>
	</div>
</div>

<div class="map-block">
	<?php the_title( '<h4>', '</h4>' ); ?>
	<?php the_content(); ?>
	<?php tribe_get_template_part( 'modules/meta/map' ); ?>
</div>
