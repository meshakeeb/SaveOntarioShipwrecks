<?php
/**
 * New Event ACF fields.
 *
 * @since      1.0.0
 * @package    Ontario
 * @subpackage Ontario\ACF
 * @author     BoltMedia <info@boltmedia.ca>
 */

$chapters     = [];
$current_user = wp_get_current_user();

if (
	$current_user &&
	(
		$current_user->has_cap( 'provincial_membership' ) ||
		$current_user->has_cap( 'administrator' ) ||
		$current_user->has_cap( 'board' )
	)
) {
	$chapters = \Ontario\Choices::get_chapters( 'post_name' );
}

acf_add_local_field_group(
	[
		'key'    => 'bolt_user_events',
		'title'  => 'Events',
		'active' => true,
		'fields' => [
			[
				'key'      => '_thumbnail_id',
				'name'     => '_thumbnail_id',
				'label'    => 'Event Image',
				'type'     => 'image',
				'required' => 0,
			],

			[
				'key'           => 'event_category',
				'name'          => 'event_category',
				'label'         => 'Chapter',
				'type'          => 'select',
				'required'      => 1,
				'choices'       => $chapters,
				'default_value' => get_post_field( 'post_name', $current_user->chapter ),
			],

			[
				'key'               => '_EventStartDate',
				'name'              => '_EventStartDate',
				'label'             => 'Event Start Date',
				'type'              => 'date_time_picker',
				'instructions'      => '',
				'required'          => 1,
				'conditional_logic' => 0,
				'wrapper'           => [
					'class' => 'col-sm-6',
				],
				'display_format'    => 'F j, Y H:i:s',
				'return_format'     => 'Y-m-d H:i:s',
				'first_day'         => 1,
			],

			[
				'key'            => '_EventEndDate',
				'name'           => '_EventEndDate',
				'label'          => 'Event End Date',
				'type'           => 'date_time_picker',
				'required'       => 1,
				'wrapper'        => [
					'width' => '49%',
					'class' => 'col-sm-6',
				],
				'display_format' => 'F j, Y H:i:s',
				'return_format'  => 'Y-m-d H:i:s',
			],
		],
	]
);
