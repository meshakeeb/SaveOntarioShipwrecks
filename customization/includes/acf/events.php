<?php
/**
 * ACF Fields for Add Events page
 *
 * PHP version 7.1.2
 *
 * @category Null
 * @package  SOS_Customizations
 * @author   Japol <japol69@gmail.com>
 * @license  N/A 
 * @link     http://www.boltmedia.ca 
 */

$all_chapters = $bolt->chapter_list();
$user = get_current_user_id();
$chapters = array();

$user_meta = get_user_meta($user);
$user_role = get_userdata($user);
$chapters[ $user_meta['chapter'][0] ]= get_the_title($user_meta['chapter'][0]);

if ($user_role && ( empty($chapters) 
    || in_array("provincial_membership", $user_role->roles) 
    || in_array("administrator", $user_role->roles)  
    || in_array("board", $user_role->roles) )  
) {
    foreach ($all_chapters as $chapter) {
        $chapters[$chapter->post_name] = $chapter->post_title;
    }
}


acf_add_local_field_group(
    array(
    'key' => 'bolt_user_events',
    'title' => 'Events',
    'fields' => array(

        array(
            'key' => '_thumbnail_id',
            'name' => '_thumbnail_id',
            'label' => 'Event Image',
            'type' => 'image',
            'required' => 0,
        ),        

        array(
            'key' => 'event_category',
            'name' => 'event_category',
            'label' => 'Chapter',
            'type' => 'select',
            'required' => 1,
            'choices' => $chapters,         
        ),      

        array(
            'key' => '_EventStartDate',
            'name' => '_EventStartDate',
            'label' => 'Event Start Date',            
            'type' => 'date_time_picker',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '40%',
                'class' => 'col-sm-6',
                'id' => '',
            ),
            'display_format' => 'F j, Y H:i:s',
            'return_format' => 'Y-m-d H:i:s',
            'first_day' => 1,             
        ),

        array(
            'key' => '_EventEndDate',
            'name' => '_EventEndDate',
            'label' => 'Event End Date',
            'type' => 'date_time_picker',
            'required' => 1,
            'wrapper' => array(
                'width' => '40%',
                'class' => 'col-sm-6',
                'id' => '',
            ),            
            'display_format' => 'F j, Y H:i:s',
            'return_format' => 'Y-m-d H:i:s',                
        ),   
            
        

    ),
    
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'test-japol',
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
    )
);
