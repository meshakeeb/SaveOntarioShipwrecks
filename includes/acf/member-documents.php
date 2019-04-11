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
		'key'      => 'group_5c9e5f1b6d247',
		'title'    => 'Member Documents',
		'location' => [
			[
				[
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'page-member-document.php',
				],
			],
		],
		'active'   => true,
		'fields'   => [
			[
				'key'          => 'field_5c9e6181857a0',
				'label'        => 'Documents',
				'name'         => 'documents',
				'type'         => 'repeater',
				'min'          => 0,
				'max'          => 0,
				'layout'       => '',
				'button_label' => 'Add Document Category',
				'sub_fields'   => [
					[
						'key'      => 'field_5c9e629380921',
						'label'    => 'Category Title',
						'name'     => 'category_title',
						'type'     => 'text',
						'required' => 1,
					],
					[
						'key'          => 'field_5c9e61f9ccf95',
						'label'        => 'Categories',
						'name'         => 'categories',
						'type'         => 'repeater',
						'layout'       => 'table',
						'button_label' => 'Add Documents',
						'sub_fields'   => [
							[
								'key'      => 'field_5c9e621bb229c',
								'label'    => 'Title',
								'name'     => 'title',
								'type'     => 'text',
								'required' => 1,
							],
							[
								'key'           => 'field_5c9e6225b229d',
								'label'         => 'File',
								'name'          => 'file',
								'type'          => 'file',
								'return_format' => 'id',
								'required'      => 1,
								'library'       => 'all',
							],
						],
					],
				],
			],
		],
	]
);
