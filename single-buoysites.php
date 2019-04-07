<?php global $shortname; ?>

<?php
get_header();
global $post;
setup_postdata( $post );
$postid=get_the_ID();

$vid=get_post_meta($postid,'vid',true);
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


function beliefmedia_dec_dms($dec) {

  $vars = explode(".", $dec);
  $deg = $vars[0];
  $tempma = '0.' . $vars[1];

  $tempma = $tempma * 3600;
  $min = floor($tempma / 60);
  $sec = $tempma - ($min * 60);

 return array('deg' => $deg, 'min' => $min, 'sec' => $sec);
}
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

        $qry_content = "SELECT * FROM content_type_buoy where vid='".$vid."'";
        $rqry_content= mysqli_query($mysqli,$qry_content);
        $rqry_contents= mysqli_fetch_assoc($rqry_content);
        $field_buoy_location_value=$rqry_contents['field_buoy_location_value'];
        $field_bouy_site_active_status_value=$rqry_contents['field_bouy_site_active_status_value'];

        $field_site_id_value=$rqry_contents['field_site_id_value'];
        $field_organization_value =$rqry_contents['field_organization_value'];
        $field_official_number_value =$rqry_contents['field_official_number_value'];

        $field_official_number_value=$rqry_contents['field_official_number_value'];
        $field_nation_value=$rqry_contents['field_nation_value'];
        $field_built_year_value=$rqry_contents['field_built_year_value'];
        $field_built_location_value=$rqry_contents['field_built_location_value'];
        $field_built_by_value=$rqry_contents['field_built_by_value'];
        $field_wreck_type_value=$rqry_contents['field_wreck_type_value'];
        $field_rig_value=$rqry_contents['field_rig_value'];
        $field_length_value=$rqry_contents['field_length_value'];
        $field_beam_value=$rqry_contents['field_beam_value'];
        $field_draft_value=$rqry_contents['field_draft_value'];
        $field_tonnage_value=$rqry_contents['field_tonnage_value'];
        $field_buoy_description_value=$rqry_contents['field_buoy_description_value'];
        $field_tonnage_value=$rqry_contents['field_tonnage_value'];
        $field_buoy_material_value=$rqry_contents['field_buoy_material_value'];
        $field_bodywater_value=$rqry_contents['field_bodywater_value'];
        $field_latitude_value=$rqry_contents['field_latitude_value'];
        $field_longitude_value=$rqry_contents['field_longitude_value'];
        $field_current_value=$rqry_contents['field_current_value'];
        $field_buoy_type_value=$rqry_contents['field_buoy_type_value'];
        $field_line_type_value=$rqry_contents['field_line_type_value'];
        $field_line_size_value=$rqry_contents['field_line_size_value'];
        $field_line_length_value=$rqry_contents['field_line_length_value'];
        $field_anchor_type_value=$rqry_contents['field_anchor_type_value'];
        $field_anchor_weight_value=$rqry_contents['field_anchor_weight_value'];
        $field_depth_max_value=$rqry_contents['field_depth_max_value'];
        $field_buoy_notess_value=$rqry_contents['field_buoy_notess_value'];
        $field_depth_min_value=$rqry_contents['field_depth_min_value'];
        $field_plaque_value=$rqry_contents['field_plaque_value'];
/*record date*/


        $qry_content_r = "SELECT * FROM content_field_record_date where vid='".$vid."'";
        $rqry_content_r= mysqli_query($mysqli,$qry_content_r);
        $rqry_contents_r= mysqli_fetch_assoc($rqry_content_r);

        $recorddate =$rqry_contents_r['field_record_date_value'];
        $vexplode=explode('-',$recorddate);
        $Texplode=explode('T', $vexplode[2]);
        $drecord=$Texplode[0];
        $mrecord=$vexplode[1];
        $yrecord=$vexplode[0];
         $tid = "SELECT name FROM term_data where tid='".$field_organization_value."'";
        $tids = mysqli_query($mysqli,$tid);
        $tid_row = mysqli_fetch_assoc($tids);
        $field_organization_name = $tid_row['name'];


         $qry_location = "SELECT * FROM location_instance where vid='".$vid."'";
          $result_location = mysqli_query($mysqli,$qry_location);
        $row_location = mysqli_fetch_assoc($result_location);
        $lid= $row_location['lid'];

        /*latitude long */

         $qry_locations = "SELECT * FROM location where lid='".$lid."'";
            $result_locations = mysqli_query($mysqli,$qry_locations);
        $row_locations = mysqli_fetch_assoc($result_locations);
         $lat= $row_locations['latitude']; $long= $row_locations['longitude'];

          $latpos = (strpos($lat, '-') !== false) ? 'S' : 'N';
   $lat1 = beliefmedia_dec_dms($lat);

   $lngpos = (strpos($long, '-') !== false) ? 'W' : 'E';
   $lng = beliefmedia_dec_dms($long);

 $res_lat_long= $latpos . abs($lat1['deg']) . '&deg;' . $lat1['min'] . '&apos;' . $lat1['sec'] . '&quot ' . $lngpos . abs($lng['deg']) . '&deg;' . $lng['min'] . '&apos;' . $lng['sec'] . '&quot';

