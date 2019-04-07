<?php echo '<h1>CONFIG ERROR.</h1>'; exit; ?>
<?php //global $shortname; ?>

<?php
/* Template Name:  Add Buoy status*/
get_header();

global $wpdb;
$mysqli = new mysqli('localhost', 'sos', 'bJdXQnBmr62Q', 'wordpress');

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
			if($_POST['submit']=='Submit'){

			 $record_date=date('Ymd',strtotime($_POST["record_date"]));
			 $title= get_the_title($_POST['site_name']).'-'.$_POST['buoy_status'].'-'.$record_date;
			 $my_post = array(
			  'post_title'    => $title,
			  'post_content'  =>'',
			  'post_status'   => 'publish',
			  'post_type'     =>'buoystatus'
			 );
			// Insert the post into the database
			 $postid = wp_insert_post( $my_post );
			 // Update the post into the database
			  update_field('site_name', $_POST['site_name'], $postid);
			  update_field('record_date', $record_date, $postid);
			  update_field('buoy_status', $_POST['buoy_status'], $postid);
			  update_field('nav_standards', $_POST['nav_standards'], $postid);
			  update_field('notship', $_POST['notship'], $postid);
			  update_field('comment', $_POST['comment'], $postid);



			  $site_id = get_field( "site_name", $postid );
			  $record_date = get_field( "record_date", $postid );
			  $buoy_status = get_field( "buoy_status", $postid );
			  $notship = get_field( "notship", $postid );
			  $comment = get_field( "comment", $postid );
			  $site_name= get_the_title($site_id);

			  $site_name1=get_the_title($_POST['site_name']);
			  $find = array('https://saveontarioshipwrecks.ca/buoysites/', '-');
			  $replace = array('', ' ');
			  //$post_url = get_permalink( $site_id );
			  $post_url = 'https://saveontarioshipwrecks.ca/buoysites/'.$site_name1;
			  global $current_user;
			  $vid=get_post_meta($_POST['site_name'],'vid',true);
			  $qry_latlong = "SELECT * FROM content_type_buoy where vid='".$vid."'";
			  $qry_latlongs= mysqli_query($mysqli,$qry_latlong);
			 $querylatlong = "SELECT

					  C.lid AS lid,
					  D.latitude, D.longitude

					FROM location_instance AS C
					  LEFT JOIN location AS D ON C.lid = D.lid where C.vid='".$vid."'";
					  $querylatlongs= mysqli_query($mysqli,$querylatlong);
			  $qrylatlongss= mysqli_fetch_assoc($querylatlongs);
			  $sname=get_post($_POST['site_name']);
			  $msg='';
			  $msg .='This is an automated message from the Save Ontario Shipwrecks mooring buoy system for the status update you just submitted.
<br><br>
Dear '.$current_user->user_login.':
<br><br>
Thank you very much for submitting an updated buoy status for ' . $sname->post_title.'
<br><br>
Please immediately forward the information below to NotshipC&A@DFO-MPO.GC.CA
<br><br>
The Canadian Coast Guard will email you the NOTSHIP number for your buoy status update as soon as possible.
<br><br>
As soon as you receive the NOTSHIP number, please log back into the SOS Website, go to “Buoy Status”, and then click the “Edit” icon next to your Site Name and type the NOTSHIP number in the “NOTSHIP #” field, and then click the “UPDATE” button. This will close the loop and complete your buoy status update.
<br><br>
Thank you very much.<br><br>
____________________________________________________________________________________________________________________________________
<br><br>
Dear Canadian Coast Guard, Notices to Shipping (NOTSHIP):
<br><br>
An orange and white mooring buoy has been reported as '.$buoy_status.' on '.$_POST["record_date"].'  at Latitude: '.$qrylatlongss['latitude'].' Longitude: '.$qrylatlongss['longitude'].' marking the shipwreck or dive site: '.$sname->post_title.'.
<br><br>
Please reply to Sender with NOTSHIP number at your earliest opportunity.
<br<br>
Thank you kindly,<br>
<br>
Buoy Manager';
			   $message = "Hi ".$current_user->user_login."\n\n";
			   $message .= "A new buoy status has been created.\n\n";
			   $message .= "Link: " . $post_url."\n\n";
			  $post_name_formatted = str_replace($find, $replace, $site_id);
			  //$post_name_formatteds = str_replace('/', '', $post_name_formatted);
			  //$message  .='<a href="'.home_url().'/buoysites/'.$post->post_name.'">'.$post->post_title.'</a>';



			   $message .= "Details\n\n";
			  $message .= "Site name:".ucwords($post_name_formatteds)."\n\n";
			  $message .= "Record Date:".date('m/d/Y',strtotime($record_date))."\n\n";
			  $message .= "Buoy Status:".$buoy_status."\n\n";
			  $message .= "NOTSHIP#:".$notship."\n\n";
			  $message .= "Comment:".$comment."\n\n";
			  $message .= "Thank you!\n\n";
			  $message .= "Save Ontario Shipwrecks\n\n";
			  $headers = 'From: Save Ontario Shipwrecks <no-reply@saveontarioshipwrecks.ca>' . "\r\n";
			   wp_mail( 'dan@boltmedia.ca', $subject, $message );
			  $subject='A new buoy status has been created.';
			   wp_mail( 'chauhanjayesh142@gmail.com', $subject, $msg);
				wp_mail( 'dan@boltmedia.ca', $subject, $msg, $headers );
			  $cuser=$bolt_user->user_email;
				wp_mail( $cuser, $subject, $msg, $headers );
			  $success='New buoy status successfully submitted.';
			  }

