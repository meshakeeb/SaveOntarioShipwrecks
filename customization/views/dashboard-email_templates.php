<p>&nbsp;</p>
<form method="post" id="email_template" action="<?php //echo admin_url('admin-ajax.php?action=ajax_wp_editor'); ?>">


	<div class="panel-group" id="accordion">

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse_reminder" style="cursor: pointer">Membership 15 Day Expiration Reminder <small class="pull-right">Cron Triggered Mailer</small></div>
			</div>
			<div id="collapse_reminder" class="panel-collapse collapse">
				<div class="panel-body">
					<p><input type="text" name="template[reminder][title]" value="<?php echo ($reminder['title'] != "") ? $reminder['title'] : ''; ?>" class="form-control" placeholder="Email Title"></p>
<pre>
Email Content Variables:
{fname}      : Member first name
{lname}      : Member last name
{days}       : Days till expiration
{expiration} : Membership expiration date
{account_type}
{login_link}
</pre>
					<?php
						$settings =   array(
							'wpautop' => true, // use wpautop?
							//'media_buttons' => false,
							'textarea_rows' => get_option('default_post_edit_rows', 10),
							'tabindex' => '',
							'teeny' => true,
							'dfw' => false,
							'tinymce' => true,
							'quicktags' => true,
							'drag_drop_upload' => false
						);
						wp_editor(
							stripslashes_deep($reminder['content']),
							'reminder',
							$settings = array()
						);
					?>
			   </div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse_renewal" style="cursor: pointer">Membership Renewal</div>
			</div>
			<div id="collapse_renewal" class="panel-collapse collapse">
				<div class="panel-body">
					<p><input type="text" name="template[renewal][title]" value="<?php echo ($renewal['title'] != "") ? $renewal['title'] : ''; ?>" class="form-control" placeholder="Email Title"></p>
<pre>
Email Content Variables:
{fname}      : Member first name
{lname}      : Member last name
{expiration} : Membership expiration date
</pre>
					<?php
						$settings =   array(
							'wpautop' => true, // use wpautop?
							//'media_buttons' => false,
							'textarea_rows' => get_option('default_post_edit_rows', 10),
							'tabindex' => '',
							'teeny' => true,
							'dfw' => false,
							'tinymce' => true,
							'quicktags' => true,
							'drag_drop_upload' => false
						);
						wp_editor(
							stripslashes_deep($renewal['content']),
							'renewal',
							$settings = array()
						);
					?>
			   </div>
			</div>
		</div>


		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse_permissions" style="cursor: pointer">Member Permissions</div>
			</div>
			<div id="collapse_permissions" class="panel-collapse collapse">
				<div class="panel-body">
					<p><input type="text" name="template[permission][title]" value="<?php echo ($permission['title'] != "") ? $permission['title'] : ''; ?>" class="form-control" placeholder="Email Title"></p>
<pre>
Email Content Variables:
{fname}      : Member first name
{lname}      : Member last name
{permission} : Membership permissions
</pre>
					<?php
						$settings =   array(
							'wpautop' => true, // use wpautop?
							'media_buttons' => false,
							'textarea_rows' => get_option('default_post_edit_rows', 10),
							'tabindex' => '',
							'teeny' => true,
							'dfw' => false,
							'tinymce' => true,
							'quicktags' => true,
							'drag_drop_upload' => false
						);
						wp_editor(
							stripslashes_deep($permission['content']),
							'permission',
							$settings = array()
						);
						?>
			   </div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse_badges" style="cursor: pointer">Member Badges <small class="pull-right">On Registration Signup</small></div>
			</div>
			<div id="collapse_badges" class="panel-collapse collapse">
				<div class="panel-body">
					<p><input type="text" name="template[badges][title]" value="<?php echo ($badges['title'] != "") ? $badges['title'] : ''; ?>" class="form-control" placeholder="Email Title"></p>
<pre>
Email Content Variables:
{fname}      : Member first name
{pdf}        : PDF Badge Url
</pre>
					<?php
						$settings =   array(
							'wpautop' => true, // use wpautop?
							'media_buttons' => false,
							'textarea_rows' => get_option('default_post_edit_rows', 10),
							'tabindex' => '',
							'teeny' => true,
							'dfw' => false,
							'tinymce' => true,
							'quicktags' => true,
							'drag_drop_upload' => false
						);
						wp_editor( stripslashes_deep($badges['content']), 'badges', $settings = array() );
					?>
			   </div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse_pms_register" style="cursor: pointer">Register Email <small class="pull-right">On Registration Signup</small></div>
			</div>
			<div id="collapse_pms_register" class="panel-collapse collapse">
				<div class="panel-body">

					<p><input type="text" name="template[pms_register][title]" value="<?php echo ($pms['emails']['register_sub_subject'] != "") ? $pms['emails']['register_sub_subject'] : ''; ?>" class="form-control" placeholder="Email Title"></p>
