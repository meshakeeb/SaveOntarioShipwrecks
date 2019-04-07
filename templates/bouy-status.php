<?php global $shortname; 
    require_once get_theme_file_path().'/customization/class/class.buoy.php';
    $data = new BoltMediaBuoy;
?>

<?php
/* Template Name: Buoy status*/
get_header(); ?>

    
    <div class="page_header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="text-capitalize">Buoy Status</h1>
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
                    <!--<div id="google-map" class="google-map" style="height: 450px;">
                    </div>
                    <div id="mapdd"></div>-->
                    <div class="map-search">
                        <form action="<?php bloginfo('url'); ?>/buoy-program/buoy-status-updates/" method="post">
                            <input type="text" name="search"  placeholder="Search a buoy name, group name, body of water...">
                            <button type="submit" name="submit" value="search"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                   
                    <div class="table-responsive">                  
                        <table class="table data-table table-striped">
                            <thead>
                                <tr>
                                    <th> <?php if($_GET['order']=='' || $_GET['order']=='ASC'){ ?>
                                        <a href="<?php echo site_url()?>/buoy-program/buoy-status-updates?orderby=title&order=DESC"><i class="fa fa-sort"></i></a><?php }else{ ?><a href="<?php echo site_url()?>/buoy-program/buoy-status-updates?orderby=title&order=ASC"><i class="fa fa-sort"></i></a>
                                        <?php } ?>Site Name</th>
                                    <th> <?php if($_GET['order']=='' || $_GET['order']=='ASC'){?>
                                        <a href="<?php echo site_url()?>/buoy-program/buoy-status-updates?orderby=record_date&order=DESC"><i class="fa fa-sort"></i></a><?php }else{ ?><a href="<?php echo site_url()?>/buoy-program/buoy-status-updates?orderby=record_date&order=ASC"><i class="fa fa-sort"></i></a>
                                        <?php } ?>Record Date</th>
                                    <th> <?php if($_GET['order']=='' || $_GET['order']=='ASC'){?>
                                        <a href="<?php echo site_url()?>/buoy-program/buoy-status-updates?orderby=buoy_status&order=DESC">
                                        <i class="fa fa-sort"></i></a><?php }else{ ?>
                                        <a href="<?php echo site_url()?>/buoy-program/buoy-status-updates?orderby=buoy_status&order=ASC">
                                        <i class="fa fa-sort"></i></a>
                                        <?php } ?>Buoy Status </th>
                                        
                                            
                                    <th>NOTSHIP# </th>
                                    <th>Comment</th>
                                    <?php if ( in_array( 'buoy_editors', (array) $current_user->roles ) || in_array( 'buoy_site_administrator', (array) $current_user->roles ) || in_array( 'administrator', (array) $current_user->roles ) || in_array( 'bolt_chapter_editor', (array) $current_user->roles )) { ?>
                                    <th>Edit </th>
                                <?php  } ?> <?php if ( in_array( 'buoy_editors', (array) $current_user->roles ) || in_array( 'buoy_site_administrator', (array) $current_user->roles ) || in_array( 'administrator', (array) $current_user->roles ) || in_array( 'bolt_chapter_editor', (array) $current_user->roles )) { ?>
                                    <th>Delete</th>
                                <?php  } ?> 
                                </tr>
                            </thead>
                            <tbody>
 
                                            
                                <?php global $wpdb;
                                function add_join_wpse_99849($joins) {
                                      global $wpdb;
                                      return $joins . " INNER JOIN {$wpdb->postmeta} ON ({$wpdb->posts}.ID = {$wpdb->postmeta}.post_id)";
                                    }

                                    function alter_search_wpse_99849($search,$qry) {
                                      global $wpdb;
                                      $add = $wpdb->prepare("({$wpdb->postmeta}.meta_key = 'keywords' AND CAST({$wpdb->postmeta}.meta_value AS CHAR) LIKE '%%%s%%')",$qry->get('s'));
                                      $pat = '|\(\((.+)\)\)|';
                                      $search = preg_replace($pat,'(($1 OR '.$add.'))',$search);
                                      return $search;
                                    }
                                     $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                                  if(isset($_POST['submit']) && $_POST['submit']=='search'){ 
                                    $args1 = get_posts(array(
                                      'post_type' => 'buoystatus',
                                      's' => $_POST['search']
                                    ));
                                    $args = get_posts(array(
                                        'post_type' => 'buoystatus',
                                        'posts_per_page'   => 10,
                                        'paged' => $paged,
                                        'meta_query' => array (
                                                    'relation' => 'OR',
                                                            array(
                                                                'key' => 'buoy_status',
                                                                'value' => $_POST['search'],
                                                                'compare' => 'LIKE'
                                                            ),array(
                                                                'key' => 'notship',
                                                                'value' => $_POST['search'],
                                                                'compare' => 'LIKE'
                                                            ),array(
                                                                'key' => 'comment',
                                                                'value' => $_POST['search'],
                                                                'compare' => 'LIKE'
                                                            )
                                                        )
                                    
                                        ));
                                    $args2 = get_posts(array(
                                        'post_type' => 'buoystatus',
                                        'posts_per_page'   => 10,
                                        'paged' => $paged,
                                        'meta_query' => array (
                                                    'relation' => 'OR',
                                                           array(
                                                                'key' => 'comment',
                                                                'value' => $_POST['search'],
                                                                'compare' => 'LIKE'
                                                            )
                                                        )
                                    
                                        ));

                                    $merged = array_merge( $args1, $args ); 
                                      $post_ids = array();
                                        foreach( $merged as $item ) {
                                            $post_ids[] = $item->ID;
                                        }

                                        $unique = array_unique($post_ids);

                                        $events = get_posts(array(
                                            'post_type' => 'buoystatus',
                                            'post__in' => $unique,
                                            'post_status' => 'publish',
                                        'posts_per_page'   => 10,
                                        'paged' => $paged,
                                        ));
                                    }else{
                                        $args1 = array(
                                          'post_type' => 'buoystatus',
                                        'posts_per_page'   => 10,
                                        'paged' => $paged,
                                        'meta_key'          => 'record_date',
                                        'orderby'           => 'meta_value',
                                        'order'             => 'DESC'
                                        );

                                        /*
                                        $args = array(
                                        'post_type' => 'buoystatus',
                                        'posts_per_page'   => 10,
                                        'paged' => $paged,
                                        'meta_key'          => 'record_date',
                                        'orderby'           => 'meta_value',
                                        'order'             => 'DESC'
                                         );*/
                                         if( $_GET['orderby']!='' || $_GET['order']!=''){ 
                                               if($_GET['orderby']=='record_date'){
                                             //print_r($args);
                                                $args = array(
                                                    'post_type' => 'buoystatus',
                                                    'posts_per_page'   => 10,
                                                    'paged' => $paged,
                                                    'meta_key'          => 'record_date',
                                                    'orderby'           => 'meta_value',
                                                    'order'             => $_GET['order']
                                                    );
                                                
                                                
                                                }else if($_GET['orderby']=='buoy_status'){
                                             //print_r($args);
                                                $args = array(
                                                    'post_type' => 'buoystatus',
                                                    'posts_per_page'   => 10,
                                                    'paged' => $paged,
                                                    'meta_key'          => 'buoy_status',
                                                    'orderby'           => 'meta_value',
                                                    'order'             => $_GET['order']
                                                    );
                                                
                                                
                                                }else{
                                                
                                                 $args = array(
                                                    'post_type' => 'buoystatus',
                                                    'posts_per_page'   => 10,
                                                    'paged' => $paged,
                                                    'orderby'          => $_GET['orderby'],
                                                    'order'            => $_GET['order'],
                                                    
                                                    );
                                                }
                                            }else{
                                                $args = array(
                                                    'post_type' => 'buoystatus',
                                                    'posts_per_page'   => 10,
                                                    'paged' => $paged,
                                                    'meta_key'          => 'record_date',
                                                    'orderby'           => 'meta_value',
                                                    'order'             => 'DESC'
                                                    
                                                ); //print_r($args);
                                            }
//echo '<pre>'; print_r($args); echo '</pre>';
                                    $events = get_posts( $args );
                                    }
                                    /* Get events */

                                    $added = array();
                                    foreach($events as $event ) { 
                                        // get country
                                             $country = get_post_meta( $event->ID, 'site_name', true );
                                            
                                            
                                            // bail early if this country has already been added
                                        /*  if( in_array($country, $added) )
                                            {
                                                continue;
                                            }*/
                                            $vid=get_post_meta( $event->ID, 'vid', true );
                                        
                                        
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
$user = wp_get_current_user(); 
                                           $qrys = "SELECT * FROM content_type_buoy where vid='".$vid."'";
                                           $rqry_content= mysqli_query($mysqli,$qrys);
                                            $rqry_contents= mysqli_fetch_assoc($rqry_content); 
                                            $field_organization_value =$rqry_contents['field_organization_value'];
                                              $tid = "SELECT name FROM term_data where tid='".$field_organization_value."'";
                                            $tids = mysqli_query($mysqli,$tid);
                                            $tid_row = mysqli_fetch_assoc($tids);
                                            $field_organization_name = $tid_row['name'];
                                            
$variable = get_field('buoy_status', $event->ID); 
                                            $chapter_edior=get_the_author_meta( 'chapter',  $user->ID); 
                                       echo '<tr>';
                                       echo '<td><a href="'.get_permalink($country).'" >'.get_the_title($country).'</a></td>';
                                       echo '<td>'.date('m/d/Y',strtotime(get_post_meta( $event->ID, 'record_date', true ))).'</td>';
                                       echo '<td>'.ucfirst(get_post_meta( $event->ID, 'buoy_status', true )).'</td>';
                                       echo '<td>'.get_post_meta( $event->ID, 'notship', true ).'</td>';
                                       echo '<td>'.get_post_meta( $event->ID, 'comment', true ).'</td>'; ?>
                                       <td>
                                    <?php  ?>
                                    <?php if ( in_array( 'administrator', (array) $user->roles ) 
                                        || in_array( 'buoy_editors', (array) $user->roles )  
                                    || in_array( 'buoy_site_administrator', (array) $user->roles )) { 
                                    if($country==$chapter_edior || in_array( 'buoy_editors', (array) $user->roles ) || in_array( 'administrator', (array) $user->roles )){
                                    ?>
                                           <a href="<?php echo home_url().'/edit-buoy-status/?id='.$event->ID; ?>" class="remove"><i class="fa fa-edit"></i> Edit</a>
                                    <?php } ?>
                                    <?php } ?>
                                     </td><td>
                                    <?php $user = wp_get_current_user();  ?>
                                    <?php if ( in_array( 'administrator', (array) $user->roles ) 
                                        || in_array( 'buoy_editors', (array) $user->roles ) 
                                    || in_array( 'buoy_site_administrator', (array) $user->roles )) { 
                                    //if($country==$chapter_edior){
                                    ?>
                                           <a href="<?php echo home_url().'/trash-post/?id='.$event->ID; ?>" class="remove"><i class="fa fa-delete"></i> Delete</a>
                                    <?php //}
                                    } ?>
                                     </td><?php
                                      echo '</tr>';


                                $added[] = $country;
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
 
<script src="<?php bloginfo('template_url'); ?>/js/vendor/jquery-1.11.2.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/vendor/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/main.js"></script>

 <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
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

<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>