?>


	<div class="page_header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="text-capitalize"><?php echo get_the_title(); ?></h1>
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
?>      <p><b>Note to Buoy Managers:</b> When you submit this Buoy Status Update, the system will immediately send you an email that you will then need to forward to NOTSHIPs.</p>
<form class="pms-form custom-form" action="<?php echo site_url(); ?>/dashboard/add-buoy-status/" accept-charset="UTF-8" method="post" id="node-form" enctype="multipart/form-data">
<div>
<div class="form-block node-form">
  <div class="standard">
<div class="form-item" id="edit-title-wrapper">

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
	 <option value="<?php echo $event->ID; ?>"><?php echo $event->post_title; ?></option>
	 <?php } ?>
 </select>


</div>

</div>


<div class="form-block  form-item" id="edit-field-buoy-location-0-value-wrapper">
 <label for="edit-field-buoy-location-0-value">Record Date: </label>

 <input name="record_date" id="record_date"   value="<?php echo date("dd/mm/yyyy");?>" class="form-text text" type="date" required>
</div>
<div class="form-block form-item" id="edit-field-bouy-site-active-status-value-wrapper">

 <label for="edit-field-bouy-site-active-status-value">Buoy Status: </label>
<select id="acf-field-buoy_status" class="select" name="buoy_status" required>
	<option value="checked" selected="selected">Checked</option>
	<option value="damaged">Damaged</option>
	<option value="deployed">Deployed</option>
	<option value="missing">Missing</option>
	<option value="moved">Moved</option>
	<option value="notbuoyed">Not Buoyed</option>
	<option value="removed">Removed</option>
	<option value="repaired">Repaired</option>
	<option value="storage">Storage</option>
	<option value="swapped">Swapped</option>
	<option value="unknown">Unknown</option>
	<option value="updated">Updated</option>
</select>
</div>

<div class="form-block form-item" id="edit-field-site-id-0-value-wrapper">
 <label for="edit-field-site-id-0-value">Buoy Meets CG Private Aids to Navigation Standards?: </label>
	<ul class="acf-radio-list radio horizontal">
		<li><label><input id="acf-field-nav_standards-N/A" name="nav_standards" value="N/A" checked="&quot;checked&quot;" data-checked="&quot;checked&quot;" type="radio">N/A</label></li>
		<li><label><input id="acf-field-nav_standards-Yes" name="nav_standards" value="Yes" type="radio">Yes</label></li>
		<li><label><input id="acf-field-nav_standards-No" name="nav_standards" value="No" type="radio">No</label></li></ul>
</div>


<div class="form-block form-item" id="edit-field-buoy-location-0-value-wrapper">
 <label for="edit-field-buoy-location-0-value">NOTSHIP #: </label>
 <input name="notship" id="notship"  value="" class="form-text text" type="text">
</div>

<div class="form-block form-item" id="edit-field-buoy-location-0-value-wrapper">
 <label for="edit-field-buoy-location-0-value">Remarks (Caution: visible to the public): </label>
 <textarea name="comment" value="" style="width: 100%;"></textarea>
</div>
  </div>
<input name="submit" id="edit-submit" value="Submit" class="form-submit" type="submit">
</div>

</div></form>
									<?php }else{ ?>
  <h1>You are not allowed to add Buoy Status</h1>
									<?php }
									}else{ ?>
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
<script type="text/javascript">
function mydate() {
  //alert("");
  document.getElementById("dt").hidden = false;
  document.getElementById("ndt").hidden = true;
}

function mydate1() {
  d = new Date(document.getElementById("dt").value);
  dt = d.getDate();
  mn = d.getMonth();
  mn++;
  yy = d.getFullYear();
  document.getElementById("ndt").value = mn + "/" + dt + "/" + yy
  document.getElementById("ndt").hidden = false;
  document.getElementById("dt").hidden = true;
}
</script>
<script src="<?php bloginfo('template_url'); ?>//js/vendor/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>//js/main.js"></script>

 <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="<?php bloginfo('template_url'); ?>//js/gmaps.js"></script>


<?php get_footer(); ?>
