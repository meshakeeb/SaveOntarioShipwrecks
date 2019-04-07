<?php
/**
 * ACF Fields for Events Venue
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
        'key' => 'bolt_event_venues',
        'title' => 'Venues',
        'fields' => array(
            array(
                'key' => '_EventVenueID',
                'name' => '_EventVenueID',                
                'label' => 'Venue',
                'type' => 'post_object',
                'required' => 0,
                'conditional_logic' => 0,
                'post_type' => array(
                    0 => 'tribe_venue',
                ),
                'taxonomy' => '',
                'allow_null' => 1,
                'multiple' => 0,
                'return_format' => 'id',
                'ui' => 1,
            ),

            array(
                'key' => 'venue_name',
                'name' => 'venue_name',                
                'label' => 'Venue Name',
                'type' => 'text',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => '_EventVenueID',
                            'operator' => '==empty',
                        ),
                    ),
                ),
            ),            

            array(
                'key' => '_VenueAddress',
                'name' => '_VenueAddress',                
                'label' => 'Address',
                'type' => 'text',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => '_EventVenueID',
                            'operator' => '==empty',
                        ),
                    ),
                ),
            ),

            array(
                'key' => '_VenueCity',
                'name' => '_VenueCity',                
                'label' => 'City',
                'type' => 'text',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => '_EventVenueID',
                            'operator' => '==empty',
                        ),
                    ),
                ),
            ),    

            array(
                'key' => '_VenueCountry',
                'name' => '_VenueCountry',                
                'label' => 'Country',
                'type' => 'select',
                'required' => 1,
                'choices' => array(
                    'Canada' => 'Canada',
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => '_EventVenueID',
                            'operator' => '==empty',
                        ),
                    ),
                ),
            ),     

            array(
                'key' => '_VenueProvince',
                'name' => '_VenueProvince',                
                'label' => 'State or Province',
                'type' => 'text',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => '_EventVenueID',
                            'operator' => '==empty',
                        ),
                    ),
                ),
            ),   

            array(
                'key' => '_VenueZip',
                'name' => '_VenueZip',                
                'label' => 'Postal Code',
                'type' => 'text',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => '_EventVenueID',
                            'operator' => '==empty',
                        ),
                    ),
                ),
            ),  


        array(
            'key' => '_EventShowMap',
            'label' => '',
            'name' => '_EventShowMap',
            'type' => 'checkbox',
            'instructions' => '',
            'required' => 0,
            'choices' => array(
                '1'   => '1'
            ),            
            'conditional_logic' => array(
                array(
                    array(
                        'field' => '_EventVenueID',
                        'operator' => '==empty',
                    ),
                ),
            ),
            'choices' => array(
                1 => 'Show Map',
            ),
            'allow_custom' => 0,
            'default_value' => array(
            ),
            'layout' => 'vertical',
            'toggle' => 0,
            'return_format' => 'value',
            'save_custom' => 0,
        ),

        array(
            'key' => '_VenueOverwriteCoords',
            'name' => '_VenueOverwriteCoords',                
            'label' => '',
            'type' => 'hidden',
            'required' => 0,
            'default_value' => '1',
            'conditional_logic' => array(
                array(
                    array(
                        'field' => '_EventVenueID',
                        'operator' => '==empty',
                    ),
                ),
            ),
        ),    

        array(
            'key' => '_VenueLat',
            'label' => 'Latitude',
            'name' => '_VenueLat',
            'type' => 'text',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => '_EventShowMap',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '50%',
                'class' => 'col-sm-6'
            ),
        ),

        array(
            'key' => '_VenueLng',
            'label' => 'Longtitude',
            'name' => '_VenueLng',
            'type' => 'text',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => '_EventShowMap',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '50%',
                'class' => 'col-sm-6'                
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
