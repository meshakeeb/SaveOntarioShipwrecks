<?php
/*
 * Template Name: Edit Entry
 */
 if ( is_user_logged_in() || current_user_can('publish_posts') ) { // Execute code if user is logged in
     acf_form_head();
     wp_deregister_style( 'wp-admin' );
 }
get_header(); ?>
<!-- Start Body Content -->
<div id="content" class="content full">
    <div class="container">
       <div class="row">
           <?php
           if ( ! ( is_user_logged_in() || current_user_can('publish_posts') ) ) {
                 echo '<p>You must be a registered author to add content.</p>';
           } else {
                 $uri = $_SERVER['REQUEST_URI']; # Get the the post_id from the url
                 $post_id = substr( $uri, strpos( $uri, "=" ) + 1 );
                 echo "<script>console.log('Post ID: ".$post_id."');</script>";
                 acf_form( array(
                       'post_id' => $post_id , # post_id to edit
                       'field_groups' => array(120173), # Insert your field group ID
                       'post_title' => false, # this is about the default title field
                       'post_content' => false, # and this is the default content editor
                       'form' => true,
                       'new_post' => array(
                           'post_type' => 'product', # you can do it with any post_type, I use the product one
                           'post_status' => 'publish' // You may use other post statuses like draft, private etc.
                       ),
                       'return' => '%post_url%',
                       'submit_value' => 'Save Changes',
                 ));
           } ?>

       </div>
   </div>
</div>
<?php get_footer(); ?>