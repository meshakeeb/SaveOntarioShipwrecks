
<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php'); ?>
<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

    /*
     * HTML output for register form
     *
     * @param $atts     - is available from parent file, in the register_form method of the PMS_Shortcodes class
     */
    $form_name = 'register';
?>

<form id="pms_<?php echo $form_name; ?>-form" class="pms-form" method="POST">
<div class="form-block">
                            <h3>Account information</h3>

    <?php do_action( 'pms_' . $form_name . '_form_top', $atts ); ?>

    <?php wp_nonce_field( 'pms_' . $form_name . '_form_nonce', 'pmstkn' ); ?>

    <ul class="pms-form-fields-wrapper">

        <?php

        // Start catching the subscription plan fields
        ob_start();

        $field_errors = pms_errors()->get_error_messages('subscription_plans');
       // echo '<li class="pms-field pms-field-subscriptions ' . (!empty($field_errors) ? 'pms-field-error' : '') . '">';

        $subscription_plans = pms_get_subscription_plans();

        // Add nonce field when subscription_plans='none' (to allow users to register without becoming members, selecting a subscription plan)
        if( empty( $subscription_plans ) || ( isset( $atts['subscription_plans'][0] ) && ( strtolower($atts['subscription_plans'][0]) == 'none' ) ) )

            wp_nonce_field( 'pms_register_user_no_subscription_nonce','pmstkn2');

        else

            echo pms_output_subscription_plans( $atts['subscription_plans'], array(), false, (isset($atts['selected']) ? trim($atts['selected']) : ''), 'register' );

       // echo '</li>';

        // Get the contents and clean
        $subscription_plans_field = ob_get_contents();
        ob_end_clean();

        // Display subscription plans at the bottom
        if( $atts['plans_position'] == 'top' )
            echo $subscription_plans_field;

        ?>


        <?php
            // Start catching the register form fields
            ob_start();
        ?>

        <?php do_action( 'pms_register_form_before_fields', $atts ); ?>

        <?php $field_errors = pms_errors()->get_error_messages('user_login'); ?>
        <li class="pms-field <?php echo ( !empty( $field_errors ) ? 'pms-field-error' : '' ); ?>">
            <label for="pms_user_login"><?php echo apply_filters( 'pms_register_form_label_user_login', __( 'Username *', 'paid-member-subscriptions' ) ); ?></label>
            <input id="pms_user_login" name="user_login" type="text" value="<?php echo ( isset( $_POST['user_login'] ) ? esc_attr( $_POST['user_login'] ) : '' ); ?>" />

            <?php pms_display_field_errors( $field_errors ); ?>
      <small>Spaces are allowed; punctuation is not allowed except for periods, hyphens, and underscores.</small>
        </li>

        <?php $field_errors = pms_errors()->get_error_messages('user_email'); ?>
        <li class="pms-field <?php echo ( !empty( $field_errors ) ? 'pms-field-error' : '' ); ?>">
            <label for="pms_user_email"><?php echo apply_filters( 'pms_register_form_label_user_email', __( 'E-mail *', 'paid-member-subscriptions' ) ); ?></label>
            <input id="pms_user_email" name="user_email" type="text" value="<?php echo ( isset( $_POST['user_login'] ) ? esc_attr( $_POST['user_email'] ) : '' ); ?>" />
<small>A valid e-mail address. All e-mails from the system will be sent to this address. The e-mail address is not made public and will only be used if you wish to receive a new password or wish to receive certain news or notifications by e-mail.</small>
            <?php pms_display_field_errors( $field_errors ); ?>
        </li>

<div class="row">
                                <div class="col-sm-6">
        <?php $field_errors = pms_errors()->get_error_messages('pass1'); ?>
        <li class="pms-field <?php echo ( !empty( $field_errors ) ? 'pms-field-error' : '' ); ?>">
           <!-- <label for="pms_pass1"><?php echo apply_filters( 'pms_register_form_label_pass1', __( 'Password *', 'paid-member-subscriptions' ) ); ?></label>-->
            <input id="pms_pass1" name="pass1" type="password" placeholder="Password *"/>

            <?php pms_display_field_errors( $field_errors ); ?>
        </li>
</div>
                                <div class="col-sm-6">
        <?php $field_errors = pms_errors()->get_error_messages('pass2'); ?>
        <li class="pms-field <?php echo ( !empty( $field_errors ) ? 'pms-field-error' : '' ); ?>">
           <!-- <label for="pms_pass2"><?php echo apply_filters( 'pms_register_form_label_pass2', __( 'Repeat Password *', 'paid-member-subscriptions' ) ); ?></label>-->
            <input id="pms_pass2" name="pass2" type="password" placeholder="Confirm Password *"/>

            <?php pms_display_field_errors( $field_errors ); ?>
        </li>
</div></div>
    </ul><small>Provide a password for the new account in both fields.</small>
