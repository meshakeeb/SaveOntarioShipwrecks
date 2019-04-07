<?php global $shortname; ?>

<?php
/* Template Name: Buoy Detail*/
get_header(); 
/*$url      = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_path = parse_url( $url, PHP_URL_PATH );
echo $slug = pathinfo( $url_path, PATHINFO_BASENAME );*/
?>

	
	<div class="page_header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="text-capitalize">17 Fathom Wk</h1>
				</div>
		
				<div class="col-sm-6">
					<div class="bcrumbs">
						<div class="container">
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#">Get Involved</a></li>
								<li><span>Buoy Program</span></li>
							</ul>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>
	
	<div class="about-single">
		<div class="container row-eq-height">
			<div class="col-sm-12 about-single-content buoy-list-details">
			
				<div class="about-single-info">
					<div class="map-search status-search">
						<form>
							<input type="text" placeholder="Search a buoy name, group name, body of water...">
							<button type="submit"><i class="fa fa-search"></i></button>
						</form>
							
						<a href="#" class="back-to"><i class="fa fa-arrow-left"></i> Back to Buoy List</a>
					</div>

					<div class="buoy-details">
						<div id="map"></div>
						
						<div class="buoy-details-inner">
							<h3><span>Site Name</span>17 Fathom Wk</h3>
						
							<ul>
								<li class="col-sm-12">
									<span>Location:</span>
									<p>139 deg T 11.7M off Port Dover / 42° 39' 6.1812" N, 80° 3' 8.7012" W</p>
								</li>
								
								<li class="col-sm-6 border-right">
									<span>Site ID:</span>
									<p>56</p>
								</li>
								
								<li class="col-sm-6">
									<span>Organization:</span>
									<p>SOS Port Dover</p>
								</li>		
								
								<li class="col-sm-6 border-right">
									<span>Record Date:</span>
									<p>June 11, 2003</p>
								</li>
								
								<li class="col-sm-6">
									<span>Wreck Type:</span>
									<p>Schooner</p>
								</li>	
																
								<li class="col-sm-6 border-right">
									<span>Rig:</span>
									<p>2 masted</p>
								</li>
								
								<li class="col-sm-6">
									<span>Length:</span>
									<p>77</p>
								</li>
								
								<li class="col-sm-6 border-right">
									<span>Hull Material:</span>
									<p>Wood</p>
								</li>
								
								<li class="col-sm-6">
									<span>Body of Water:</span>
									<p>Lake Erie</p>
								</li>	
							
								<li class="col-sm-4 border-right">
									<span>Depth min:</span>
									<p>105</p>
								</li>

								<li class="col-sm-4 border-right">
									<span>Depth max:</span>
									<p>105</p>
								</li>

								<li class="col-sm-4">
									<span>Current:</span>
									<p>0.5-1 Knot</p>
								</li>	

								<li class="col-sm-4 border-right">
									<span>Buoy Type:</span>
									<p>Cone - Plastic</p>
								</li>

								<li class="col-sm-4 border-right">
									<span>Line Type:</span>
									<p>Cable - coated</p>
								</li>

								<li class="col-sm-4">
									<span>Line Size:</span>
									<p>1/4"</p>
								</li>								
								
								<li class="col-sm-4 border-right">
									<span>Buoy Anchor Type:</span>
									<p>Cage & Rock</p>
								</li>

								<li class="col-sm-4 border-right">
									<span>SOS Plaque:</span>
									<p>No</p>
								</li>

								<li class="col-sm-4">
									<span>Notes:</span>
									<p>Bow lies S</p>
								</li>	

								<li class="col-sm-12">
									<span>Description:</span>
									<p>Little is know about this sailing vessel, other than the fact that she appears to have had a fire on board.</p>
								</li>								
							</ul>
						
						
						</div>
					
					</div>
					
					<h4>Buoy Status Updates</h4>
					
					<div class="table-responsive">					
						<table class="table data-table table-striped">
							<thead>
								<tr>
									<th>Site Name</th>
									<th>Record Date</th>
									<th>Buoy Status</th>
									<th>NOTSHIP#</th>
									<th>Comment</th>
									
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>17 Fathom Wk</td>
									<td>23 05 2014</td>
									<td>Unknown</td>
									<td></td>
									<td>This entry made to disambiguate the site list as <br>the last update was from several years ago or never.</td>
								</tr>
								<tr>
									<td>17 Fathom Wk</td>
									<td>27 06 2012</td>
									<td>Deployed</td>
									<td>C1103/12</td>
									<td>Deployed for the summer season</td>
								</tr>
								<tr>
									<td>17 Fathom Wk</td>
									<td>05 12 2017</td>
									<td>Swapped</td>
									<td>C1103/12</td>
									<td>Cancels C1391/09 or C1418/09</td>
								</tr>
													
							</tbody>
						</table>
					</div>

				</div>
			</div>
			
		</div>
	</div>

	<div class="cta-info">
		<div class="container">
			<p>Become a Member. <b class="fw500">Sign up now!</b> <a href="#">Register</a></p>
		</div>
	</div>
	
	<div class="cta-dark">
		<div class="container">
			<div class="cta">
				<p>Save Ontario Shipwrecks gratefully acknowledge the Ministry of Tourism, Culture and Sport, Culture Programs Unit and our many sponsors for their support. We also gratefully acknowledge the financial support of the Ontario Trillium Foundation, an agency of the Ministry of Culture.</p>
				<img src="images/logos-dark.jpg" alt=""/>
			</div>
		</div>
	</div>
	
<script src="<?php bloginfo('template_url'); ?>/js/vendor/jquery-1.11.2.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/vendor/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/main.js"></script>

 <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDIWywiDstiD8Ki0mxWxQ6dNc_PFSISE4M&sensor=true"></script>
<script src="<?php bloginfo('template_url'); ?>/js/gmaps.js"></script>
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

<?php get_footer(); ?>
