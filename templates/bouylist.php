<?php global $shortname; ?>

<?php
/* Template Name: Buoy list*/
get_header(); ?>


	<div class="page_header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="text-capitalize">Buoy Sites</h1>
				</div>

				<div class="col-sm-6">
					<div class="bcrumbs">
						<div class="container">
							<ul>
								<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
								<li><span>Buoy Site List</span></li>
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

				<div class="about-single-info">
					<div id="google-map" class="google-map" style="height: 450px;">
					</div>
					<div id="mapdd"></div>
					<div class="map-search">
						<form action="http://dev.boltmedia.ca/sos/buoy-program/buoy-site-list/" method="post">
							<input type="text" name="search"  placeholder="Search a buoy name, group name, body of water...">
							<button type="submit" name="submit" value="search"><i class="fa fa-search"></i></button>
						</form>
					</div>

					<div class="table-responsive">
						<table class="table data-table table-striped">
							<thead>
								<tr>
									<th>Site Name <?php if($_GET['order']=='' || $_GET['order']=='ASC'){?>
										<a href="<?php echo site_url()?>/buoy-program/buoy-site-list?orderby=title&order=DESC"><img src="<?php bloginfo('template_url'); ?>/images/arrow-desc.png"></a><?php }else{ ?><a href="<?php echo site_url()?>/buoy-program/buoy-site-list?orderby=title&order=ASC"><img src="<?php bloginfo('template_url'); ?>/images/arrow-asc.png"></a>
										<?php } ?></th>
									<th>Group</th>
									<th>Body of Water</th>
									<th>Latitude</th>
									<th>Longitude</th>
									<th>Buoy Status</th>
									<?php if ( in_array( 'buoy_editors', (array) $current_user->roles ) || in_array( 'buoy_site_administrator', (array) $current_user->roles ) || in_array( 'administrator', (array) $current_user->roles ) ) { ?>
									<th>Edit</th>
									<?php } else { ?>
									<th>Report</th>
									<?php } ?>

								</tr>
							</thead>
							<tbody>

								<?php global $wpdb;
								function get_post_by_meta_value( $meta_key, $meta_value ) {
								  $post_where = function ($where) use ( $meta_key, $meta_value ) {
									global $wpdb;
									$where .= ' AND ID IN (SELECT post_id FROM ' . $wpdb->postmeta
									  . ' WHERE meta_key = "' . $meta_key .'" AND meta_value = "' . $meta_value . '")';
									return $where;
								  };
								  add_filter( 'posts_where', $post_where );
								  $args = array(
									'post_type' => 'buoysites',
									'post_status' => 'published',
									'post_per_page' => -1,
									'suppress_filters' => FALSE
								  );
								  $posts = get_posts( $args );
								  remove_filter( 'posts_where' , $posts_where );
								  return $posts;
								}
								  if($_POST['submit']=='search'){

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
									$vid=array();
									$bodywatersearch ="SELECT vid FROM content_type_buoy where field_bodywater_value like '%".$_POST['search']."%' ";
									$bodywatersearchs= mysqli_query($mysqli,$bodywatersearch);
									while ($row = mysqli_fetch_array($bodywatersearchs)) {
									 $postifd ="SELECT ID FROM {$wpdb->prefix}postmeta spm join {$wpdb->prefix}posts sp on spm.post_id=sp.ID where sp.post_type='buoysites' and spm.meta_key ='vid' and spm.meta_value ='".$row['vid']."'";
									$postifds= mysqli_query($mysqli,$postifd);

									   $postidfind = mysqli_fetch_assoc($postifds);
										//print_r($postidfind);
										   if($postidfind['ID']!=''){
											$vid[]=$postidfind['ID'];
										}
										# code...
									}
									$titlesearch ="SELECT vid FROM node where title like '%".$_POST['search']."%'";
									$titlesearchs= mysqli_query($mysqli,$titlesearch);
									//$fgd= mysqli_fetch_array($titlesearchs);
									//print_r($bodywatersearch);

									  while ($row = mysqli_fetch_array($titlesearchs)) {
										 $postifd ="SELECT ID FROM {$wpdb->prefix}postmeta spm join {$wpdb->prefix}posts sp on spm.post_id=sp.ID where sp.post_type='buoysites' and spm.meta_key ='vid' and spm.meta_value ='".$row['vid']."'";
									$postifds= mysqli_query($mysqli,$postifd);

									   $postidfind = mysqli_fetch_assoc($postifds);
										//print_r($postidfind);
										   if($postidfind['ID']!=''){
											$vid[]=$postidfind['ID'];
										}
										# code...
									}

									 $tid = "SELECT tid FROM term_data where name like '%".$_POST['search']."%'";
									$tids = mysqli_query($mysqli,$tid);
									$tid_row = mysqli_fetch_assoc($tids);
									 $vidq = "SELECT vid FROM content_type_buoy where field_organization_value='".$tid_row['tid']."'";
									$vidqs = mysqli_query($mysqli,$vidq);
									while ($row = mysqli_fetch_array($vidqs)) {
										 $postifd ="SELECT ID FROM {$wpdb->prefix}postmeta spm join {$wpdb->prefix}posts sp on spm.post_id=sp.ID where sp.post_type='buoysites' and spm.meta_key ='vid' and spm.meta_value ='".$row['vid']."'";
									$postifds= mysqli_query($mysqli,$postifd);

									   $postidfind = mysqli_fetch_assoc($postifds);
										//print_r($postidfind);
										   if($postidfind['ID']!=''){
											$vid[]=$postidfind['ID'];
										}
										# code...
									}

									$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								   //  print_r($vid); echo $newdata=implode(', ',$vid); $rt=$newdata;

										$args = array(
										'post_type' => 'buoysites',
										'posts_per_page'   => -1,
										'paged' => $paged,
										'orderby'          => 'title',
										'order'            => 'ASC',
										'post__in' => $vid,
									);

								  }else{
									 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

									/*$args = array(
										'post_type' => 'buoysites',
										'posts_per_page'   => 10,
										'paged' => $paged,
										'orderby'          => 'title',
										'order'            => 'ASC',
									);*/

									if($_GET['orderby']!='' || $_GET['order']!=''){
										$args = array(
											'post_type' => 'buoysites',
											'posts_per_page'   => 10,
											'paged' => $paged,
											'orderby'          => 'title',
											'order'            => $_GET['order'],

										); //print_r($args);
									}else{
										$args = array(
										'post_type' => 'buoysites',
										'posts_per_page'   => 10,
										'paged' => $paged,
										'orderby'          => 'title',
										'order'            => 'ASC',

									);
									}
								 }

									/* Get events */
									$events = get_posts( $args );

									foreach($events as $event ) {
										$vid=get_post_meta( $event->ID, 'vid', true );


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

										   $qry = "SELECT * FROM content_type_buoy where vid='".$vid."'";
										   $result = mysqli_query($mysqli,$qry);
											 $row = mysqli_fetch_assoc($result);
											$tid = $row['field_organization_value'];
											$field_bodywater_value=$row['field_bodywater_value'];
											/*titel*/
											$qry_title = "SELECT * FROM node where vid='".$vid."'";
											$result_title = mysqli_query($mysqli,$qry_title);
											$row_title = mysqli_fetch_assoc($result_title);

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
															  //mysql_select_db('boltmedia_sos',$link);
  $postifd ="SELECT ID FROM {$wpdb->prefix}postmeta spm join {$wpdb->prefix}posts sp on spm.post_id=sp.ID where sp.post_type='buoystatus' and sp.post_status='publish' and spm.meta_key ='site_name' and spm.meta_value ='".$event->ID."'";
						$postifds= mysqli_query($mysqli,$postifd);
							$postifdss = mysqli_fetch_assoc($postifds);
							//$postifdss2 = mysqli_fetch_array($postifds);

									  echo '<tr>';
									  echo '<td ><a href="'.home_url().'/buoysites/'.$event->post_name.'" >'.$event->post_title.'</a></td>';
									   echo '<td>'.$row_group['name'].'</td>';
									   echo '<td>'.$field_bodywater_value.'</td>';
									   echo '<td>'.$lat.'</td>';
									   echo '<td>'.$long.'</td>';
									   echo '<td>'.get_post_meta($postifdss['ID'], 'buoy_status', true ).'</td>';
									   echo '<td>';
									   $user = wp_get_current_user();
								if ( in_array( 'administrator', (array) $user->roles ) || in_array( 'chapter_editor', (array) $user->roles )) {
									   echo '<a href="'.home_url().'/buoy-program/buoy-site-list/edit/?id='.$event->ID.'" class="remove"><i class="fa fa-edit"></i></a>';

									} else {

										echo  '<a href="'. get_bloginfo("url") .'/report-buoy-status/?site='.$event->post_title.'" class="remove"><i class="fa fa-edit"></i></a>';

									}

									echo '</td>';
									  echo '</tr>';

									} ?>

							</tbody>
						</table>
					</div>
					<ul class="pagination"><?php


						$big = 999999999; // need an unlikely integer

						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
							'current' => max( 1, get_query_var('paged') ),
							'total' => count($events)
						) );
					?>
					</ul>
					<!--<ul class="pagination table-striped">
						<li><a href="#"><i class="fa fa-arrow-left"></i></a></li>
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#"><i class="fa fa-arrow-right"></i></a></li>
					</ul>-->

				</div>
			</div>
