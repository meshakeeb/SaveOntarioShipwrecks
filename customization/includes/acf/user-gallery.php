<?php
$all_chapters = $bolt->chapter_list();
$user = get_current_user_id();
$chapters = array();

$user_meta = get_user_meta( $user );
$user_role = get_userdata( $user );
$chapters[ $user_meta['chapter'][0] ]= get_the_title( $user_meta['chapter'][0] ) ;

if ( $user_role && ( empty($chapters) ||  in_array("provincial_membership", $user_role->roles) || in_array("administrator", $user_role->roles) )  ){
	foreach (  $all_chapters as $chapter ){
		$chapters[$chapter->ID] = $chapter->post_title;
	}
}


acf_add_local_field_group(array(
	'key' => 'bolt_user_gallery',
	'title' => 'User Gallery',
	'fields' => array(

		array(
			'key' => 'u_gallery_public',
			'name' => 'u_gallery_public',
			'label' => 'Make this Gallery available to Public?',
			'type' => 'checkbox',
			'choices' => array(
				1	=> 'Yes'
			),			
		),		

		array(
			'key' => 'u_gallery_name',
			'name' => 'u_gallery_name',
			'label' => 'Gallery Name',
			'type' => 'text',
			'required' => 1,
		),

		array(
			'key' => 'u_gallery_chapter',
			'name' => 'u_gallery_chapter',
			'label' => 'Chapter',
			'type' => 'select',
			'required' => 1,
			'choices' => $chapters,			
		),		

		array(
			'key' => 'u_gallery_images',
			'name' => 'u_gallery_images',
			'label' => 'Gallery Images',
			'type' => 'gallery',
			'required' => 1,
			'min' => 1,
		),	

 		array(
			'key' => 'u_gallery_notes',
			'name' => 'u_gallery_notes',
			'label' => 'Gallery Notes',
			'type' => 'textarea',
			'required' => 0,
		),			

	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'bolt_user_gallery',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'left',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));