/*$url      = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_path = parse_url( $url, PHP_URL_PATH );
echo $slug = pathinfo( $url_path, PATHINFO_BASENAME );*/
?>


    <div class="page_header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="text-capitalize"><?php the_title(); ?></h1>
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
                        <form action="<?php bloginfo('url'); ?>/buoy-program/buoy-site-list/" method="post">
                            <input type="text" name="search"  placeholder="Search a buoy name, group name, body of water...">
                            <button type="submit" name="submit" value="search"><i class="fa fa-search"></i></button>
                        </form>

                        <a href="#" class="back-to"><i class="fa fa-arrow-left"></i> Back to Buoy List</a>
                    </div>

                    <div class="buoy-details">
                        <div id="map"></div>

                        <div class="buoy-details-inner">
                            <h3><span>Site Name</span><?php the_title(); ?></h3>

                            <ul>
                                <li class="col-sm-12">
                                    <span>Location:</span>
                                    <p><?php echo $field_buoy_location_value; ?> / <?php echo $res_lat_long; ?> </p>
                                </li>

                                <li class="col-sm-6 border-right">
                                    <span>Site ID:</span>
                                    <p><?php echo $field_site_id_value; ?></p>
                                </li>

                                <li class="col-sm-6">
                                    <span>Organization:</span>
                                    <p><?php echo $field_organization_name; ?></p>
                                </li>

                                <li class="col-sm-6 border-right">
                                    <span>Record Date:</span>
                                    <p><?php $monthNum  = $mrecord;
$monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); echo $monthName.' '.$drecord; ?>,<?php echo $yrecord; ?></p>
                                </li>

                                <li class="col-sm-6">
                                    <span>Wreck Type:</span>
                                    <p><?php echo $field_wreck_type_value; ?></p>
                                </li>

                                <li class="col-sm-6 border-right">
                                    <span>Rig:</span>
                                    <p><?php echo $field_rig_value; ?></p>
                                </li>

                                <li class="col-sm-6">
                                    <span>Length:</span>
                                    <p><?php echo $field_length_value; ?></p>
                                </li>

                                <li class="col-sm-6 border-right">
                                    <span>Hull Material:</span>
                                    <p><?php
                                    if($field_buoy_material_value=="35"){ echo 'Aluminum'; }
                                    if($field_buoy_material_value=="36"){ echo 'Fiberglass'; }
                                    if($field_buoy_material_value=="37"){ echo 'Metal clad Wood'; }
                                    if($field_buoy_material_value=="38"){ echo 'Other'; }
                                    if($field_buoy_material_value=="39"){ echo 'Steel'; }
                                    if($field_buoy_material_value=="40"){ echo 'Wood'; }

                                    ?></p>
                                </li>

                                <li class="col-sm-6">
                                    <span>Body of Water:</span>
                                    <p><?php echo $field_bodywater_value; ?></p>
                                </li>

                                <li class="col-sm-4 border-right">
                                    <span>Depth min:</span>
                                    <p><?php echo $field_depth_min_value; ?></p>
                                </li>

                                <li class="col-sm-4 border-right">
                                    <span>Depth max:</span>
                                    <p><?php echo $field_depth_max_value; ?></p>
                                </li>

                                <li class="col-sm-4">
                                    <span>Current:</span>
                                    <p><?php
                                    if($field_current_value=="29"){ echo '0.5-1 Knot'; }
                                    if($field_current_value=="30"){ echo '1-2 Knots'; }
                                    if($field_current_value=="31"){ echo '2-3 Knots'; }
                                    if($field_current_value=="32"){ echo '3-4 Knots'; }
                                    if($field_current_value=="33"){ echo '4 Knots'; }
                                    if($field_current_value=="34"){ echo 'No Current'; }
                                     ?></p>
                                </li>

                                <li class="col-sm-4 border-right">
                                    <span>Buoy Type:</span>
                                    <p><?php
                                    if($field_buoy_type_value=="2"){ echo 'Cone - Plastic'; }
                                    if($field_buoy_type_value=="3"){ echo 'Conical'; }
                                    if($field_buoy_type_value=="4"){ echo 'Conical w/Lite'; }
                                    if($field_buoy_type_value=="5"){ echo 'Drum-lg'; }
                                    if($field_buoy_type_value=="6"){ echo 'Drum-sm'; }
                                    if($field_buoy_type_value=="7"){ echo 'Jug-lg'; }
                                    if($field_buoy_type_value=="8"){ echo 'Jug-sm'; }
                                    if($field_buoy_type_value=="9"){ echo 'Other'; }
                                    if($field_buoy_type_value=="10"){ echo 'Spar'; }
                                    if($field_buoy_type_value=="11"){ echo 'Spar - Plastic'; }
                                    if($field_buoy_type_value=="12"){ echo 'Spar Ice'; }
                                     ?></p>
                                </li>

                                <li class="col-sm-4 border-right">
                                    <span>Line Type:</span>
                                    <p><?php
                                    if($field_line_type_value=="50"){ echo 'Cable - coated'; }
                                    if($field_line_type_value=="51"){ echo 'Cable - Uncoat'; }
                                    if($field_line_type_value=="52"){ echo 'Chain - Galv'; }
                                    if($field_line_type_value=="53"){ echo 'Chain - nonGalv'; }
                                    if($field_line_type_value=="54"){ echo 'Chain - SS'; }
                                    if($field_line_type_value=="55"){ echo 'Nylon - braid'; }
                                    if($field_line_type_value=="56"){ echo 'Nylon - twist'; }
                                    if($field_line_type_value=="57"){ echo 'Polyest - braid'; }
                                    if($field_line_type_value=="58"){ echo 'Polyest - twist'; }
                                    if($field_line_type_value=="59"){ echo 'Polypro - braid'; }
                                    if($field_line_type_value=="60"){ echo 'Polypro - twist'; }
                                     ?></p>
                                </li>

                                <li class="col-sm-4">
                                    <span>Line Size:</span>
                                    <p><?php echo $field_line_size_value; ?></p>
                                </li>

                                <li class="col-sm-4 border-right">
                                    <span>Buoy Anchor Type:</span>
                                    <p><?php
                                    if($field_anchor_type_value=="13"){ echo 'Cage & Rock'; }
                                    if($field_anchor_type_value=="14"){ echo 'Cement - Large'; }
                                    if($field_anchor_type_value=="15"){ echo 'Cement - Small'; }
                                    if($field_anchor_type_value=="16"){ echo 'Iron Weight'; }
                                    if($field_anchor_type_value=="17"){ echo 'Rod Screws'; }
                                    if($field_anchor_type_value=="18"){ echo 'Wreck / Site'; }
                                     ?></p>
                                </li>

                                <li class="col-sm-4 border-right">
                                    <span>SOS Plaque:</span>
                                    <p><?php echo $field_plaque_value; ?></p>
                                </li>

                                <li class="col-sm-4">
                                    <span>Notes:</span>
                                    <p><?php echo $field_buoy_notess_value; ?></p>
                                </li>

                                <li class="col-sm-12">
                                    <span>Description:</span>
                                    <p><?php echo $field_buoy_description_value; ?></p>
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


                                <?php global $wpdb;
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
                                        }
                                          //mysql_select_db('boltmedia_sos',$link);

                                    //$postifds= mysqli_query($mysqli,$postifd);
                                                $argsq = array(
                                                    'post_type' => 'buoystatus',
                                            'post_status' => 'publish',

                                                    'meta_key'          => 'site_name',
                                                    'meta_value'            => $postid
                                                    ); $events = get_posts( $argsq );
                                       // $postidfind = mysqli_fetch_assoc($postifds);
                                        //print_r($postidfind);
                                           foreach($events as $event ) {
                                        // get country
                                             $country = get_post_meta( $event->ID, 'site_name', true );

                                                //s$post = get_post($postid); echo '<pre>'; print_r($post); echo '<pre>';


                                           //   if($row['ID']!=''){
                                                echo '<tr>';
                                      echo '<td><a href="'.get_permalink($country).'" >'.get_the_title($country).'</a></td>';
                                       echo '<td>'.date('d/m/Y',strtotime(get_post_meta( $event->ID, 'record_date', true ))).'</td>';
                                       echo '<td>'.ucfirst(get_post_meta( $event->ID, 'buoy_status', true )).'</td>';
                                       echo '<td>'.get_post_meta( $event->ID, 'notship', true ).'</td>';
                                       echo '<td>'.get_post_meta( $event->ID, 'comment', true ).'</td>';
                                          echo '</tr>';
                                        //}
                                        # code...
                                    }
                                      ?>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>



<script src="<?php bloginfo('template_url'); ?>/js/vendor/jquery-1.11.2.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/vendor/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/main.js"></script>

 <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyBGR5vuXhZv_WblBffFsKifH36aHqObSo0&sensor=true"></script>
<script src="<?php bloginfo('template_url'); ?>/js/gmaps.js"></script>
<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        var mapOptions = {
            zoom: 9,
            center: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long; ?>),
            styles: [{"featureType":"administrative.country","elementType":"geometry","stylers":[{"visibility":"simplified"},{"hue":"#ff0000"}]}]
        };
        var mapElement = document.getElementById('map');
        var map = new google.maps.Map(mapElement, mapOptions);
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long; ?>),
            map: map,
            title: 'Snazzy!'
        });
    }
</script>

    <div class="cta-dark">
        <div class="container">
            <div class="cta">
                <p>Save Ontario Shipwrecks gratefully acknowledge the Ministry of Tourism, Culture and Sport, Culture Programs Unit and our many sponsors for their support. We also gratefully acknowledge the financial support of the Ontario Trillium Foundation, an agency of the Ministry of Culture.</p>
                <img src="<?php bloginfo('template_url'); ?>/images/logos-dark.jpg" alt=""/>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