<?php get_sidebar(); ?>
		</div>
	</div>
<?php //include( get_template_directory() . '/widgets/cta.php'); ?>

<script src="<?php bloginfo('template_url'); ?>//js/vendor/jquery-1.11.2.js"></script>
<script src="<?php bloginfo('template_url'); ?>//js/vendor/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>//js/main.js"></script>

 <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="<?php bloginfo('template_url'); ?>//js/gmaps.js"></script>
<script type="text/javascript">

		jQuery(document).ready(function(){

		var map = new GMaps({
			el: '#google-map',
			lat: 43.589045,
			lng: -79.644120,
			scrollwheel: false
		});

		/* Map Bound */
		var bounds = [];

		<?php /* For Each Location Create a Marker. */
		foreach( $events as $event ){
			$vid=get_post_meta( $event->ID, 'vid', true );

			$name = $event->post_title;

			$qry_location = "SELECT * FROM location_instance where vid='".$vid."'";
			$result_location = mysqli_query($mysqli,$qry_location);
			$row_location = mysqli_fetch_assoc($result_location);
			$lid= $row_location['lid'];
			$qry_locations = "SELECT * FROM location where lid='".$lid."'";
			$result_locations = mysqli_query($mysqli,$qry_locations);
			$row_locations = mysqli_fetch_assoc($result_locations);
			$lat= $row_locations['latitude']; $long= $row_locations['longitude']
			?>
			/* Set Bound Marker */
			var latlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long; ?>);
			bounds.push(latlng);
			/* Add Marker */
		   map.addMarker({
				lat: <?php echo $lat; ?>,
				lng: <?php echo $long; ?>,
				title: '<?php echo  str_replace("'", "",$name); ?>',
				infoWindow: {content: '<p><?php echo str_replace("'", "",$name); ?></p>'}
			});
		<?php } //end foreach locations ?>

		/* Fit All Marker to map */
		map.fitLatLngBounds(bounds);
		});

	//google.maps.event.addDomListener(window, 'load', init);

	function init() {
		var mapOptions = {
			zoom: 9,
			center: new google.maps.LatLng(43.589045, -79.644120),
			styles: [{"featureType":"administrative.country","elementType":"geometry","stylers":[{"visibility":"simplified"},{"hue":"#ff0000"}]}]
		};
		var mapElement = document.getElementById('map');
		var map = new google.maps.Map(mapElement, mapOptions);
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(43.589045, -79.644120),
			map: map,
			title: 'Snazzy!'
		});
	}
</script>

<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>
