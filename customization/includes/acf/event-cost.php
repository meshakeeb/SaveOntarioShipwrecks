<?php
/**
 * ACF Fields for Events Cost
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
        'key' => 'bolt_event_cost',
        'title' => 'Cost',
        'fields' => array(
    

            array(
                'key' => '_EventCost',
                'name' => '_EventCost',                
                'label' => 'Cost',
                'type' => 'text',
                'required' => 0,
            ),            

            array(
                'key' => '_EventCurrencySymbol',
                'name' => '_EventCurrencySymbol',                
                'label' => 'Currency',
                'type' => 'text',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => '_EventCost',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
            ),

            array(
                'key' => '_EventCurrencyPosition',
                'name' => '_EventCurrencyPosition',                
                'label' => 'Currency Position',
                'type' => 'select',
                'required' => 1,
                'choices' => array(
                    'prefix' => 'Before cost',
                    'suffix' => 'After cost',
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => '_EventCurrencySymbol',
                            'operator' => '!=empty',
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
