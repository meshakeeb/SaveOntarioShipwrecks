<p>&nbsp;</p>

<?php if(  in_array("provincial_membership", $user_info->roles) || in_array("administrator", $user_info->roles) ) : ?>
	<form id="chapter_dropdown">
	<h4>
		<select name="chapter" id="chapter" class="regular-text" />
	        <?php foreach( BoltMedia::chapter_list() as $chapters ) : ?>
	            <option value="<?php echo $chapters->ID;?>" <?php selected( $chapters->ID, $chapter ); ?>><?php echo $chapters->post_title;?></option>
	         <?php endforeach; ?>   
	    </select> Member List
	</h4>
	</form> 
	
	<p>&nbsp;</p>

	<form id="member_import" action="<?php echo admin_url('admin-ajax.php'); ?>">
		<input type="hidden" name="action" value="import_members">
		<input type="hidden" name="chapter" value="<?php echo $chapter;?>">
		<div class="panel panel-default">
		  <div class="panel-heading"><a href="#" data-toggle="collapse" data-target="#import_options">IMPORT AS CSV</a></div>
		  <div class="panel-body collapse" id="import_options">
		    <h5>Import Options:</h5>
		    <p>&nbsp;</p>
		    <h6>Data to be written on CSV</h6>
		    <p>&nbsp;</p>
		    <ul class="list-group">
		      <li class="list-group-item"><label><input type="checkbox" name="import[ID]" value="ID"> Include User ID</label></li>	
		      <li class="list-group-item"><label><input type="checkbox" name="import[user_login]" value="user_login"> Include Username</label></li>
			  <li class="list-group-item"><label><input type="checkbox" name="import[user_email]" value="user_email"> Include Email</label></li>		      
		      <li class="list-group-item"><label><input type="checkbox" name="import[fname]" value="fname"> Include First Name</label></li>		      
		      <li class="list-group-item"><label><input type="checkbox" name="import[lname]" value="lname"> Include Last Name</label></li>
		      <li class="list-group-item"><label><input type="checkbox" name="import[membership]" value="membership"> Include Membership</label></li>
		      <li class="list-group-item"><label><input type="checkbox" name="import[expiry]" value="expiry"> Include Membership Expiration</label></li>
		      <li class="list-group-item"><label><input type="checkbox" name="import[status]" value="status"> Include Status</label></li>
		      <li class="list-group-item"><label><input type="checkbox" name="import[chapter]" value="chapter"> Include Chapter</label></li>
		      <li class="list-group-item"><label><input type="checkbox" name="import[user_registered]" value="user_registered"> Include Registration Date</label></li>
		      <?php /*
		      <li class="list-group-item">
	      		Sort By
	      		<select name="import[sort_by]">
	      		  <option value="ID">User ID</option>
			      <option value="user_login">Username</option>
			      <option value="fname">First Name</option>		      
			      <option value="lname">Last Name</option>
				  <option value="user_email">Email</option>
			      <option value="membership">Membership</option>
			      <option value="status">Status</option>
			      <option value="expiry">Expiry</option>
			      <option value="chapter">Chapter</option>
			      <option value="user_registered">Registered</option>
	      		</select>

	      		<select name="import[sort]">
	      			<option value="SORT_ASC">Ascending</option>
	      			<option value="SORT_DESC">Descending</option>
	      		</select>	
		      </li>	
		      */ ?>
		    </ul>
		    <p>&nbsp;</p>
		    <h6>Data filters</h6>	
		    <p>&nbsp;</p>
		    <ul class="list-group">
		      <li class="list-group-item"><label><input type="radio" name="import[filter1]" value="0"> Show only users with <strong>INACTIVE</strong> status</label></li>
		      <li class="list-group-item"><label><input type="radio" name="import[filter1]" value="1"> Show only users with <strong>ACTIVE</strong> status</label></li>
		    </ul>  

		    <p align="right"><input type="submit" value="Export Now"></p>
		  </div>
		</div>		
	</form>	

