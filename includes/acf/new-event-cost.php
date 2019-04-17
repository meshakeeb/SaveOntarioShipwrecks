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
		],
	]
);
