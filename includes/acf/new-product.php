<?php
/**
 * Member document ACF fields.
 *
 * @since      1.0.0
 * @package    Ontario
 * @subpackage Ontario\ACF
 * @author     BoltMedia <info@boltmedia.ca>
 */

acf_add_local_field_group(
	[
		'key'            => 'group_5cafbbdbacb14',
		'title'          => 'New Product',
		'hide_on_screen' => '',
		'active'         => 1,
		'fields'         => [
			[
				'key'           => 'field_5cafbc02bf9c3',
				'label'         => 'Product Category',
				'name'          => 'product_cat',
				'type'          => 'taxonomy',
				'required'      => 1,
				'taxonomy'      => 'product_cat',
				'field_type'    => 'multi_select',
				'allow_null'    => 0,
				'add_term'      => 1,
				'save_terms'    => 1,
				'load_terms'    => 1,
				'return_format' => 'id',
				'multiple'      => 0,
			],
			[
				'key'           => 'field_5cafc203d5543',
				'label'         => 'Thumbnail',
				'name'          => '_thumbnail_id',
				'type'          => 'image',
				'return_format' => 'id',
				'preview_size'  => 'thumbnail',
				'library'       => 'all',
			],
		],
	]
);
