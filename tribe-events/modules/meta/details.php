<?php
/**
 * Single Event Meta (Details) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */


$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );

$start_datetime = tribe_get_start_date();
$start_date = tribe_get_start_date( null, false );
$start_time = tribe_get_start_date( null, false, $time_format );
$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$end_datetime = tribe_get_end_date();
$end_date = tribe_get_display_end_date( null, false );
$end_time = tribe_get_end_date( null, false, $time_format );
$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$time_formatted = null;
if ( $start_time == $end_time ) {
	$time_formatted = esc_html( $start_time );
} else {
	$time_formatted = esc_html( $start_time . $time_range_separator . $end_time );
}

$event_id = Tribe__Main::post_id_helper();

/**
 * Returns a formatted time for a single event
 *
 * @var string Formatted time string
 * @var int Event post id
 */
$time_formatted = apply_filters( 'tribe_events_single_event_time_formatted', $time_formatted, $event_id );

/**
 * Returns the title of the "Time" section of event details
 *
 * @var string Time title
 * @var int Event post id
 */
$time_title = apply_filters( 'tribe_events_single_event_time_title', __( 'Time:', 'the-events-calendar' ), $event_id );

$cost = tribe_get_formatted_cost();
$website = tribe_get_event_website_link();
?>


	<h4> <?php esc_html_e( 'Details', 'the-events-calendar' ) ?> </h4>

			<li>
                <span><?php esc_html_e( 'Start:', 'the-events-calendar' ) ?></span>
                <p><?php esc_html_e( $start_date ) ?> </p>
            </li>
            
            <li>
                <span><?php esc_html_e( 'End:', 'the-events-calendar' ) ?></span>
                <p><?php esc_html_e( $end_date ) ?></p>
            </li>
    
            <li>
                <span><?php echo esc_html( $time_title ); ?></span>
                <p><?php echo $time_formatted; ?></p>
            </li>
    
    		<?php
		// Event Cost
		if ( ! empty( $cost ) ) : ?>
    
            <li>
                <span><?php esc_html_e( 'Cost:', 'the-events-calendar' ) ?></span>
                <p><?php esc_html_e( $cost ); ?></p>
            </li>
                
             <?php endif ?>   
    
    		<?php
		// Event Website
		if ( ! empty( $website ) ) : ?>
                
            <li>
                <span><?php esc_html_e( 'Website:', 'the-events-calendar' ) ?></span>
                <p><?php echo $website; ?></p>
            </li>
    
            <?php endif ?>