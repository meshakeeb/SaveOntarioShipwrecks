<div class="form-block"> 
<?php 
    acf_form( 
        array( 
            'id'                    => 'group_5af0af59d7bd2', 
            'post_id'               => 'new_post',
            'new_post'              => array( 
                                        'post_type'   => 'buoystatus',
                                        'post_status' => 'publish',
                                        ),        
            'post_title'            => false,    
            'post_content'          => false,                                         
            'form'                  => true,
            'field_groups'          => array('group_5af0af59d7bd2'),
            'html_updated_message'  => '<div class="alert alert-success">Buoy Status Added</div>',
            'submit_value'          => 'Submit',
     
        ) 
    ); 
?>
</div>