</div><div class="form-block">
                            <h3>Membership Level</h3>

<div class="row">
        <?php do_action( 'pms_register_form_after_fields', $atts ); ?>

        <?php
            // Get form fields and clean the buffer
            $register_form_fields = ob_get_contents();
            ob_end_clean();

            if( $form_name == 'register' )
                echo $register_form_fields;
        ?>

        <?php
            // Display subscription plans at the bottom
            if( $atts['plans_position'] == 'bottom' )
                echo $subscription_plans_field;
        ?>

</div>
</div>
<div class="form-block">
    <h3>Personal Information</h3>
    <div class="row">
        <div class="col-sm-6">
            <?php $field_errors = pms_errors()->get_error_messages('first_name'); ?>
            <li class="pms-field <?php echo ( !empty( $field_errors ) ? 'pms-field-error' : '' ); ?>">
                <label for="pms_first_name"><?php echo apply_filters( 'pms_register_form_label_first_name', __( 'First Name', 'paid-member-subscriptions' ) ); ?></label>
                <input id="pms_first_name" name="first_name" type="text" value="<?php echo ( isset( $_POST['user_login'] ) ? esc_attr( $_POST['first_name'] ) : '' ); ?>" />
                <?php pms_display_field_errors( $field_errors ); ?>
            </li>
        </div>
        <div class="col-sm-6">
            <?php $field_errors = pms_errors()->get_error_messages('last_name'); ?>
            <li class="pms-field <?php echo ( !empty( $field_errors ) ? 'pms-field-error' : '' ); ?>">
                <label for="pms_last_name"><?php echo apply_filters( 'pms_register_form_label_last_name', __( 'Last Name', 'paid-member-subscriptions' ) ); ?></label>
                <input id="pms_last_name" name="last_name" type="text" value="<?php echo ( isset( $_POST['user_login'] ) ? esc_attr( $_POST['last_name'] ) : '' ); ?>" />
                <?php pms_display_field_errors( $field_errors ); ?>
            </li>
        </div>
        <div class="col-sm-6">
            <?php $field_errors = pms_errors()->get_error_messages('address'); ?>
            <li class="pms-field <?php echo ( !empty( $field_errors ) ? 'pms-field-error' : '' ); ?>">
                <label for="pms_address"><?php echo apply_filters( 'pms_register_form_label_last_name', __( 'Address', 'paid-member-subscriptions' ) ); ?></label>
                <input id="pms_address" name="address" type="text" value="<?php echo ( isset( $_POST['user_login'] ) ? esc_attr( $_POST['address'] ) : '' ); ?>" />
                <?php pms_display_field_errors( $field_errors ); ?>
            </li>
        </div>
        
        <div class="col-sm-6">
            <?php $field_errors = pms_errors()->get_error_messages('city'); ?>
            <li class="pms-field <?php echo ( !empty( $field_errors ) ? 'pms-field-error' : '' ); ?>">
                <label for="pms_city"><?php echo apply_filters( 'pms_register_form_label_city', __( 'City', 'paid-member-subscriptions' ) ); ?></label>
                <input id="pms_city" name="city" type="text" value="<?php echo ( isset( $_POST['user_login'] ) ? esc_attr( $_POST['city'] ) : '' ); ?>" />
                <?php pms_display_field_errors( $field_errors ); ?>
            </li>
        </div>
        <div class="col-sm-6">
            <?php $field_errors = pms_errors()->get_error_messages('postalcode'); ?>
            <li class="pms-field <?php echo ( !empty( $field_errors ) ? 'pms-field-error' : '' ); ?>">
                <label for="pms_postalcode"><?php echo apply_filters( 'pms_register_form_label_postalcode', __( 'Postal Code', 'paid-member-subscriptions' ) ); ?></label>
                <input id="pms_postalcode" name="postalcode" type="text" value="<?php echo ( isset( $_POST['user_login'] ) ? esc_attr( $_POST['postalcode'] ) : '' ); ?>" />
                <?php pms_display_field_errors( $field_errors ); ?>
            </li>
        </div>
        <div class="col-sm-6">
            <?php $field_errors = pms_errors()->get_error_messages('country'); ?>
            <li class="pms-field <?php echo ( !empty( $field_errors ) ? 'pms-field-error' : '' ); ?>">
                <label for="pms_country"><?php echo apply_filters( 'pms_register_form_label_country', __( 'Country', 'paid-member-subscriptions' ) ); ?></label>
                <input id="pms_country" name="country" type="text" value="<?php echo ( isset( $_POST['user_login'] ) ? esc_attr( $_POST['country'] ) : '' ); ?>" />
                <?php pms_display_field_errors( $field_errors ); ?>
            </li>
        </div>
        <div class="col-sm-6">
            <?php $field_errors = pms_errors()->get_error_messages('Province'); ?>
            <li class="pms-field <?php echo ( !empty( $field_errors ) ? 'pms-field-error' : '' ); ?>">
                <label for="pms_Province"><?php echo apply_filters( 'pms_register_form_label_country', __( 'Province', 'paid-member-subscriptions' ) ); ?></label>
                <input id="pms_Province" name="Province" type="text" value="<?php echo ( isset( $_POST['user_login'] ) ? esc_attr( $_POST['Province'] ) : '' ); ?>" />
                <?php pms_display_field_errors( $field_errors ); ?>
            </li>
        </div>
        <div class="col-sm-6">
            <?php $field_errors = pms_errors()->get_error_messages('Phonenumber'); ?>
            <li class="pms-field <?php echo ( !empty( $field_errors ) ? 'pms-field-error' : '' ); ?>">
                <label for="pms_Phonenumber"><?php echo apply_filters( 'pms_register_form_label_Phonenumber', __( 'Phone Number', 'paid-member-subscriptions' ) ); ?></label>
                <input id="pms_Phonenumber" name="Phonenumber" type="text" value="<?php echo ( isset( $_POST['user_login'] ) ? esc_attr( $_POST['Phonenumber'] ) : '' ); ?>" />
                <?php pms_display_field_errors( $field_errors ); ?>
            </li>
        </div>
    </div>
