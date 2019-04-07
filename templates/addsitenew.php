<?php global $shortname; ?>

<?php
/* Template Name: Create post1 */
get_header(); ?>


<?php  error_reporting(1);  global $wpdb;
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

		/*titel*/
	  echo  $qry1 = "SELECT * FROM node where type='buoy' and title like '%Wexford%'";
		$result = mysqli_query($mysqli,$qry1);
  while ($row = mysqli_fetch_array($result)) {
	echo 'test';
	echo $vid = $row['vid'];



	echo    $qry_content = "SELECT * FROM content_type_buoy where vid='".$vid ."'";
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


		$qry_title = "SELECT * FROM node where vid='".$vid."'";
		$result_title = mysqli_query($mysqli,$qry_title);
	  $row_title = mysqli_fetch_assoc($result_title);

		$qry_group = "SELECT * FROM term_data where tid='".$tid."'";
		$result_group = mysqli_query($mysqli,$qry_group);
	  $row_group = mysqli_fetch_assoc($result_group);

	  $qry_location = "SELECT * FROM location_instance where vid='".$vid."'";
	  $result_location = mysqli_query($mysqli,$qry_location);
	  $row_location = mysqli_fetch_assoc($result_location);
	  $lid= $row_location['lid'];

	  $qry_locations = "SELECT * FROM location where lid='".$lid."'";
			$result_locations = mysqli_query($mysqli,$qry_locations);
	  $row_locations = mysqli_fetch_assoc($result_locations);
	  $lat= $row_locations['latitude']; $long= $row_locations['longitude'];
if($rqry_contents['field_buoy_description_value']=='' || $rqry_contents['field_buoy_description_value']==' NULL'){
 $desc=' ';
}
$dataa=array (
   'post_type' => 'buoysites',
   'post_title' => $row['title'],
   'post_content' => $desc,
   'post_status' => 'publish',
   'comment_status' => 'closed',   // if you prefer
   'ping_status' => 'closed',      // if you prefer
);
$post_id = wp_insert_post(array (
   'post_type' => 'buoysites',
   'post_title' => $row['title'],
   'post_content' => $desc,
   'post_status' => 'publish',
   'comment_status' => 'closed',   // if you prefer
   'ping_status' => 'closed',      // if you prefer
));

var_dump($dataa);
 if (is_wp_error($post_id))
	{
	$errors = $post_id->get_error_messages();
	foreach ($errors as $error) {
		echo "- " . $error . "<br />";
		}
	}
	$postifd ="SELECT ID FROM {$wpdb->prefix}postmeta spm join {$wpdb->prefix}posts sp on spm.post_id=sp.ID where sp.post_type='buoysites' and spm.meta_key ='vid' and spm.meta_value ='".$vid."'";
				  $postifds= mysqli_query($mysqli,$postifd);

					$postidfind = mysqli_fetch_assoc($postifds);
				  //  print_r($postidfind);

			 echo   '>>'.$post_id.'='.$row['title'];

			  update_field('vid', $vid, $post_id);

}?>
