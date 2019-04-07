<?php 
    $selected = get_user_meta( $user->ID, 'chapter', true ); 

    //print_r( get_user_meta( $user->ID ) );
?>
<div style="border: 3px solid #ccc; border-radius: 8px; background: #fff; padding: 15px;">
       <h3 class="dashicons-before dashicons-carrot"> Chapter Editor :: Custom Fields</h3>
        <table class="form-table">
        <tr>
            <th><label for="bolt_chapter">Chapter</label></th>
            <td>
                <select name="bolt_chapter" id="bolt_chapter" class="regular-text" />
                    <?php foreach( $this->chapter_list() as $chapter ) : ?>
                        <option value="<?php echo $chapter->ID;?>" <?php selected( $chapter->ID, $selected ); ?>><?php echo $chapter->post_title;?></option>
                     <?php endforeach; ?>   
                </select>    
                 <br />
                <span class="description"><?php _e("Select Chapter."); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="bolt_chapter">Profile Pic</label></th>
            <td>
                <?php
                    $profilePic = get_the_author_meta('bolt_profilePic', $_GET['user_id']);
                ?>
                <span id="imgHolder" style="display:block"><?php  echo  ($profilePic!="") ? wp_get_attachment_image($profilePic) : ''; ?></span>
                <input type="hidden" name="j_photo" value="Photo" /> <input class="btn btn-default photoUpload" type="button" value="Add Profile Image" />  
            </td>
        </tr>
        <?php if($pagenow === 'user-new.php') : ?>
        <tr>
            <th><label for="bolt_chapter">Phone:</label></th>
            <td>
                <input type="text" name="billing_phone"  />
            </td>
        </tr>   

        <tr>
            <th><label for="bolt_chapter">Address 1:</label></th>
            <td>
                <input type="text" name="billing_address_1"  />
            </td>
        </tr>  

        <tr>
            <th><label for="bolt_chapter">Address 2:</label></th>
            <td>
                <input type="text" name="billing_address_2"  />
            </td>
        </tr> 

        <tr>
            <th><label for="bolt_chapter">City:</label></th>
            <td>
                <input type="text" name="billing_city"  />
            </td>
        </tr>                          

        <tr>
            <th><label for="bolt_chapter">Zip:</label></th>
            <td>
                <input type="text" name="billing_postcode"  />
            </td>
        </tr> 

        <tr>
            <th><label for="bolt_chapter">Country:</label></th>
            <td>
                <input type="text" name="billing_country"  />
            </td>
        </tr>           

        <tr>
            <th><label for="bolt_chapter">State:</label></th>
            <td>
                <input type="text" name="billing_state"  />
            </td>
        </tr>  
         
        <?php endif; ?>    
        </table>      
</div>        

<script type="text/javascript">
function AppendImage(imageUrl){
  jQuery("#imgHolder").empty().prepend('<img src="'+imageUrl.replace(/^(.+)\.([^.]+)$/, '$1-150x150.$2')+'">');

}


jQuery(document).ready( function($) {
    //photo
    jQuery(".photoUpload").click(function () {
    uploadID = jQuery(this).prev('input');
    var formfield = jQuery('#upload_image').attr('name');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
    return false;
    });

  window.send_to_editor = function(html) {

    imgurl = jQuery('<div>'+html+'</div>').find('img').attr('src');
    class_string = jQuery('<div>'+html+'</div>').find('img').attr('class');
    var pathArray = html.match(/<media>(.*)<\/media>/);
    var mediaUrl = pathArray !== null && typeof pathArray[1] != 'undefined' ? pathArray[1] : '';


    var classes         = class_string.split( /\s+/ );
    var image_id        = 0;

    for ( var i = 0; i < classes.length; i++ ) {
        var source = classes[i].match(/wp-image-([0-9]+)/);
        if ( source && source.length > 1 ) {
            image_id = parseInt( source[1] );
        }
    }    

    if ( imgurl ){
      uploadID.val(image_id);
      AppendImage(imgurl);
    }

      tb_remove();

  };    

})


</script>   

