<?php
/**
 * New Event Venue ACF fields.
 *
 * @since      1.0.0
 * @package    Ontario
 * @subpackage Ontario\ACF
 * @author     BoltMedia <info@boltmedia.ca>
 */

acf_add_local_field_group(
	[
		'key'    => 'bolt_event_venues',
		'title'  => 'Venues',
		'active' => true,
		'fields' => [
			[
				'key'               => '_EventVenueID',
				'name'              => '_EventVenueID',
				'label'             => 'Venue',
				'type'              => 'post_object',
				'required'          => 0,
				'conditional_logic' => 0,
				'post_type'         => [
					0 => 'tribe_venue',
				],
				'taxonomy'          => '',
				'allow_null'        => 1,
				'multiple'          => 0,
				'return_format'     => 'id',
				'ui'                => 1,
			],

			[
				'key'               => 'venue_name',
				'name'              => 'venue_name',
				'label'             => 'Venue Name',
				'type'              => 'text',
				'required'          => 1,
				'conditional_logic' => [
					[
						[
							'field'    => '_EventVenueID',
							'operator' => '==empty',
						],
					],
				],
			],

			[
				'key'               => '_VenueAddress',
				'name'              => '_VenueAddress',
				'label'             => 'Address',
				'type'              => 'text',
				'required'          => 1,
				'conditional_logic' => [
					[
						[
							'field'    => '_EventVenueID',
							'operator' => '==empty',
						],
					],
				],
			],

			[
				'key'               => '_VenueCity',
				'name'              => '_VenueCity',
				'label'             => 'City',
				'type'              => 'text',
				'required'          => 1,
				'conditional_logic' => [
					[
						[
							'field'    => '_EventVenueID',
							'operator' => '==empty',
						],
					],
				],
			],

			[
				'key'               => '_VenueCountry',
				'name'              => '_VenueCountry',
				'label'             => 'Country',
				'type'              => 'select',
				'required'          => 1,
				'choices'           => [
					'Canada' => 'Canada',
				],
				'conditional_logic' => [
					[
						[
							'field'    => '_EventVenueID',
							'operator' => '==empty',
						],
					],
				],
			],

			[
				'key'               => '_VenueProvince',
				'name'              => '_VenueProvince',
				'label'             => 'State or Province',
				'type'              => 'text',
				'required'          => 1,
				'conditional_logic' => [
					[
						[
							'field'    => '_EventVenueID',
							'operator' => '==empty',
						],
					],
				],
			],

			[
				'key'               => '_VenueZip',
				'name'              => '_VenueZip',
				'label'             => 'Postal Code',
				'type'              => 'text',
				'required'          => 1,
				'conditional_logic' => [
					[
						[
							'field'    => '_EventVenueID',
							'operator' => '==empty',
						],
					],
				],
			],

			[
				'key'               => '_EventShowMap',
				'label'             => '',
				'name'              => '_EventShowMap',
				'type'              => 'checkbox',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => [
					[
						[
							'field'    => '_EventVenueID',
							'operator' => '==empty',
						],
					],
				],
				'choices'           => [ 1 => 'Show Map' ],
				'allow_custom'      => 0,
				'layout'            => 'vertical',
				'toggle'            => 0,
				'return_format'     => 'value',
				'save_custom'       => 0,
			],

			[
				'key'               => '_VenueOverwriteCoords',
				'name'              => '_VenueOverwriteCoords',
				'label'             => '',
				'type'              => 'hidden',
				'required'          => 0,
				'default_value'     => '1',
				'conditional_logic' => [
					[
						[
							'field'    => '_EventVenueID',
							'operator' => '==empty',
						],
					],
				],
			],

			[
				'key'               => '_VenueLocation',
				'label'             => 'Location',
				'name'              => '_VenueLocation',
				'type'              => 'google_map',
				'instructions'      => '',
				'required'          => 1,
				'conditional_logic' => [
					[
						[
							'field'    => '_EventShowMap',
							'operator' => '==',
							'value'    => '1',
						],
					],
				],
			],
		],
	]
);