<pre>
Email Content Variables:
{{display_name}}      : Name
{{subscription_name}} : Membership Subscription
</pre>
					<?php
						$settings =   array(
							'wpautop' => true, // use wpautop?
							'media_buttons' => false,
							'textarea_rows' => get_option('default_post_edit_rows', 10),
							'tabindex' => '',
							'teeny' => true,
							'dfw' => false,
							'tinymce' => true,
							'quicktags' => true,
							'drag_drop_upload' => false
						);
						wp_editor( stripslashes_deep($pms['emails']['register_sub']), 'pms_register', $settings = array() );
					?>
			   </div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse_family" style="cursor: pointer">New Family Member Notification <small class="pull-right">On Adding Family Member</small></div>
			</div>
			<div id="collapse_family" class="panel-collapse collapse">
				<div class="panel-body">

					<p><input type="text" name="template[family][title]" value="<?php echo ($family['title'] != "") ? $family['title'] : ''; ?>" class="form-control" placeholder="Email Title"></p>
<pre>
Email Content Variables:
{parent_name}
{name}
{member_login}
{member_pass}
</pre>
					<?php
						$settings =   array(
							'wpautop' => true, // use wpautop?
							'media_buttons' => false,
							'textarea_rows' => get_option('default_post_edit_rows', 10),
							'tabindex' => '',
							'teeny' => true,
							'dfw' => false,
							'tinymce' => true,
							'quicktags' => true,
							'drag_drop_upload' => false
						);
						wp_editor( stripslashes_deep($family['content']), 'family', $settings = array() );
					?>
			   </div>
			</div>
		</div>


		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse_newmember" style="cursor: pointer">New Member Notification <small class="pull-right">On Registration Signup</small></div>
			</div>
			<div id="collapse_newmember" class="panel-collapse collapse">
				<div class="panel-body">

					<p><input type="text" name="template[newmember][title]" value="<?php echo ($newmember['title'] != "") ? $newmember['title'] : ''; ?>" class="form-control" placeholder="Email Title"></p>
<pre>
Email Content Variables:
{chapter}
{name}
{member_login}
{member_email}
</pre>
					<?php
						$settings =   array(
							'wpautop' => true, // use wpautop?
							'media_buttons' => false,
							'textarea_rows' => get_option('default_post_edit_rows', 10),
							'tabindex' => '',
							'teeny' => true,
							'dfw' => false,
							'tinymce' => true,
							'quicktags' => true,
							'drag_drop_upload' => false
						);
						wp_editor( stripslashes_deep($newmember['content']), 'newmember', $settings = array() );
					?>
			   </div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse_newpost" style="cursor: pointer">New Post <small class="pull-right">On Publishing NEW Post</small></div>
			</div>
			<div id="collapse_newpost" class="panel-collapse collapse">
				<div class="panel-body">

					<p><input type="text" name="template[newpost][title]" value="<?php echo ($newpost['title'] != "") ? $newpost['title'] : ''; ?>" class="form-control" placeholder="Email Title"></p>
<pre>
Email Content Variables:
{name}     : Name
{type}     : Type of Post
{post_url} : URL of Post
</pre>
					<?php
						$settings =   array(
							'wpautop' => true, // use wpautop?
							'media_buttons' => false,
							'textarea_rows' => get_option('default_post_edit_rows', 10),
							'tabindex' => '',
							'teeny' => true,
							'dfw' => false,
							'tinymce' => true,
							'quicktags' => true,
							'drag_drop_upload' => false
						);
						wp_editor( stripslashes_deep($newpost['content']), 'newpost', $settings = array() );
					?>
			   </div>
			</div>
		</div>


		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse_buoystatus" style="cursor: pointer">New Buoy Status <small class="pull-right">On Publishing NEW Buoy Status [to be sent to submitter]</small></div>
			</div>
			<div id="collapse_buoystatus" class="panel-collapse collapse">
				<div class="panel-body">

					<p><input type="text" name="template[newbuoy][title]" value="<?php echo ($newbuoy['title'] != "") ? $newbuoy['title'] : ''; ?>" class="form-control" placeholder="Email Title"></p>
