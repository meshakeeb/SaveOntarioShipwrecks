<?php
/**
 * New Event Cost ACF fields.
 *
 * @since      1.0.0
 * @package    Ontario
 * @subpackage Ontario\ACF
 * @author     BoltMedia <info@boltmedia.ca>
 */

$event_id   = isset( $_GET['event_id'] ) ? $_GET['event_id'] : false;
$event_cost = $event_id ? get_post_meta( $event_id, '_EventCost', true ) : 0;
$ticket     = Tribe__Tickets__Tickets::get_event_tickets( $event_id );
$ticket     = ! empty( $ticket ) && isset( $ticket[0] ) ? $ticket[0] : false;

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
				'value'    => $event_cost,
			],

			[
				'key'         => 'ticket_id',
				'name'        => 'ticket_id',
				'type'        => 'text',
				'required'    => 0,
				'save_custom' => 0,
				'value'       => $ticket ? $ticket->ID : 0,
				'wrapper'     => [ 'class' => ' hidden' ],
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
				'value'             => $ticket ? '1' : '0',
			],

			[
				'key'               => '_TicketType',
				'name'              => '_TicketType',
				'label'             => 'Type',
				'type'              => 'text',
				'required'          => 0,
				'instructions'      => 'Ticket type name shows on the front end and emailed tickets',
				'value'             => $ticket ? $ticket->name : '',
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
				'value'             => $ticket && $ticket->capacity > 0 ? $ticket->capacity : '',
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
