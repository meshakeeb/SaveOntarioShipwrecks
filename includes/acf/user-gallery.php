<?php
/**
 * New User Gallery ACF fields.
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
		$current_user->has_cap( 'administrator' )
	)
) {
	$chapters = \Ontario\Choices::get_chapters();
}

acf_add_local_field_group(
	[
		'key'      => 'bolt_user_gallery',
		'title'    => 'User Gallery',
		'active'   => true,
		'location' => [
			[
				[
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'bolt_user_gallery',
				],
			],
		],
		'fields'   => [
			[
				'key'     => 'u_gallery_public',
				'name'    => 'u_gallery_public',
				'label'   => 'Make this Gallery available to Public?',
				'type'    => 'checkbox',
				'choices' => [ 1 => 'Yes' ],
			],

			[
				'key'      => 'u_gallery_name',
				'name'     => 'u_gallery_name',
				'label'    => 'Gallery Name',
				'type'     => 'text',
				'required' => 1,
			],

			[
				'key'           => 'u_gallery_chapter',
				'name'          => 'u_gallery_chapter',
				'label'         => 'Chapter',
				'type'          => 'select',
				'required'      => 1,
				'choices'       => $chapters,
				'default_value' => $current_user->chapter,
			],

			[
				'key'      => 'u_gallery_images',
				'name'     => 'u_gallery_images',
				'label'    => 'Gallery Images',
				'type'     => 'gallery',
				'required' => 1,
				'min'      => 1,
			],

			[
				'key'      => 'u_gallery_notes',
				'name'     => 'u_gallery_notes',
				'label'    => 'Gallery Notes',
				'type'     => 'textarea',
				'required' => 0,
			],
		],
	]
);
