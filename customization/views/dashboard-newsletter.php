<h2 style="font-weight:normal;">Send Email to Chapter Members</h2><br/>
<form method="post" id="add_newsletter" action="<?php //echo admin_url('admin-ajax.php?action=ajax_wp_editor'); ?>">
	<p><input type="text" name="post_title" value="" class="form-control" placeholder="Email Subject"></p>
    <br/>
	
	<?php 
		if( 
			in_array("provincial_membership", $user_info->roles) 
			|| in_array("administrator", $user_info->roles) 
			|| in_array("bolt_chapter_editor", $user_info->roles) 
			|| in_array("board", $user_info->roles) 
		) : 
	?>
		<input type="hidden" name="include" value="1">
		<p>
			<label>
				Send to: 
				<select name="post_category" id="chapter" class="form-control">
					<option value="all">Every Active Member</option>
				    <?php foreach( BoltMedia::chapter_list() as $chapters ) : ?>
				        <option value="<?php echo $chapters->ID;?>" <?php @selected( $chapters->ID, $chapter ); ?>>All Active <?php echo $chapters->post_title;?> Members</option>
				     <?php endforeach; ?>   
				</select>		
			</label>
		</p>
	<?php else : ?>
		<input type="hidden" name="post_category" value="<?php echo $user_info->chapter; ?>">
	<?php endif; ?>	

	<p><input type="checkbox" name="non_subscribers" value="1"> Also send email to NON-subscribers</p>
	<p><input type="checkbox" name="members_status[]" value="Inactive"> Also send email to INACTIVE members</p>
	<p><input type="checkbox" name="members_status[]" value="expired"> Also send email to EXPIRED members</p>
	<p><input type="checkbox" name="send_me" value="1"> Also send to myself</p>
	<p>&nbsp;</p>	
	<?php 
		$settings =   array(
		    'wpautop' => true, // use wpautop?
		    'media_buttons' => true,
		    'textarea_name' => 'bolt_newsletter',
		    'textarea_rows' => get_option('default_post_edit_rows', 10), 
		    'tabindex' => '',
		    'teeny' => true,
		    'dfw' => false,
		    'tinymce' => true,
		    'quicktags' => true,
		    'drag_drop_upload' => false
		);
		wp_editor( '', 'bolt_newsletter', $settings = array() ); 
	?>
	
	<input type="hidden" name="userID" value="<?php echo $user_info->ID; ?>">
	<input type="hidden" name="action" value="send_to_members">
	<?php wp_nonce_field( 'add_event_nonce', 'nonce_field' ); ?>	

	<p><input type="hidden" name="members_status[]" value="active"></p>
	<p><button class="bttn bttn-alt">Send Message To <?php echo ( in_array("provincial_membership", $user_info->roles) || in_array("administrator", $user_info->roles) ) ? "All" : $category; ?> (Chapter) Members</button></p>
</form>
