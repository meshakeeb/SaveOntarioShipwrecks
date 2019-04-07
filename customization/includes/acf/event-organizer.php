<?php
/**
 * ACF Fields for Events Organizer
 *
 * PHP version 7.1.2
 *
 * @category Null
 * @package  SOS_Customizations
 * @author   Japol <japol69@gmail.com>
 * @license  N/A 
 * @link     http://www.boltmedia.ca 
 */


acf_add_local_field_group(
    array(
        'key' => 'bolt_event_organizer',
        'title' => 'Venues',
        'fields' => array(
            array(
                'key' => '_EventOrganizerID',
                'name' => '_EventOrganizerID',                
                'label' => 'Organizer',
                'type' => 'post_object',
                'required' => 0,
                'conditional_logic' => 0,
                'post_type' => array(
                    0 => 'tribe_organizer',
                ),
                'taxonomy' => '',
                'allow_null' => 1,
                'multiple' => 0,
                'return_format' => 'id',
                'ui' => 1,
            ),

            array(
                'key' => 'organizer_name',
                'name' => 'organizer_name',                
                'label' => 'Name',
                'type' => 'text',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => '_EventOrganizerID',
                            'operator' => '==empty',
                        ),
                    ),
                ),
            ),            

            array(
                'key' => '_OrganizerPhone',
                'name' => '_OrganizerPhone',                
                'label' => 'Phone',
                'type' => 'text',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => '_EventOrganizerID',
                            'operator' => '==empty',
                        ),
                    ),
                ),
            ),            

            array(
                'key' => '_OrganizerWebsite',
                'name' => '_OrganizerWebsite',                
                'label' => 'Website',
                'type' => 'text',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => '_EventOrganizerID',
                            'operator' => '==empty',
                        ),
                    ),
                ),
            ),

            array(
                'key' => '_OrganizerEmail',
                'name' => '_OrganizerEmail',                
                'label' => 'Email',
                'type' => 'text',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => '_EventOrganizerID',
                            'operator' => '==empty',
                        ),
                    ),
                ),
            ),    




        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'xxxxxxx',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    )
);
