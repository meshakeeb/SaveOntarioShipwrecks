<?php
namespace Boltmedia\Includes\ACF;

$files = glob(
    get_template_directory().'/customization/includes/acf/' . "*.php"
);

foreach ($files as $file) { 
    include $file; 
}
    
/**
 * Hook When saving acf_form
 *
 * @param int     $post_id Post ID of inserted/updated post.
 *
 * @return null
 */
function acfSavePost( $post_id )
{
    
    $cpt = get_post_type($post_id);
    //print_r($cpt); exit;

    switch ($cpt) {
    case "bolt_user_gallery":
        $new_title = get_the_title(get_field('u_gallery_chapter', $post_id)). ' Gallery '. $post_id .': '. get_field('u_gallery_name', $post_id);
        $post_status = "publish";
        break;

    case "gallery":
        $new_title = get_the_title(get_field('chapter', $post_id)). ' Photo '. $post_id;
        $post_status = "draft";
        break;

    case "buoystatus":
        $date = ( $_POST['acf']['field_5abd51db107be'] != "" ) ? $_POST['acf']['field_5abd51db107be'] : date('Ymd');
        $new_title = get_the_title($_POST['acf']['field_5abd51c5107bd']).'-'.$_POST['acf']['field_5abd51ea107bf'].'-'.$date;
        $post_status = "publish";
        break;    

    case "tribe_events":
        if (!is_admin() ) {
            wp_set_object_terms(
                $post_id,
                array(
                    $_POST['acf']['event_category']
                ),
                'tribe_events_cat',
                false
            );
        }   

        if ($_POST['acf']['_EventVenueID'] === "" || empty($_POST['acf']['_EventVenueID']) ) {
            createVenue($post_id);   
        }

        if ($_POST['acf']['_EventOrganizerID'] === "" || empty($_POST['acf']['_EventOrganizerID']) ) {
            createOrganizer($post_id);   
        }        

        return;
        break;
    default:
        return;
    } 
    

    $args = array(
    'ID'           => $post_id,
    'post_title'   => $new_title,
    'post_status'  => $post_status,
    'post_type'    => $cpt,
    'post_author'  => get_current_user_id()
    );

    if (wp_update_post($args) != 0 ) {
        if ($cpt === "buoystatus" ) {
            namespace\newBuoyStatusEmail($post_id);            
        }   
    }


}   


function createVenue($post_id)
{

    $venue_meta = array(
        '_VenueAddress'         => $_POST['acf']['_VenueAddress'],
        '_VenueAddress'         => $_POST['acf']['_VenueAddress'],
        '_VenueCity'            => $_POST['acf']['_VenueCity'],
        '_VenueCountry'         => $_POST['acf']['_VenueCountry'],
        '_VenueProvince'        => $_POST['acf']['_VenueProvince'],
        '_VenueZip'             => $_POST['acf']['_VenueZip'],
        '_EventShowMap'         => $_POST['acf']['_EventShowMap'],
        '_VenueOverwriteCoords' => $_POST['acf']['_VenueOverwriteCoords'],
        '_VenueLat'             => $_POST['acf']['_VenueLat'],
        '_VenueLng'             =>  $_POST['acf']['_VenueLng'],
    );

    $args = array(
       'post_author' => get_current_user_id(),
       'post_title' => $_POST['acf']['venue_name'],
       'post_type' => 'tribe_venue',
       'comment_status' => 'closed',
       'post_status' => 'publish',
       'meta_input' => $venue_meta
    );

    
    $event_location = wp_insert_post($args);      

    if ($event_location > 0) {
        update_post_meta($post_id, '_EventVenueID', $event_location);
    }    
}

function createOrganizer($post_id){

    $organizer_meta = array(
        '_OrganizerPhone'         => $_POST['acf']['_OrganizerPhone'],
        '_OrganizerWebsite'       => $_POST['acf']['_OrganizerWebsite'],
        '_OrganizerEmail'         => $_POST['acf']['_OrganizerEmail'],
    );

    $args = array(
       'post_author' => get_current_user_id(),
       'post_title' => $_POST['acf']['organizer_name'],
       'post_type' => 'tribe_organizer',
       'comment_status' => 'closed',
       'post_status' => 'publish',
       'meta_input' => $organizer_meta
    );

    
    $organizer = wp_insert_post($args);      

    if ($organizer > 0) {
        update_post_meta($post_id, '_EventOrganizerID', $organizer);
    }    
}


/**
 * New buoy status email.
 *
 * @param int $post_id Post ID of updated post.
 *
 * @return null
 */
function newBuoyStatusEmail( $post_id ) 
{

    $u = wp_get_current_user();

    if ($u === 0 
        || wp_is_post_revision($post_id) 
        || 'publish' !== get_post_status($post_id) 
    ) {
        return;
    }

    $newbuoy =  get_option('email_newbuoy'); 

    //print_r($newbuoy); exit;
    $vid = get_post_meta( 
        get_post_meta($post_id, 'site_name', true), 
        "vid",  
        true
    );

    global $wpdb;
    $latlng = $wpdb->get_row(
        "SELECT
        C.lid AS lid,
        D.latitude, D.longitude
        FROM location_instance AS C
        LEFT JOIN location AS D ON C.lid = D.lid 
        WHERE C.vid='". $vid."'"
    );

    $filter_search = array(
        '{name}', 
        '{post}',
        '{buoy_status}',
        '{buoy_date}',
        '{lat}',
        '{lng}' 
    );

    $filter_replace = array(
        get_user_meta($u->ID, 'billing_first_name', true) , 
        get_permalink($post_id),
        get_field("buoy_status", $postid),
        get_field("record_date", $postid),
        $latlng->latitude,
        $latlng->longitude
    );

    $title = str_replace($filter_search, $filter_replace, $newbuoy['title']);
    $content = str_replace($filter_search, $filter_replace, $newbuoy['content']);   


    $headers = null;
    $headers .= 'From: Save Ontario Shipwrecks <wordpress@saveontarioshipwrecks.ca>' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";             


    $headers = 'From: Save Ontario Shipwrecks <wordpress@dev.boltmedia.ca>' . "\r\n";

    wp_mail($u->user_email, $newbuoy->title, wpautop($content), $headers);
}    

