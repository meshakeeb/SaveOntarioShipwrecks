<?php
/**
 * New Event Organizer ACF fields.
 *
 * @since      1.0.0
 * @package    Ontario
 * @subpackage Ontario\ACF
 * @author     BoltMedia <info@boltmedia.ca>
 */

$event_id     = isset( $_GET['event_id'] ) ? $_GET['event_id'] : false;
$organizer_id = $event_id ? get_post_meta( $event_id, '_EventOrganizerID', true ) : 0;

acf_add_local_field_group(
	[
		'key'    => 'bolt_event_organizer',
		'title'  => 'Venues',
		'active' => true,
		'fields' => [
			[
				'key'               => '_EventOrganizerID',
				'name'              => '_EventOrganizerID',
				'label'             => 'Organizer',
				'type'              => 'post_object',
				'required'          => 0,
				'conditional_logic' => 0,
				'post_type'         => [ 0 => 'tribe_organizer' ],
				'taxonomy'          => '',
				'allow_null'        => 1,
				'multiple'          => 0,
				'return_format'     => 'id',
				'ui'                => 1,
				'value'             => $organizer_id,
			],

			[
				'key'               => 'organizer_name',
				'name'              => 'organizer_name',
				'label'             => 'Name',
				'type'              => 'text',
				'required'          => 1,
				'conditional_logic' => [
					[
						[
							'field'    => '_EventOrganizerID',
							'operator' => '==empty',
						],
					],
				],
			],

			[
				'key'               => '_OrganizerPhone',
				'name'              => '_OrganizerPhone',
				'label'             => 'Phone',
				'type'              => 'text',
				'required'          => 1,
				'conditional_logic' => [
					[
						[
							'field'    => '_EventOrganizerID',
							'operator' => '==empty',
						],
					],
				],
			],

			[
				'key'               => '_OrganizerWebsite',
				'name'              => '_OrganizerWebsite',
				'label'             => 'Website',
				'type'              => 'text',
				'required'          => 1,
				'conditional_logic' => [
					[
						[
							'field'    => '_EventOrganizerID',
							'operator' => '==empty',
						],
					],
				],
			],

			[
				'key'               => '_OrganizerEmail',
				'name'              => '_OrganizerEmail',
				'label'             => 'Email',
				'type'              => 'text',
				'required'          => 1,
				'conditional_logic' => [
					[
						[
							'field'    => '_EventOrganizerID',
							'operator' => '==empty',
						],
					],
				],
			],
		],
	]
);
