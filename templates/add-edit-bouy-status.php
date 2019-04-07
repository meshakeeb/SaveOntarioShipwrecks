<?php global $shortname; ?>

<?php
/* Template Name:  Edit Buoy status*/
get_header();
global $wpdb;
$postid=$_GET['id'];
$post = get_post($postid); //echo '<pre>'; print_r($post); echo '<pre>';

			  $up_sitename=get_post_meta($postid, 'site_name', true);
			  $up_sitenamess=get_field('site_name', $postid);
			// echo $record_datess=get_post_meta($postid, 'buoy_status', true);
		//	 $up_sitename = url_to_postid( $up_sitename1 );
			//  $up_sitename=get_the_ID($up_sitename1);
			  $up_record_date=get_field('record_date', $postid);
			   $up_buoy_status=get_field('buoy_status', $postid);
			   $up_nav_standards=get_field('nav_standards', $postid);
			   $up_notship=get_field('notship', $postid);
			  $up_comment=get_field('comment', $postid);

/*

$args1 = array(
	   'role' => array('chapter_editor','manitoulin'),
	   'orderby' => 'user_nicename',
	   'order' => 'ASC'
	  ); $subscribers = get_users($args1); echo '<pre>'; print_r($subscribers); echo '</pre>';
	   $display_name=array(); $user_email=array();
	  foreach ($subscribers as $user) {
		$display_name[]=$user->display_name;
		$user_email[]=$user->user_email;
	  } print_r($display_name); //print_r($user_email);  echo $display_name[0]; echo $user_email[0]; */
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Oh no! A connect_errno exists so the connection attempt failed!
if ($mysqli->connect_errno) {
	// The connection failed. What do you want to do?
	// You could contact yourself (email?), log the error, show a nice page, etc.
	// You do not want to reveal sensitive information

	// Let's try this:
	echo "Sorry, this website is experiencing problems.";

	// Something you should not do on a public site, but this example will show you
	// anyways, is print out MySQL error related information -- you might log this
	echo "Error: Failed to make a MySQL connection, here is why: \n";
	echo "Errno: " . $mysqli->connect_errno . "\n";
	echo "Error: " . $mysqli->connect_error . "\n";

	// You might want to show them something nice, but we will simply exit
	exit;
} $bolt_user = wp_get_current_user();

				//print_r($_POST);
			if($_POST['submit']=='Update'){


			 $my_post = array(
			  'ID'   => $postid,
			  'post_title'    => $_POST["title"],
			  'post_content'  => ''
			  );
			// Insert the post into the database
			 $postid1 = wp_update_post( $my_post );
			// $record_date=date('Ymd',strtotime($_POST["record_date"]));
			 // Update the post into the database
			  update_field('site_name', $_POST['site_name'], $postid);
			 // update_field('record_date', '20090728', $postid);
			  update_field('buoy_status', $_POST['buoy_status'], $postid);
			  update_field('nav_standards', $_POST['nav_standards'], $postid);
			  update_field('notship', $_POST['notship'], $postid);
			  update_field('comment', $_POST['comment'], $postid);
			  global $current_user;
			   $message = "Hi ".$current_user->user_login."\n\n";
			   $message .= "The follow buoy status has been updated.\n\n";
			   //$message .= "Link: " . $post_url."\n\n";
			  //$post_name_formatted = str_replace($find, $replace, $site_id);
			 // $post_name_formatteds = str_replace('/', '', $post_name_formatted);
			  //$message  .='<a href="'.home_url().'/buoysites/'.$post->post_name.'">'.$post->post_title.'</a>';
			 $message .= "Details\n\n"; $site_namesss= get_the_title($_POST['site_name']);
			  $message .= "Site name:".$site_namesss."\n\n";
			 // $message .= "Record Date:".date('m/d/Y',strtotime($record_date))."\n\n";
			  $message .= "Buoy Status:".$_POST['buoy_status']."\n\n";
			  $message .= "NOTSHIP#:".$_POST['notship']."\n\n";
			  $message .= "Comment:".$_POST['comment']."\n\n";
			  $message .= "Thank you!\n\n";
			  $message .= "Save Ontario Shipwrecks\n\n";
			  $headers = 'From: Save Ontario Shipwrecks <wordpress@saveontarioshipwrecks.ca>' . "\r\n";
			  // wp_mail( 'dan@boltmedia.ca', $subject, $message );
			  $subject='A buoy status has been modified.';
			  //  wp_mail( 'chauhanjayesh142@gmail.com', $subject, $message);
			  wp_mail( 'raimund.krob@gmail.com', $subject, $message, $headers );
			  $cuser=$bolt_user->user_email;
				wp_mail( $cuser, $subject, $message, $headers );
			  $success='Buoy Status Successfully Updated.';

			  }

