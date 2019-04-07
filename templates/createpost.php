<?php global $shortname; ?>

<?php
/* Template Name: Create post */
get_header(); ?>


<?php  die();
$mysqli = new mysqli('localhost', 'sos', 'Scr9d7$9', 'boltmedia_sos');

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
}
  //mysql_select_db('boltmedia_sos',$link);

   echo $qry = "SELECT * FROM content_type_buoystatus";
  $result = mysqli_query($mysqli,$qry);

  while ($row = mysqli_fetch_array($result)) {
	//$strOutput .= sprintf("<tr><td><a href='vessel_detail.php?RecordId=%s'>Details</a></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $row['RecordId'], $row['VesselName'], $row['VesselType'], $row['CauseofAccident'], $row['AreaofAccident'], $row['YearofAccident'], $row['Length'], $row['YearBuilt']);
		$vid = $row['vid'];

   echo $stu= $row['field_buoy_status_value'];
echo $notship= $row['field_buoy_notship_value'];
echo $refid= $row['field_buoy_reference_nid'];
echo $commentvalue= $row['field_buoy_comment_value'];
echo $evalue=$row['field_submitter_email_email'];
echo $phnvalue=$row['field_submitter_phone_value'];
echo $field_buoy_paton_value=$row['field_buoy_paton_value'];



		$qry_stt = "SELECT * FROM term_data where tid='".$stu."'";
		$rqry_stt= mysqli_query($mysqli,$qry_stt);
		  $rqry_stts= mysqli_fetch_assoc($rqry_stt);
	   echo $statusvalue=$rqry_stts['name'];



		$qry_content = "SELECT * FROM content_type_buoy where vid='".$refid."'";
		$rqry_content= mysqli_query($mysqli,$qry_content);
		 $rqry_contents= mysqli_fetch_assoc($rqry_content);
		$vidc=$rqry_contents['vid'];
$nidc=$rqry_contents['nid'];
		$tid = $rqry_contents['field_organization_value'];
		  $field_bodywater_value=$rqry_contents['field_bodywater_value'];


		  $qry_content_r = "SELECT * FROM content_field_record_date where nid='".$row['nid']."'";
		$rqry_content_r= mysqli_query($mysqli,$qry_content_r);
		$rqry_contents_r= mysqli_fetch_assoc($rqry_content_r);

		$recorddate =$rqry_contents_r['field_record_date_value'];

		 echo    $record_date=date('Ymd',strtotime($recorddate));


		/*titel*/
		$qry_title = "SELECT * FROM node where vid='".$vidc."'";
		$result_title = mysqli_query($mysqli,$qry_title);
		$row_title = mysqli_fetch_assoc($result_title);
	  /*status*/

		/* group */

		$qry_group = "SELECT * FROM term_data where tid='".$tid."'";
		$result_group = mysqli_query($mysqli,$qry_group);
		$row_group = mysqli_fetch_assoc($result_group);
		/* location detail */

		 $qry_location = "SELECT * FROM location_instance where vid='".$vid."'";
		  $result_location = mysqli_query($mysqli,$qry_location);
		$row_location = mysqli_fetch_assoc($result_location);
		$lid= $row_location['lid'];

		/*latitude long */

		 $qry_locations = "SELECT * FROM location where lid='".$lid."'";
			$result_locations = mysqli_query($mysqli,$qry_locations);
		$row_locations = mysqli_fetch_assoc($result_locations);
		$lat= $row_locations['latitude']; $long= $row_locations['longitude'];


$post_id = wp_insert_post(array (
   'post_type' => 'buoystatus',
   'post_title' => $row_title['title'],
   'post_content' => $rqry_contents['field_buoy_description_value'],
   'post_status' => 'publish',
   'comment_status' => 'closed',   // if you prefer
   'ping_status' => 'closed',      // if you prefer
));
///add_post_meta ( $post_id, 'vid', $vidc);
//add_post_meta ( $post_id, 'status', $statusvalue);
//add_post_meta ( $post_id, 'NOTSHIP', $notship);

//add_post_meta ( $post_id, 'comment', $commentvalue);
//add_post_meta ( $post_id, 'emails', $evalue);
//add_post_meta ( $post_id, 'phone', $phnvalue);
global $wpdb;
	$postifd ="SELECT ID FROM {$wpdb->prefix}postmeta spm join {$wpdb->prefix}posts sp on spm.post_id=sp.ID where sp.post_type='buoysites' and spm.meta_key ='vid' and spm.meta_value ='".$vidc."'";
				  $postifds= mysqli_query($mysqli,$postifd);

					$postidfind = mysqli_fetch_assoc($postifds);
					//print_r($postidfind);

			 echo   'postids:::'.$vidf=$postidfind['ID'];

			update_field('site_name', $vidf, $post_id);
			  update_field('record_date', $record_date, $post_id);
			  update_field('buoy_status', $statusvalue, $post_id);
			  update_field('notship', $notship, $post_id);
			  update_field('nav_standards',$field_buoy_paton_value,$post_id);
			  update_field('comment', $commentvalue, $post_id);

	  //   echo $row_title['title'].'-'.$field_bodywater_value.'-'.$row_group['name'].'-'.$lat.'-'.$long; echo '<br>';
		//print_r($row_title);

  }
?>

<?php get_footer(); ?>