</div>

<div class="form-block">
                            <h3>Newsletters</h3>
                            
                            <p>Please help us fund important marine heritage projects by subscribing to the <br>electronic newsletter</p>

                            <div class="cbox">
                                <input type="checkbox" name="newslatter" >
                                <label>SOS Newsletter (E-mail)</label>
                            </div>                          
                            
                        </div>

<div class="form-block">
                            <h3>Member Information</h3>
    <?php $field_errors = pms_errors()->get_error_messages('chapter'); ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="custom-select">
                                        <select name="chapter" required>
                                            <option>Chapter *</option>
                                            <?php $args = array(
                                                        'post_type' => 'chapters',
                                                        'posts_per_page'   => -1,
                                                        'paged' => $paged
                                                    ); 
                                                    $events = get_posts( $args );

                                                    foreach($events as $event ) { 
                                                    ?>
                                            <option <?php if( isset($_POST['chapter']) && $_POST['chapter']==$event->ID){ echo 'selected'; } ?>   value="<?php echo $event->ID; ?>"><?php echo $event->post_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div><?php pms_display_field_errors( $field_errors ); ?>                               
                                </div>
                            </div>                          
                            
                            <small>Select which SOS Chapter you would like to belong to. If you are unsure select Provincial.</small>
                        </div>


<div class="form-block" style="display:none;">
                            <h3>Groups</h3>
                            
                            <p>You must join at least one group. Groups are like Facebook Groups allowing you to post <br>content and comments on your chapter website. Select from list below:</p>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="cbox">
                                        <input type="checkbox" name="03">
                                        <label>1000 Islands Group</label>
                                    </div>
                                    
                                    <div class="cbox">
                                        <input type="checkbox" name="03">
                                        <label>Barrie Group</label>
                                    </div>

                                    <div class="cbox">
                                        <input type="checkbox" name="03">
                                        <label>Hamilton Group</label>
                                    </div>

                                    <div class="cbox">
                                        <input type="checkbox" name="03">
                                        <label>Huron Shores Group</label>
                                    </div>

                                    <div class="cbox">
                                        <input type="checkbox" name="03">
                                        <label>Manitoulin Group</label>
                                    </div>
                                </div>
                            
                                <div class="col-sm-6">
                                    <div class="cbox">
                                        <input type="checkbox" name="03">
                                        <label>Ottawa Group</label>
                                    </div>
                                    
                                    <div class="cbox">
                                        <input type="checkbox" name="03">
                                        <label>Superior Group</label>
                                    </div>

                                    <div class="cbox">
                                        <input type="checkbox" name="03">
                                        <label>Toronto Group</label>
                                    </div>

                                    <div class="cbox">
                                        <input type="checkbox" name="03">
                                        <label>Windsor Group</label>
                                    </div>

                                </div>
                            </div>                          
                        </div>

<div class="form-block">
                            <h3>Terms</h3>

                            <div class="cbox">
                                <input type="checkbox" name="agree">
                                <label>I / We promise to abide by the SOS Code of Ethics *</label>
                            </div>          

                            <small>The Mission of Save Ontario Shipwrecks is the preservation and promotion of marine heritage through research, conservation and education. <a href="#" class="text-uppercase fw500">CLICK HERE TO VIEW THE CODE OF ETHICS</a></small>
                        </div>
    <?php do_action( 'pms_' . $form_name . '_form_bottom', $atts ); ?>

    <input name="pms_<?php echo $form_name; ?>" type="submit" value="<?php echo apply_filters( 'pms_' . $form_name . '_form_submit_text', __( 'Register', 'paid-member-subscriptions' ) ); ?>" />

</form>