?>


	<div class="page_header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="text-capitalize">Buoy Status Updates</h1>
				</div>

				<div class="col-sm-6">
					<div class="bcrumbs">
						<div class="container">
							<ul>
								<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
								<li><span>Buoy Status</span></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="about-single">
		<div class="container row-eq-height">
			<div class="col-md-8 col-sm-7 about-single-content">

<?php if($success!=''){ ?><br><h4 style="color:green;"><?php echo $success; ?></h4><?php } ?>
				<div class="about-single-info">
<?php $user = wp_get_current_user();
	   if ( in_array( 'administrator', (array) $user->roles ) || in_array( 'chapter_editor', (array) $user->roles ) || in_array( 'buoy_editors', (array) $user->roles )
									|| in_array( 'bolt_chapter_editor', (array) $user->roles )) {

	if ( $bolt_user->has_cap('publish_buoy_site') || $bolt_user->has_cap('publish_buoy_status')  || $bolt_user->has_cap('activate_plugins') ) {
?>
<form class="pms-form custom-form" action="<?php echo site_url(); ?>/edit-buoy-status/?id=<?php echo $postid; ?>" accept-charset="UTF-8" method="post" id="node-form" enctype="multipart/form-data">
<div>
<div class=form-block node-form">
  <div class="standard">
<div class="form-item" id="edit-title-wrapper">


  <div class="form-block form-item" id="edit-field-buoy-location-0-value-wrapper">
   <label for="edit-field-buoy-location-0-value">Title: </label>
   <input name="title" id="title"  value="<?php echo $post->post_title; ?>" class="form-text text" type="text" required>
  </div>


<div class="form-block form-item" id="edit-field-buoy-location-0-value-wrapper">
 <label for="edit-title">Site name: <span class="form-required" title="This field is required.">*</span></label>
 <select name="site_name" required>
	 <option value="">Select Name</option>
	 <?php                      $args = array(
										'post_type' => 'buoysites',
										'posts_per_page'   =>-1,
										'paged' => $paged,
										'orderby'          => 'title',
										'order'            => 'ASC',
									);


									/* Get events */
									$events = get_posts( $args );

									foreach($events as $event ) {
										?>
	 <option value="<?php echo $event->ID; ?>" <?php if($up_sitename==$event->ID){ echo 'selected'; } ?>><?php echo $event->post_title; ?></option>
	 <?php } ?>
 </select>


</div>

</div>
<div class="form-block  form-item" id="edit-field-buoy-location-0-value-wrapper">
 <label for="edit-field-buoy-location-0-value">Record Date: </label>
 <input name="record_date" id="record_date1"  value="<?php echo $up_record_date; ?>" class="form-text text" type="text" required>
</div>
<div class="form-block form-item" id="edit-field-bouy-site-active-status-value-wrapper">

 <label for="edit-field-bouy-site-active-status-value">Buoy Status: </label>
<select id="acf-field-buoy_status" class="select" name="buoy_status" required>
	<option value="checked" <?php if($up_buoy_status=='checked'){ echo 'selected'; } ?>>Checked</option>
	<option value="damaged" <?php if($up_buoy_status=='damaged'){ echo 'selected'; } ?>>Damaged</option>
	<option value="deployed" <?php if($up_buoy_status=='deployed'){ echo 'selected'; } ?>>Deployed</option>
	<option value="missing" <?php if($up_buoy_status=='missing'){ echo 'selected'; } ?>>Missing</option>
	<option value="moved" <?php if($up_buoy_status=='moved'){ echo 'selected'; } ?>>Moved</option>
	<option value="notbuoyed" <?php if($up_buoy_status=='notbuoyed'){ echo 'selected'; } ?>>Not Buoyed</option>
	<option value="removed" <?php if($up_buoy_status=='removed'){ echo 'selected'; } ?>>Removed</option>
	<option value="repaired" <?php if($up_buoy_status=='repaired'){ echo 'selected'; } ?>>Repaired</option>
	<option value="storage" <?php if($up_buoy_status=='storage'){ echo 'selected'; } ?>>Storage</option>
	<option value="swapped" <?php if($up_buoy_status=='swapped'){ echo 'selected'; } ?>>Swapped</option>
	<option value="unknown" <?php if($up_buoy_status=='unknown'){ echo 'selected'; } ?>>Unknown</option>
	<option value="updated" <?php if($up_buoy_status=='updated'){ echo 'selected'; } ?>>Updated</option>
</select>
</div>

<div class="form-block form-item" id="edit-field-site-id-0-value-wrapper">
 <label for="edit-field-site-id-0-value">Buoy Meets CG Private Aids to Navigation Standards?: </label>
	<ul class="acf-radio-list radio horizontal">
		<li><label><input id="acf-field-nav_standards-N/A" name="nav_standards" value="N/A" <?php if($up_nav_standards=='N/A'){ echo 'checked'; } ?>  data-checked="&quot;checked&quot;" type="radio">N/A</label></li>
		<li><label><input id="acf-field-nav_standards-Yes" name="nav_standards" value="Yes" <?php if($up_nav_standards=='Yes'){ echo 'checked'; } ?> type="radio">Yes</label></li>
		<li><label><input id="acf-field-nav_standards-No" name="nav_standards" value="No" <?php if($up_nav_standards=='No'){ echo 'checked'; } ?> type="radio">No</label></li></ul>
</div>


<div class="form-block form-item" id="edit-field-buoy-location-0-value-wrapper">
 <label for="edit-field-buoy-location-0-value">NOTSHIP #: </label>
 <input name="notship" id="notship"  value="<?php echo $up_notship; ?>" class="form-text text" type="text">
</div>

<div class="form-block form-item" id="edit-field-buoy-location-0-value-wrapper">
 <label for="edit-field-buoy-location-0-value">Remarks (Caution: visible to the public): </label>
 <textarea name="comment" value="" style="width: 100%;"><?php echo $up_comment; ?></textarea>
</div>
  </div>
<input name="submit" id="edit-submit" value="Update" class="form-submit" type="submit">
</div>

</div></form>
	<?php }else{ ?>
  <h1>You are not allowed to add Buoy Status</h1>
	<?php } else{ ?>
  <h1>You are not allowed to add Buoy Status</h1>
	<?php } ?>
</div>
			</div>

			<div class="col-md-4 col-sm-5 about-single-sidebar">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div>

		</div>
	</div>
<?php //include( get_template_directory() . '/widgets/cta.php'); ?>

<script src="<?php bloginfo('template_url'); ?>//js/vendor/jquery-1.11.2.js"></script>
<script src="<?php bloginfo('template_url'); ?>//js/vendor/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>//js/main.js"></script>

 <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="<?php bloginfo('template_url'); ?>//js/gmaps.js"></script>


<?php get_footer(); ?>
