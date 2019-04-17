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
				'key'               => '_EventCurrencySymbol',
				'name'              => '_EventCurrencySymbol',
				'label'             => 'Currency',
				'type'              => 'text',
				'required'          => 1,
				'conditional_logic' => [
					[
						[
							'field'    => '_EventCost',
							'operator' => '!=empty',
						],
					],
				],
			],

			[
				'key'               => '_EventCurrencyPosition',
				'name'              => '_EventCurrencyPosition',
				'label'             => 'Currency Position',
				'type'              => 'select',
				'required'          => 1,
				'choices'           => [
					'prefix' => 'Before cost',
					'suffix' => 'After cost',
				],
				'conditional_logic' => [
					[
						[
							'field'    => '_EventCurrencySymbol',
							'operator' => '!=empty',
						],
					],
				],
			],
		],
	]
);
