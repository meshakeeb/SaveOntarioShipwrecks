<?php
    $userID = $_GET['u'];
    $checked  = ( isset($userinfo_meta['newslatter']) && $userinfo_meta['newslatter'][0] === "on" )? ' checked="checked"' : "";

    $checked2  = ( isset($userinfo_meta['newslatter']) && $userinfo_meta['global_newslatter'][0] === "on" )? ' checked="checked"' : "";    
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form method="post" id="userinfo_edit" action="<?php echo admin_url('admin-ajax.php'); ?>">

    <p>First Name: <input type="text" name="billing_first_name" value="<?php echo $userinfo_meta['billing_first_name'][0]; ?>" class="form-control"> </p>
    <p>Last Name: <input type="text" name="billing_last_name" value="<?php echo $userinfo_meta['billing_last_name'][0]; ?>" class="form-control"> </p>
    <p>Address: <input type="text" name="billing_address_1" value="<?php echo $userinfo_meta['billing_address_1'][0]; ?>" class="form-control"> </p>
    <p>City: <input type="text" name="billing_city" value="<?php echo $userinfo_meta['billing_city'][0]; ?>" class="form-control"> </p>
    <p>Postal Code: <input type="text" name="billing_postcode" value="<?php echo $userinfo_meta['billing_postcode'][0]; ?>" class="form-control"> </p>
    <p>Phone: <input type="text" name="billing_phone" value="<?php echo $userinfo_meta['billing_phone'][0]; ?>" class="form-control"> </p>


    <p><label><strong>Newsletter</strong>: </label><br>
        <input type="checkbox" id="newslatter" name="newslatter" value="on" <?php echo $checked;?>> Subscribe in Chapter Newsletter? <br>
        <input type="checkbox" id="global_newslatter" name="global_newslatter" value="on" <?php echo $checked2;?>> Subscribe in Global Newsletter?
    
    </p>
    
    <input type="hidden" name="userID" value="<?php echo $userID; ?>">
    <input type="hidden" name="action" value="userinfo_edit">
    <?php wp_nonce_field( 'userinfo_edit_nonce', 'nonce_field' ); ?>

    <p><button class="btn btn-primary pull-right">Save</button></p>    
</form>


<script type="text/javascript">

jQuery(document).ready( function($) {

    $('#userinfo_edit').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        $.post($form.attr('action'), $form.serialize(), function(data) {
            $form.append(data);
        }, 'json');
    });


})


</script>   


