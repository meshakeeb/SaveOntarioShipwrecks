<?php
/**
 * New Event Cost ACF fields.
 *
 * @since      1.0.0
 * @package    Ontario
 * @subpackage Ontario\ACF
 * @author     BoltMedia <info@boltmedia.ca>
 */

acf_add_local_field_group(
	[
		'key'    => 'bolt_event_cost',
		'title'  => 'Cost',
		'active' => true,
		'fields' => [
			[
				'key'      => '_EventCost',
				'name'     => '_EventCost',
				'label'    => 'Cost',
				'type'     => 'text',
				'required' => 0,
			],

			[
				'key'               => 'has_payment',
				'label'             => '',
				'name'              => 'has_payment',
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
				'choices'           => [ 1 => 'Enable Payment' ],
				'allow_custom'      => 0,
				'layout'            => 'vertical',
				'toggle'            => 0,
				'return_format'     => 'value',
				'save_custom'       => 0,
			],

			[
				'key'               => '_TicketType',
				'name'              => '_TicketType',
				'label'             => 'Type',
				'type'              => 'text',
				'required'          => 0,
				'instructions'      => 'Ticket type name shows on the front end and emailed tickets',
				'conditional_logic' => [
					[
						[
							'field'    => 'has_payment',
							'operator' => '==',
							'value'    => '1',
						],
					],
				],
			],

			[
				'key'               => '_TicketCapacity',
				'name'              => '_TicketCapacity',
				'label'             => 'Capacity',
				'type'              => 'text',
				'required'          => 0,
				'instructions'      => 'Leave blank for unlimited',
				'conditional_logic' => [
					[
						[
							'field'    => 'has_payment',
							'operator' => '==',
							'value'    => '1',
						],
					],
				],
			],
		],
	]
);