<?php else : ?>	
	<h4><?php echo get_the_title($user_info->chapter); ?> Member List</h4>
<?php endif; ?>	

<?php //print_r($users); ?>
	<p>&nbsp;</p>
       
		<table id="usersTable" class="tablesorter" width="90%" style="table-layout: fixed; width: 95%; word-wrap: break-word; word-break: break-word; hyphens: auto" >
		  <thead>
		    <tr>
		      <th width="15%">Username</th>
		      <th width="13%">Name</th>		      
		      <th width="13%">Surname</th>
			  <th width="20%">Email</th>
		      <th width="16%">Membership</th>
		      <th width="10%">Status</th>
		      <th width="13%">Expiry</th>
		      <th width="2%"></th>
		    </tr>
		  </thead>
		  <tbody>    
    		<?php foreach($users as $u) : ?>
				<?php
					global $wpdb;
					$table = $wpdb->prefix."pms_member_subscriptions";
					$subs = $wpdb->get_row("SELECT * FROM $table WHERE `user_id` = $u->ID");

					if($u->has_cap('bolt_chapter_member') ){
						$role = 'Member';
					} else if($u->has_cap('bolt_chapter_editor') ){
						$role = 'Editor';
					}
				?>  				 			
			    <tr>
			      <td><a href="dashboard/edit-user/?u=<?php echo $u->ID; ?>" data-chapter="<?php echo get_user_meta($u->ID, 'chapter', true); ?>"><?php echo $u->user_login; ?></a> </td>
			      <td><?php echo get_user_meta($u->ID,'billing_first_name', true); ?></td>		      
			      <td><?php echo get_user_meta($u->ID,'billing_last_name', true); ?></td>
				  <td><span style=""><?php echo $u->user_email; ?></span></td>
			      <td><?php echo $role; ?><br><em style="color:#286090; font-weight: bold"><?php echo get_the_title($subs->subscription_plan_id); ?></em></td>
			      <td><?php echo $subs->status; ?></td>
			      <td>
			      	<?php echo date('Y-m-d', strtotime($subs->expiration_date)); ?>
			      </td>
			      <td>
					<?php if( new DateTime() > new DateTime($subs->expiration_date)  ) : ?>
						<form class="member_remind" id="form_remind_<?php echo $u->ID;?>" action="<?php echo admin_url('admin-ajax.php'); ?>">
							<input type="hidden" name="userID" value="<?php echo $u->ID; ?>">
							<input type="hidden" name="userFname" value="<?php echo get_user_meta($u->ID,'billing_first_name',true); ?>">
							<input type="hidden" name="userLname" value="<?php echo get_user_meta($u->ID,'billing_last_name',true); ?>">
							<input type="hidden" name="userEmail" value="<?php echo $u->user_email; ?>">
							<input type="hidden" name="userExpired" value="<?php echo date('F j, Y', strtotime($subs->expiration_date)); ?>">
							<input type="hidden" name="action" value="remind_member">									
							<?php wp_nonce_field( 'remind_member_nonce', 'nonce_field' ); ?>											
							<p align="right"><button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-envelope"></i></button></p>
						</form>
					<?php endif; ?>				      			      	
			      </td>
			    </tr>
        		<?php endforeach; ?>
		  	</tbody>        	
    	</table>



<script type="text/javascript">
jQuery(document).ready( function($) {

	$('.member_remind').on('submit', function(e) {
		e.preventDefault();
			var $form = $(this);
			$.post($form.attr('action'), $form.serialize(), function(data) {
			$form.append(data);
		}, 'json');
	});

	$('#chapter_dropdown select').on('change', function(e) {
		$('#chapter_dropdown').submit();
	});




	$("#usersTable").tablesorter({
		headers: {7: {sorter: false}}
	});

	


    $('#member_import').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        $.post($form.attr('action'), $form.serialize(), function(data) {
            $form.append(data);
        }, 'json');
    });	

})
</script>	

