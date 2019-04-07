<p>&nbsp;</p>
<h4><?php echo get_the_title($chapter); ?> Member List</h4>
<?php //print_r($users); ?>
	<p>&nbsp;</p>
    <div class="panel-group" id="accordion">
    	<?php foreach($users as $u) : ?>
			<?php 
				if($u->has_cap('bolt_chapter_member') ){
					$role = 'Member';
				} else if($u->has_cap('bolt_chapter_editor') ){
					$role = 'Editor';
				}
			?>    		
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><?php echo $role; ?></strong>: 
                    <?php echo get_user_meta($u->ID,'first_name',true); ?> <?php echo get_user_meta($u->ID,'last_name',true); ?> 
                    <em><a href="mailto:<?php echo $u->user_email; ?>"><?php echo $u->user_email; ?></a></em>
                    <?php if( in_array("provincial_membership", $user_info->roles) || in_array("administrator", $user_info->roles) || $user_info->has_cap('bolt_chapter_editor')  || $user_info->has_cap('manage_chapter_members') ) : ?>
                    	<small><a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $u->ID;?>" class="pull-right">[EDIT]</a></small>
                    <?php endif; ?>		
                </div>
            </div>



			<?php if( in_array("provincial_membership", $user_info->roles) || in_array("administrator", $user_info->roles) || $user_info->has_cap('bolt_chapter_editor') || $user_info->has_cap('manage_chapter_members')  ) : ?>
	            <div id="collapse<?php echo $u->ID;?>" class="panel-collapse collapse">
	                <div class="panel-body">

	                	<?php	
	                	/*
	                	<div style="background: #cacaca; padding: 15px; margin: 15px 0; border-radius: 8px">
							<div class="pms-account-subscriptions-header pms-subscription-plans-header">
								<span class="pms-subscription-plan-name">Subscription</span>
								<span class="pms-subscription-status">Status</span>
								<span class="pms-subscription-plan-expiration">Expires</span>
							</div>
							<?php
								global $wpdb;
								$table = $wpdb->prefix."pms_member_subscriptions";
								$subs = $wpdb->get_row("SELECT * FROM $table WHERE `user_id` = $u->ID");
							?>
							<div class="pms-account-subscription pms-subscription-plan pms-subscription-plan-has-actions  pms-last">
								<span class="pms-subscription-plan-name"><?php echo get_the_title($subs->subscription_plan_id); ?></span>
								<span class="pms-subscription-status"><?php echo $subs->status; ?></span>
								<span class="pms-subscription-plan-expiration"><?php echo date('F j, Y', strtotime($subs->expiration_date)); ?></span>
							</div>							
							<?php //if($subs->status != "active"  || (new DateTime() > new DateTime($subs->expiration_date)) ) : ?>
							<?php if( new DateTime() > new DateTime($subs->expiration_date)  ) : ?>
								<form class="member_remind" id="form_remind_<?php echo $u->ID;?>" action="<?php echo admin_url('admin-ajax.php'); ?>">
									<input type="hidden" name="userID" value="<?php echo $u->ID; ?>">
									<input type="hidden" name="userFname" value="<?php echo get_user_meta($u->ID,'first_name',true); ?>">
									<input type="hidden" name="userLname" value="<?php echo get_user_meta($u->ID,'last_name',true); ?>">
									<input type="hidden" name="userEmail" value="<?php echo $u->user_email; ?>">
									<input type="hidden" name="userExpired" value="<?php echo date('F j, Y', strtotime($subs->expiration_date)); ?>">
									<input type="hidden" name="action" value="remind_member">									
									<?php wp_nonce_field( 'remind_member_nonce', 'nonce_field' ); ?>											
									<p align="right"><button class="btn btn-primary">Send Renewal Notification</button></p>
								</form>
							<?php endif; ?>								
						</div>	
						*/
						?>

						<form class="member_update" id="form_<?php echo $u->ID;?>" action="<?php echo admin_url('admin-ajax.php'); ?>">

							<p>
								Role 
								<select class="form-control" name="role">
									<option value="bolt_chapter_editor" <?php echo (in_array('bolt_chapter_editor', $u->roles))? 'selected="selected"' : ''; ?> >Editor</option>
									<option value="bolt_chapter_member" <?php echo (in_array('bolt_chapter_member', $u->roles)) ? 'selected="selected"' : ''; ?> >Member</option>
								</select>
							</p> 

				            <?php
								$userz = get_user_by('id', $u->ID);
								$capslist = $userz->allcaps;	
				            ?>	

							<ul class="list-group">
								<li class="list-group-item"><label><input type="checkbox" value="allow_chapter" name="boltcap[]" <?php echo ( $userz->has_cap('publish_chapters') ) ? 'checked="checked"' : '';  ?>> Can Manage Chapter Posts</label></li>
								<li class="list-group-item"><label><input type="checkbox" value="allow_buoy_status" name="boltcap[]" <?php echo ( $userz->has_cap('publish_buoy_status')) ? 'checked="checked"' : '';  ?>> Can Manage Buoy Status</label></li>
								<li class="list-group-item"><label><input type="checkbox"  value="allow_buoy_site" name="boltcap[]" <?php echo ( $userz->has_cap('publish_buoy_site')) ? 'checked="checked"' : '';  ?>> Can Manage Buoy Site</label></li>
								<li class="list-group-item"><label><input type="checkbox"  value="allow_events" name="boltcap[]" <?php echo ( $userz->has_cap('publish_tribe_events')) ? 'checked="checked"' : '';  ?>> Can Manage Events</label></li>
								<li class="list-group-item"><label><input type="checkbox"  value="allow_newsletter" name="boltcap[]" <?php echo ( $userz->has_cap('send_newsletter')) ? 'checked="checked"' : '';  ?>> Can Send Newsletter to Members</label></li>
								<li class="list-group-item"><label><input type="checkbox"  value="manage_chapter_members" name="boltcap[]" <?php echo ( $userz->has_cap('manage_chapter_members')) ? 'checked="checked"' : '';  ?>> Can Manage Chapter Members</label></li>
								<li class="list-group-item"><label><input type="checkbox"  value="manage_products" name="boltcap[]" <?php echo ( $userz->has_cap('edit_products')) ? 'checked="checked"' : '';  ?>> Can Manage Products</label></li>								
							</ul>
							<input type="hidden" name="userID" value="<?php echo $u->ID; ?>">
							<input type="hidden" name="action" value="edit_member">
							<?php wp_nonce_field( 'edit_member_nonce', 'nonce_field' ); ?>		

											

							<p align="right"><button class="btn btn-default">Update Member</button></p>
						</form>	
	                </div>
	            </div>
			<?php endif; ?>	            

        </div>
        <?php endforeach; ?>
    </div>    


<script type="text/javascript">
jQuery(document).ready( function($) {

	$('.member_update').on('submit', function(e) {
		e.preventDefault();
 
		var $form = $(this);
 
		$.post($form.attr('action'), $form.serialize(), function(data) {
			$form.append(data);
			//window.location.reload();
		}, 'json');
	});



	$('.member_remind').on('submit', function(e) {
		e.preventDefault();
 		var $form = $(this);
 		$.post($form.attr('action'), $form.serialize(), function(data) {
			$form.append(data);
		}, 'json');
	});

})
</script>	

