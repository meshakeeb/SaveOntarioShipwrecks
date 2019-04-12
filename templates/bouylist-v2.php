<?php
	global $shortname;
	require_once get_theme_file_path().'/customization/class/class.buoy.php';
	$data = new BoltMediaBuoy;
?>
<?php
/* Template Name: Buoy list V2*/
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
						<form action="<?php the_permalink( get_the_ID() ) ?>" method="get">
							<input type="text" name="search"  placeholder="Search a buoy name, group name, body of water...">
							<button type="submit" name="submit" value="search"><i class="fa fa-search"></i></button>
						</form>
					</div>

					<?php if( is_user_logged_in() ) : ?>
					<div>
						<br>
						<h2>
							<form id="export_buoy" action="" method="post">
								<input type="hidden" name="export_me" value="buoy-site-list">
								<p><button class="btn btn-primary"><i class="fa fa-cloud-download"></i> Export as CSV</button></p>
							</form>

						</h2>
					</div>
					<?php endif; ?>

					<div class="table-responsive">
					<table class="table data-table table-striped">
						<thead>
							<tr>
								<th><a href="?orderby=A.post_name&amp;order=<?php echo $data->Sort()[1]; ?>">Site Name <i class="fa fa-sort"></i></a></th>
								<th><a href="?orderby=F.name&amp;order=<?php echo $data->Sort()[1]; ?>">Group <i class="fa fa-sort"></i></a></th>
								<th><a href="?orderby=E.field_bodywater_value&amp;order=<?php echo $data->Sort()[1]; ?>">Body of Water <i class="fa fa-sort"></i></a></th>
								<th><a href="?orderby=D.latitude&amp;order=<?php echo $data->Sort()[1]; ?>">Latitude <i class="fa fa-sort"></i></a></th>
								<th><a href="?orderby=D.longitude&amp;order=<?php echo $data->Sort()[1]; ?>">Longitude <i class="fa fa-sort"></i></a></th>
								<th><a href="?orderby=status&amp;order=<?php echo $data->Sort()[1]; ?>">Buoy Status <i class="fa fa-sort"></i></a></th>
								<?php if ( in_array( 'buoy_editors', (array) $current_user->roles ) || in_array( 'buoy_site_administrator', (array) $current_user->roles ) || in_array( 'administrator', (array) $current_user->roles ) ) : ?>
									<th>Edit</th>
								<?php  else : ?>
									<th>Report</th>
								<?php endif; ?>
							</tr>
						</thead>
						<tbody>
						<?php foreach($data->GetBuoys() as $d) :

							$chapter_edior=get_the_author_meta( 'chapter',  $current_user->ID);

							if($chapter_edior==500){ $comm='SOS Windsor'; }
							if($chapter_edior==499){ $comm='SOS Toronto'; }
							if($chapter_edior==498){ $comm='SOS Thousand Islands'; }
							if($chapter_edior==497){ $comm='SOS Superior'; }
							if($chapter_edior==495){ $comm='SOS Ottawa'; }
							if($chapter_edior==494){ $comm='SOS Manitoulin'; }
							if($chapter_edior==493){ $comm='SOS Huron Shores'; }
							if($chapter_edior==492){ $comm='SOS Hamilton'; }
							if($chapter_edior==491){ $comm='SOS Barrie'; }

							$ty=array();

							$argsq = array(
								'post_type'   => 'buoystatus',
								'post_status' => 'publish',
								'meta_key'	  => 'site_name',
								'meta_value'  => $d->postID
							);

							$events = get_posts( $argsq );

							foreach($events as $event ) {
								$ty[]=get_post_meta( $event->ID, 'buoy_status', true );
							}

						?>
							<tr>
								<td><a href="<?php echo get_permalink($d->postID); ?>"><?php echo get_the_title($d->postID); ?></a></td>
								<td><?php echo $d->group_name; ?></td>
								<td><?php echo $d->water; ?></td>
								<td><?php echo $d->latitude; ?></td>
								<td><?php echo $d->longitude; ?></td>

								<td><?php echo (!empty($ty)) ? ucfirst($ty[0]) : '-'; ?></td>
								<td>
									<?php $user = wp_get_current_user(); ?>
									<?php
									if (
										in_array( 'administrator', (array) $user->roles )
										|| in_array( 'chapter_editor', (array) $user->roles )
										|| in_array( 'buoy_editors', (array) $user->roles )
										|| in_array( 'bolt_chapter_editor', (array) $user->roles )
									) :
									?>
										<?php if($comm==$d->group_name || in_array( 'administrator', (array) $user->roles )) : ?>
											<a href="<?php echo home_url().'/buoy-program/buoy-site-list/edit/?id='.$d->postID; ?>" class="remove"><i class="fa fa-edit"></i></a>
										<?php else : ?>
											<a href="<?php echo get_bloginfo("url") .'/report-buoy-status/?site='.get_the_title($d->postID); ?>" class="remove"><i class="fa fa-edit"></i></a>
										<?php endif; ?>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>

					</div>
				</div>
			</div>
<?php get_sidebar();?>
		</div>
	</div>
<?php //include( get_template_directory() . '/widgets/cta.php'); ?>

<script src="<?php bloginfo('template_url'); ?>/js/vendor/jquery-1.11.2.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/vendor/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/main.js"></script>

 <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDIWywiDstiD8Ki0mxWxQ6dNc_PFSISE4M&sensor=true"></script>
<script src="<?php bloginfo('template_url'); ?>/js/gmaps.js"></script>
<script type="text/javascript">

		jQuery(document).ready(function(){

		var map = new GMaps({
			el: '#google-map',
			lat: 43.589045,
			lng: -79.644120,
			scrollwheel: false,zoom: 15

		});

		/* Map Bound */
		var bounds = [];

		<?php foreach( $data->GetBuoys1() as $m ) { if($m->latitude!='' && $m->latitude!='0.000000'){?>
			/* Set Bound Marker */
			var latlng = new google.maps.LatLng(<?php echo $m->latitude; ?>, <?php echo $m->longitude; ?>);
			bounds.push(latlng);
			/* Add Marker */
		   map.addMarker({
				lat: <?php echo $m->latitude; ?>,
				lng: <?php echo $m->longitude; ?>,
				title: '<?php echo  str_replace("'", "",$name); ?>',
				infoWindow: {content: '<p><?php echo get_the_title($m->postID); ?><br><?php echo $m->group_name; ?></p>'}
			});
		<?php }}   ?>

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