<pre>
Email Content Variables:
{name}        : Name
{post_url}    : URL of Post
{buoy_site}   : Buoy Site Name
{buoy_status} : Buoy Status
{buoy_date}   : Record Date
{lat}         : Buoy Site Latitude
{lng}         : Buoy Site Longitude
</pre>
					<?php
						$settings =   array(
							'wpautop' => true, // use wpautop?
							'media_buttons' => false,
							'textarea_rows' => get_option('default_post_edit_rows', 10),
							'tabindex' => '',
							'teeny' => true,
							'dfw' => false,
							'tinymce' => true,
							'quicktags' => true,
							'drag_drop_upload' => false
						);
						wp_editor( stripslashes_deep($newbuoy['content']), 'newbuoy', $settings = array() );
					?>
			   </div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse_pms" style="cursor: pointer">[PMS] Activate Subscription Email</div>
			</div>
			<div id="collapse_pms" class="panel-collapse collapse">
				<div class="panel-body">

					<p><input type="text" name="template[pms_activate][title]" value="<?php echo ($pms['emails']['activate_sub_subject'] != "") ? $pms['emails']['activate_sub_subject'] : ''; ?>" class="form-control" placeholder="Email Title"></p>
<pre>
Email Content Variables:
{{display_name}}      : Name
{{subscription_name}} : Membership Subscription
</pre>
					<?php
						$settings =   array(
							'wpautop' => true, // use wpautop?
							'media_buttons' => false,
							'textarea_rows' => get_option('default_post_edit_rows', 10),
							'tabindex' => '',
							'teeny' => true,
							'dfw' => false,
							'tinymce' => true,
							'quicktags' => true,
							'drag_drop_upload' => false
						);
						wp_editor( stripslashes_deep($pms['emails']['activate_sub']), 'pms_activate', $settings = array() );
					?>
			   </div>
			</div>
		</div>


		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse_pms_cancel" style="cursor: pointer">[PMS] Cancel Subscription Email</div>
			</div>
			<div id="collapse_pms_cancel" class="panel-collapse collapse">
				<div class="panel-body">

					<p><input type="text" name="template[pms_cancel][title]" value="<?php echo ($pms['emails']['cancel_sub_subject'] != "") ? $pms['emails']['cancel_sub_subject'] : ''; ?>" class="form-control" placeholder="Email Title"></p>
<pre>
Email Content Variables:
{{display_name}}      : Name
{{subscription_name}} : Membership Subscription
</pre>
					<?php
						$settings =   array(
							'wpautop' => true, // use wpautop?
							'media_buttons' => false,
							'textarea_rows' => get_option('default_post_edit_rows', 10),
							'tabindex' => '',
							'teeny' => true,
							'dfw' => false,
							'tinymce' => true,
							'quicktags' => true,
							'drag_drop_upload' => false
						);
						wp_editor( stripslashes_deep($pms['emails']['cancel_sub']), 'pms_cancel', $settings = array() );
					?>
			   </div>
			</div>
		</div>


		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse_pms_expired" style="cursor: pointer">[PMS] Expired Subscription Email</div>
			</div>
			<div id="collapse_pms_expired" class="panel-collapse collapse">
				<div class="panel-body">

					<p><input type="text" name="template[pms_expired][title]" value="<?php echo ($pms['emails']['expired_sub_subject'] != "") ? $pms['emails']['expired_sub_subject'] : ''; ?>" class="form-control" placeholder="Email Title"></p>
<pre>
Email Content Variables:
{{display_name}}      : Name
{{subscription_name}} : Membership Subscription
</pre>
					<?php
						$settings =   array(
							'wpautop' => true, // use wpautop?
							'media_buttons' => false,
							'textarea_rows' => get_option('default_post_edit_rows', 10),
							'tabindex' => '',
							'teeny' => true,
							'dfw' => false,
							'tinymce' => true,
							'quicktags' => true,
							'drag_drop_upload' => false
						);
						wp_editor( stripslashes_deep($pms['emails']['expired_sub']), 'pms_expired', $settings = array() );
					?>
			   </div>
			</div>
		</div>


	</div>

	<p>&nbsp;</p>

	<input type="hidden" name="action" value="email_template">
	<?php wp_nonce_field( 'add_event_nonce', 'nonce_field' ); ?>
	<p align="right"><button class="btn btn-primary">Update Email Template</button></p>
</form>
