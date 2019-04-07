<?php global $shortname; ?>

<?php
/* Template Name:  Add Buoy site*/
get_header();

global $wpdb;
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
 if( isset($_POST['submit']) && $_POST['submit']=='Add'){

             $my_post = array(
                  'post_title'   => $_POST["title"],
                  'post_content' => $_POST["field_buoy_description_value"],
                  'post_type'   => 'buoysites',
                   'post_status'   => 'publish'
              );

             // Update the post into the database
                $pid=wp_insert_post( $my_post );
               $qry_content_update = "insert into `content_type_buoy` (`field_buoy_location_value`,
                `field_bouy_site_active_status_value`,
                `field_site_id_value`,
                `field_organization_value`,
                `field_official_number_value`,
                `field_nation_value`,
                `field_built_year_value`,
                `field_built_location_value`,
                `field_built_by_value`,
                `field_wreck_type_value`,
                `field_rig_value`,
                `field_length_value`,
                `field_beam_value`,
                `field_draft_value`,
                `field_tonnage_value`,
                `field_buoy_description_value`,
                `field_tonnage_value`,
                `field_buoy_material_value`,
                `field_bodywater_value`,
                `field_latitude_value`,
                `field_longitude_value`,
                `field_current_value`,
                `field_buoy_type_value`,
                `field_line_type_value`,
                `field_line_size_value`,
                `field_line_length_value`,
                `field_anchor_type_value`,
                `field_anchor_weight_value`,
                `field_depth_max_value`,
                `field_depth_min_value`,
                `field_buoy_notess_value`,
                `field_plaque_value`
            ) VALUES  (
                '".$_POST['field_buoy_location_value']."',
        '".$_POST['field_bouy_site_active_status_value']."',
        '".$_POST['field_site_id_value']."',
         '".$_POST['field_organization_value']."',
         '".$_POST['field_official_number_value']."',
        '".$_POST['field_official_number_value']."',
        '".$_POST['field_nation_value']."',
        '".$_POST['field_built_year_value']."',
        '".$_POST['field_built_location_value']."',
        '".$_POST['field_built_by_value']."',
        '".$_POST['field_wreck_type_value']."',
        '".$_POST['field_rig_value']."',
        '".$_POST['field_length_value']."',
        '".$_POST['field_beam_value']."',
        '".$_POST['field_draft_value']."',
        '".$_POST['field_tonnage_value']."',
        '".$_POST['field_buoy_description_value']."',
        '".$_POST['field_tonnage_value']."',
        '".$_POST['field_buoy_material_value']."',
        '".$_POST['field_bodywater_value']."',
        '".$_POST['field_latitude_value']."',
        '".$_POST['field_longitude_value']."',
        '".$_POST['field_longitude_value']."',
        '".$_POST['field_longitude_value']."',
        '".$_POST['field_current_value']."',
        '".$_POST['field_buoy_type_value']."',
        '".$_POST['field_line_type_value']."',
        '".$_POST['field_line_size_value']."',
        '".$_POST['field_line_length_value']."',
        '".$_POST['field_anchor_type_value']."',
        '".$_POST['field_anchor_weight_value']."',
        '".$_POST['field_depth_max_value']."',
        '".$_POST['field_depth_min_value']."',
        '".$_POST['field_buoy_notess_value']."',
        '".$_POST['field_plaque_value']."')";
              $updatedata= mysqli_query($mysqli,$qry_content_update);
        $vvid=mysqli_insert_id($mysqli);
        update_post_meta($pid,'vid',$vvid);
$success='New Sites Successfully Added.';
        }

?>


    <div class="page_header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="text-capitalize">Add Buoy Site</h1>
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
<?php if(isset($success) && $success!=''){ ?><br><h4 style="color:green;"><?php echo $success; ?></h4><?php } ?>
                <div class="about-single-info">
<?php
    $bolt_user = wp_get_current_user();
    if ( $bolt_user->has_cap('publish_buoy_site') || $bolt_user->has_cap('activate_plugins') ) :
?>
<form action="<?php echo site_url(); ?>/dashboard/add-buoy-site/" accept-charset="UTF-8" method="post" id="node-form" enctype="multipart/form-data" class="custom-form">
<div class="form-block">
<div class="node-form">
  <div class="standard">
<div class="form-item" id="edit-title-wrapper">


 <label for="edit-title">Site Name: <span class="form-required" title="This field is required.">*</span></label>
 <input maxlength="255" name="title" id="edit-title" size="60" value="<?php the_title(); ?>" class="form-text required" type="text" required>


</div>
<div class="form-item" id="edit-field-buoy-location-0-value-wrapper">
 <label for="edit-field-buoy-location-0-value">Location: </label>
 <input name="field_buoy_location_value" id="edit-field-buoy-location-0-value" size="60" value="<?php echo $field_buoy_location_value; ?>" class="form-text text" type="text">
</div>
<div class="form-item" id="edit-field-bouy-site-active-status-value-wrapper">

 <label for="edit-field-bouy-site-active-status-value">IS SITE ACTIVE?: </label>

 <select name="field_bouy_site_active_status_value" class="form-select" id="edit-field-bouy-site-active-status-value"><option value="">- None -</option><option value="YES" selected="selected">YES</option><option value="NO">NO</option></select>
 <div class="description">Check "Yes" if the Buoy  Site is active.</div>
</div>

<div class="form-item" id="edit-field-site-id-0-value-wrapper">
 <label for="edit-field-site-id-0-value">Site ID: </label>
 <input maxlength="10" name="field_site_id_value" id="edit-field-site-id-0-value" size="12" value="<?php echo $field_site_id_value; ?>" class="form-text number" type="text" required>
</div>
<input name="changed" id="edit-changed" value="" type="hidden">
<input name="form_build_id" id="form-559ebd51ded1c55f43137996669319ec" value="form-559ebd51ded1c55f43137996669319ec" type="hidden">
<input name="form_token" id="edit-buoy-node-form-form-token" value="470a2f244ff8ec793078bc699fb75916" type="hidden">
<input name="form_id" id="edit-buoy-node-form" value="buoy_node_form" type="hidden" required>

<div class="form-item" id="edit-field-organization-value-wrapper">
 <label for="edit-field-organization-value">Organization: </label>
 <select name="field_organization_value" class="form-select" id="edit-field-organization-value"  required>
<option value="" >- None -</option>
<option value="68" <?php if(isset($field_organization_value) && $field_organization_value=='68'){ echo 'selected'; } ?>>ErieQuest</option>
<option value="66" <?php if(isset($field_organization_value) && $field_organization_value=='66'){ echo 'selected'; } ?>>Niagara Divers Assn</option>
<option value="67" <?php if(isset($field_organization_value) && $field_organization_value=='67'){ echo 'selected'; } ?>>Preserve Our Wrecks</option>
<option value="246" <?php if(isset($field_organization_value) && $field_organization_value=='246'){ echo 'selected'; } ?>>SOS Barrie</option>
<option value="269" <?php if(isset($field_organization_value) && $field_organization_value=='269'){ echo 'selected'; } ?>>SOS Durham/Northumberland</option>
<option value="69" <?php if(isset($field_organization_value) && $field_organization_value=='69'){ echo 'selected'; } ?>>SOS Hamilton</option>
<option value="64" <?php if(isset($field_organization_value) && $field_organization_value=='64'){ echo 'selected'; } ?>>SOS Huron Shores</option>
<option value="72" <?php if(isset($field_organization_value) && $field_organization_value=='72'){ echo 'selected'; } ?>>SOS Manitoulin</option>
<option value="61" <?php if(isset($field_organization_value) && $field_organization_value=='61'){ echo 'selected'; } ?>>SOS Ottawa</option>
<option value="71"<?php if(isset($field_organization_value) && $field_organization_value=='71'){ echo 'selected'; } ?> >SOS Port Dover</option>
<option value="73" <?php if(isset($field_organization_value) && $field_organization_value=='73'){ echo 'selected'; } ?>>SOS Quebec</option>
<option value="267" <?php if(isset($field_organization_value) && $field_organization_value=='267'){ echo 'selected'; } ?>>SOS Superior</option>
<option value="62" <?php if(isset($field_organization_value) && $field_organization_value=='62'){ echo 'selected'; } ?>>SOS Thousand Islands</option>
<option value="63" <?php if(isset($field_organization_value) && $field_organization_value=='63'){ echo 'selected'; } ?>>SOS Toronto</option>
<option value="70" <?php if(isset($field_organization_value) && $field_organization_value=='70'){ echo 'selected'; } ?>>SOS Windsor</option>
</select>
</div>
<div class="container-inline-date date-clear-block"><div class="form-item" id="edit-field-record-date-0-value-wrapper">
 <label for="edit-field-record-date-0-value">Record Date: </label>
 <div class="date-month"><div class="form-item" id="edit-field-record-date-0-value-month-wrapper">
 <label for="edit-field-record-date-0-value-month">Month: </label><?php $mnth=date('m');  ?>
 <select name="field_record_date_month" class="form-select  date-month" id="edit-field-record-date-0-value-month" required>
     <option value="" selected="selected"></option>
     <option value="1" <?php if(isset($mrecord) && ($mrecord=='1' || $mnth=='1')){ echo  'selected'; }  ?>>Jan</option>

     <option value="2" <?php if(isset($mrecord) && ($mrecord=='2' || $mnth=='2')){ echo  'selected'; }  ?>>Feb</option>
     <option value="3" <?php if(isset($mrecord) && ($mrecord=='3' || $mnth=='3')){ echo  'selected'; }  ?>>Mar</option>
     <option value="4" <?php if(isset($mrecord) && ($mrecord=='4' || $mnth=='4')){ echo  'selected'; }  ?>>Apr</option>
     <option value="5" <?php if(isset($mrecord) && ($mrecord=='5' || $mnth=='5')){ echo  'selected'; }  ?>>May</option>
     <option value="6" <?php if(isset($mrecord) && ($mrecord=='6' || $mnth=='6')){ echo  'selected'; }  ?>>Jun</option>
     <option value="7" <?php if(isset($mrecord) && ($mrecord=='7' || $mnth=='7')){ echo  'selected'; }  ?>>Jul</option>
     <option value="8" <?php if(isset($mrecord) && ($mrecord=='8' || $mnth=='8')){ echo  'selected'; }  ?>>Aug</option>
     <option value="9" <?php if(isset($mrecord) && ($mrecord=='9' || $mnth=='9')){ echo  'selected'; }  ?>>Sep</option>
     <option value="10" <?php if(isset($mrecord) && ($mrecord=='10' || $mnth=='10')){ echo  'selected'; }  ?>>Oct</option>
     <option value="11" <?php if(isset($mrecord) && ($mrecord=='11' || $mnth=='11')){ echo  'selected'; }  ?>>Nov</option>
     <option value="12" <?php if(isset($mrecord) && ($mrecord=='12' || $mnth=='12')){ echo  'selected'; }  ?>>Dec</option>

 </select>
</div>
</div><div class="date-day"><div class="form-item" id="edit-field-¥\2record-date-0-value-day-wrapper">
 <label for="edit-field-record-date-0-value-day">Day: </label><?php  $dnth=date('d');  ?>
 <select name="field_record_date_day" class="form-select  date-day" id="edit-field-record-date-0-value-day"  required><option value="" selected="selected"></option>
     <option value="1" <?php if(isset($drecord) && ($drecord=='1' || $dnth=='1')){ echo  'selected'; }  ?>>1</option>
     <option value="2" <?php if(isset($drecord) && ($drecord=='2' || $dnth=='2')){ echo  'selected'; }  ?>>2</option>
     <option value="3" <?php if(isset($drecord) && ($drecord=='3' || $dnth=='3')){ echo  'selected'; }  ?>>3</option>
     <option value="4" <?php if(isset($drecord) && ($drecord=='4' || $dnth=='4')){ echo  'selected'; }  ?>>4</option>
     <option value="5" <?php if(isset($drecord) && ($drecord=='5' || $dnth=='5')){ echo  'selected'; }  ?>>5</option>
     <option value="6" <?php if(isset($drecord) && ($drecord=='6' || $dnth=='6')){ echo  'selected'; }  ?>>6</option>
     <option value="7" <?php if(isset($drecord) && ($drecord=='7' || $dnth=='7')){ echo  'selected'; }  ?>>7</option>
     <option value="8" <?php if(isset($drecord) && ($drecord=='8' || $dnth=='8')){ echo  'selected'; }  ?>>8</option>
     <option value="9" <?php if(isset($drecord) && ($drecord=='9' || $dnth=='9')){ echo  'selected'; }  ?>>9</option>
     <option value="10" <?php if(isset($drecord) && ($drecord=='10' || $dnth=='10')){ echo  'selected'; }  ?>>10</option>
     <option value="11" <?php if(isset($drecord) && ($drecord=='11' || $dnth=='11')){ echo  'selected'; }  ?>>11</option>
     <option value="12" <?php if(isset($drecord) && ($drecord=='12' || $dnth=='12')){ echo  'selected'; }  ?>>12</option>
     <option value="13" <?php if(isset($drecord) && ($drecord=='13' || $dnth=='13')){ echo  'selected'; }  ?>>13</option>
     <option value="14" <?php if(isset($drecord) && ($drecord=='14' || $dnth=='14')){ echo  'selected'; }  ?>>14</option>
     <option value="15" <?php if(isset($drecord) && ($drecord=='15' || $dnth=='15')){ echo  'selected'; }  ?>>15</option>
     <option value="16" <?php if(isset($drecord) && ($drecord=='16' || $dnth=='16')){ echo  'selected'; }  ?>>16</option>
     <option value="17" <?php if(isset($drecord) && ($drecord=='17' || $dnth=='17')){ echo  'selected'; }  ?>>17</option>
     <option value="18" <?php if(isset($drecord) && ($drecord=='18' || $dnth=='18')){ echo  'selected'; }  ?>>18</option>
     <option value="19" <?php if(isset($drecord) && ($drecord=='19' || $dnth=='19')){ echo  'selected'; }  ?>>19</option>
     <option value="20" <?php if(isset($drecord) && ($drecord=='20' || $dnth=='20')){ echo  'selected'; }  ?>>20</option>
     <option value="21" <?php if(isset($drecord) && ($drecord=='21' || $dnth=='21')){ echo  'selected'; }  ?>>21</option>
     <option value="22" <?php if(isset($drecord) && ($drecord=='22' || $dnth=='22')){ echo  'selected'; }  ?>>22</option>
     <option value="23" <?php if(isset($drecord) && ($drecord=='23' || $dnth=='23')){ echo  'selected'; }  ?>>23</option>
     <option value="24" <?php if(isset($drecord) && ($drecord=='24' || $dnth=='24')){ echo  'selected'; }  ?>>24</option>
     <option value="25" <?php if(isset($drecord) && ($drecord=='25' || $dnth=='25')){ echo  'selected'; }  ?>>25</option>
     <option value="26" <?php if(isset($drecord) && ($drecord=='26' || $dnth=='26')){ echo  'selected'; }  ?>>26</option>
     <option value="27" <?php if(isset($drecord) && ($drecord=='27' || $dnth=='27')){ echo  'selected'; }  ?>>27</option>
     <option value="28" <?php if(isset($drecord) && ($drecord=='28' || $dnth=='28')){ echo  'selected'; }  ?>>28</option>
     <option value="29" <?php if(isset($drecord) && ($drecord=='29' || $dnth=='29')){ echo  'selected'; }  ?>>29</option>
     <option value="30" <?php if(isset($drecord) && ($drecord=='30' || $dnth=='30')){ echo  'selected'; }  ?>>30</option>
     <option value="31" <?php if(isset($drecord) && ($drecord=='31' || $dnth=='31')){ echo  'selected'; }  ?>>31</option>
 </select>
</div>
</div><div class="date-year"><div class="form-item" id="edit-field-record-date-0-value-year-wrapper">
 <label for="edit-field-record-date-0-value-year">Year: </label><?php  $cyear=date('Y');  ?>
 <select name="field_record_date_year" class="form-select  date-year" id="edit-field-record-date-0-value-year"  required>
     <option value="" ></option>
    <option value="2002" <?php if(isset($yrecord) && ($yrecord=='2002' || $cyear=='2002')){ echo  'selected'; }  ?>>2002</option>
    <option value="2003" <?php if(isset($yrecord) && ($yrecord=='2003' || $cyear=='2003')){ echo  'selected'; }  ?>>2003</option>
    <option value="2004" <?php if(isset($yrecord) && ($yrecord=='2004' || $cyear=='2004')){ echo  'selected'; }  ?>>2004</option>
    <option value="2005" <?php if(isset($yrecord) && ($yrecord=='2005' || $cyear=='2005')){ echo  'selected'; }  ?>>2005</option>
    <option value="2006" <?php if(isset($yrecord) && ($yrecord=='2006' || $cyear=='2006')){ echo  'selected'; }  ?>>2006</option>
    <option value="2007" <?php if(isset($yrecord) && ($yrecord=='2007'  || $cyear=='2007')){ echo  'selected'; }  ?>>2007</option>
    <option value="2008" <?php if(isset($yrecord) && ($yrecord=='2008' || $cyear=='2008')){ echo  'selected'; }  ?>>2008</option>
     <option value="2009" <?php if(isset($yrecord) && ($yrecord=='2009' || $cyear=='2009')){ echo  'selected'; }  ?>>2009</option>
     <option value="2010" <?php if(isset($yrecord) && ($yrecord=='2010' || $cyear=='2010')){ echo  'selected'; }  ?>>2010</option>
     <option value="2011" <?php if(isset($yrecord) && ($yrecord=='2011' || $cyear=='2011')){ echo  'selected'; }  ?>>2011</option>
     <option value="2012" <?php if(isset($yrecord) && ($yrecord=='2012' || $cyear=='2012')){ echo  'selected'; }  ?>>2012</option>
     <option value="2013" <?php if(isset($yrecord) && ($yrecord=='2013' || $cyear=='2013')){ echo  'selected'; }  ?>>2013</option>
     <option value="2014" <?php if(isset($yrecord) && ($yrecord=='2014' || $cyear=='2014')){ echo  'selected'; }  ?>>2014</option>
     <option value="2015" <?php if(isset($yrecord) && ($yrecord=='2015' || $cyear=='2015')){ echo  'selected'; }  ?>>2015</option>
     <option value="2016" <?php if(isset($yrecord) && ($yrecord=='2016' || $cyear=='2016')){ echo  'selected'; }  ?>>2016</option>
     <option value="2017" <?php if(isset($yrecord) && ($yrecord=='2017' || $cyear=='2017')){ echo  'selected'; }  ?>>2017</option>
     <option value="2018" <?php if(isset($yrecord) && ($yrecord=='2018' || $cyear=='2018')){ echo  'selected'; }  ?>>2018</option>
 </select>
</div>
</div>
</div>
</div><div class="form-item" id="edit-field-official-number-0-value-wrapper">
 <label for="edit-field-official-number-0-value">Official Number: </label>
 <input name="field_official_number_value" id="edit-field-official-number-0-value" size="60" value="<?php echo $field_official_number_value;?>" class="form-text text" type="text" required>
</div>
<div class="form-item" id="edit-field-nation-0-value-wrapper">
 <label for="edit-field-nation-0-value">Nation: </label>
 <input name="field_nation_value" id="edit-field-nation-0-value" size="60" value="<?php echo $field_nation_value;?>" class="form-text text" type="text">
</div>
<div class="form-item" id="edit-field-built-year-0-value-wrapper">
 <label for="edit-field-built-year-0-value">Built Year: </label>
 <input name="field_built_year_value" id="edit-field-built-year-0-value" size="60" value="<?php echo $field_built_year_value;?>" class="form-text text" type="text">
</div>
<div class="form-item" id="edit-field-built-location-0-value-wrapper">
 <label for="edit-field-built-location-0-value">Built Location: </label>
 <input name="field_built_location_value" id="edit-field-built-location-0-value" size="60" value="<?php echo $field_built_location_value;?>" class="form-text text" type="text">
</div>
<div class="form-item" id="edit-field-built-by-0-value-wrapper">
 <label for="edit-field-built-by-0-value">Built By: </label>
 <input name="field_built_by_value" id="edit-field-built-by-0-value" size="60" value="<?php echo $field_built_by_value;?>" class="form-text text" type="text">
</div>
<div class="form-item" id="edit-field-wreck-type-0-value-wrapper">
 <label for="edit-field-wreck-type-0-value">Wreck Type: </label>
 <input name="field_wreck_type_value" id="edit-field-wreck-type-0-value" size="60" value="<?php echo $field_wreck_type_value;?>" class="form-text text" type="text">
</div>
<div class="form-item" id="edit-field-rig-0-value-wrapper">
 <label for="edit-field-rig-0-value">Rig: </label>
 <input name="field_rig_value" id="edit-field-rig-0-value" size="60" value="<?php echo $field_rig_value; ?>" class="form-text text" type="text">
</div>
<div class="form-item" id="edit-field-length-0-value-wrapper">
 <label for="edit-field-length-0-value">Length: </label>
 <input name="field_length_value" id="edit-field-length-0-value" size="60" value="<?php echo $field_length_value; ?>" class="form-text text" type="text">
</div>
<div class="form-item" id="edit-field-beam-0-value-wrapper">
 <label for="edit-field-beam-0-value">Beam: </label>
 <input name="field_beam_value" id="edit-field-beam-0-value" size="60" value="<?php echo $field_beam_value; ?>" class="form-text text" type="text">
</div>
<div class="form-item" id="edit-field-draft-0-value-wrapper">
 <label for="edit-field-draft-0-value">Draft: </label>
 <input name="field_draft_value" id="edit-field-draft-0-value" size="60" value="<?php echo $field_draft_value; ?>" class="form-text text" type="text">
</div>
<div class="form-item" id="edit-field-tonnage-0-value-wrapper">
 <label for="edit-field-tonnage-0-value">Tonnage: </label>
 <input name="field_tonnage_value" id="edit-field-tonnage-0-value" size="60" value="<?php echo $field_tonnage_value; ?>" class="form-text text" type="text">
</div>
<div class="form-item" id="edit-field-buoy-description-0-value-wrapper">
 <label for="edit-field-buoy-description-0-value">Description: </label>
 <div class="resizable-textarea"><span>
     <textarea cols="60" rows="5" name="field_buoy_description_value" id="edit-field-buoy-description-0-value" class="form-textarea resizable textarea-processed"><?php echo $field_buoy_description_value; ?></textarea><div class="grippie" style="margin-right: -6px;"></div></span></div>
</div>
<div class="form-item" id="edit-field-sank-year-0-value-wrapper">
 <label for="edit-field-sank-year-0-value">Sank Year: </label>
 <input name="field_sank_year_value" id="edit-field-sank-year-0-value" size="60" value="<?php echo $field_tonnage_value; ?>" class="form-text text" type="text">
</div>
<div class="form-item" id="edit-field-buoy-material-value-wrapper">
 <label for="edit-field-buoy-material-value">Hull Material: </label>
 <select name="field_buoy_material_value" class="form-select" id="edit-field-buoy-material-value">
     <option value="">- None -</option>
     <option value="35" <?php if($field_buoy_material_value=='35'){ echo 'selected'; } ?>>Aluminum</option>
     <option value="36" <?php if($field_buoy_material_value=='36'){ echo 'selected'; } ?>>Fiberglass</option>
     <option value="37" <?php if($field_buoy_material_value=='37'){ echo 'selected'; } ?>>Metal clad Wood</option>
     <option value="38" <?php if($field_buoy_material_value=='38'){ echo 'selected'; } ?>>Other</option>
     <option value="39" <?php if($field_buoy_material_value=='39'){ echo 'selected'; } ?>>Steel</option>
     <option value="40" <?php if($field_buoy_material_value=='40'){ echo 'selected'; } ?>>Wood</option>
 </select>
</div>
<div class="form-item" id="edit-field-bodywater-0-value-wrapper">
 <label for="edit-field-bodywater-0-value">Body of Water: </label>
 <input name="field_bodywater_value" id="edit-field-bodywater-0-value" size="60" value="<?php echo $field_bodywater_value; ?>" class="form-text text" type="text">
</div>
<div class="form-item" id="edit-field-bodywater-0-value-wrapper">
 <label for="gmap-auto1map-locpick_latitude0">Latitude: </label>
 <input maxlength="20" name="field_latitude_value" id="gmap-auto1map-locpick_latitude0" size="16" value="<?php echo $field_latitude_value; ?>" class="form-text container-inline gmap-control gmap-locpick_latitude gmap-processed" type="text">
</div><div class="form-item" id="gmap-auto1map-locpick_longitude0-wrapper">
 <label for="gmap-auto1map-locpick_longitude0">Longitude: </label>
 <input maxlength="20" name="field_longitude_value" id="gmap-auto1map-locpick_longitude0" size="16" value="<?php echo $field_longitude_value; ?>" class="form-text gmap-control gmap-locpick_longitude gmap-processed" type="text">
</div>


</fieldset>
<div class="form-item" id="edit-field-depth-min-0-value-wrapper">
 <label for="edit-field-depth-min-0-value">Depth min: </label>
 <input name="field_depth_min_value" id="edit-field-depth-min-0-value" size="60" value="<?php echo $field_depth_min_value; ?>" class="form-text text" type="text">
</div>
<div class="form-item" id="edit-field-depth-max-0-value-wrapper">
 <label for="edit-field-depth-max-0-value">Depth max: </label>
 <input name="field_depth_max_value" id="edit-field-depth-max-0-value" size="60" value="<?php echo $field_depth_max_value; ?>" class="form-text text" type="text">
</div>
<div class="form-item" id="edit-field-current-value-wrapper">
 <label for="edit-field-current-value">Current: </label>
 <select name="field_current_value" class="form-select" id="edit-field-current-value">
     <option value="" >- None -</option>
     <option value="29"  <?php if($field_current_value=='29'){ echo 'selected'; } ?>>0.5-1 Knot</option>
     <option value="30"  <?php if($field_current_value=='30'){ echo 'selected'; } ?> >1-2 Knots</option>
     <option value="31"  <?php if($field_current_value=='31'){ echo 'selected'; } ?>>2-3 Knots</option>
     <option value="32"  <?php if($field_current_value=='32'){ echo 'selected'; } ?>>3-4 Knots</option>
     <option value="33"  <?php if($field_current_value=='33'){ echo 'selected'; } ?>>&gt;4 Knots</option>
     <option value="34"  <?php if($field_current_value=='34'){ echo 'selected'; } ?>>No Current</option>

 </select>
</div>
<div class="form-item" id="edit-field-buoy-type-value-wrapper">
 <label for="edit-field-buoy-type-value">Buoy Type: </label>
 <select name="field_buoy_type_value" class="form-select" id="edit-field-buoy-type-value">
     <option value="" >- None -</option>
     <option value="2"  <?php if($field_buoy_type_value=='2'){ echo 'selected'; } ?>>Cone - Plastic</option>
     <option value="3" <?php if($field_buoy_type_value=='3'){ echo 'selected'; } ?>>Conical</option>
     <option value="4" <?php if($field_buoy_type_value=='4'){ echo 'selected'; } ?>>Conical w/Lite</option>
     <option value="5" <?php if($field_buoy_type_value=='5'){ echo 'selected'; } ?>>Drum-lg</option>
     <option value="6" <?php if($field_buoy_type_value=='6'){ echo 'selected'; } ?>>Drum-sm</option>
     <option value="7" <?php if($field_buoy_type_value=='7'){ echo 'selected'; } ?>>Jug-lg</option>
     <option value="8" <?php if($field_buoy_type_value=='8'){ echo 'selected'; } ?>>Jug-sm</option>
     <option value="9" <?php if($field_buoy_type_value=='9'){ echo 'selected'; } ?>>Other</option>
     <option value="10" <?php if($field_buoy_type_value=='10'){ echo 'selected'; } ?>>Spar</option>
     <option value="11" <?php if($field_buoy_type_value=='11'){ echo 'selected'; } ?>>Spar - Plastic</option>
     <option value="12" <?php if($field_buoy_type_value=='12'){ echo 'selected'; } ?>>Spar Ice</option></select>
</div>
<div class="form-item" id="edit-field-line-type-value-wrapper">
 <label for="edit-field-line-type-value">Line Type: </label>
 <select name="field_line_type_value" class="form-select" id="edit-field-line-type-value">
     <option value="" selected="selected">- None -</option>
     <option value="50" <?php if($field_line_type_value=='50'){ echo 'selected'; } ?>>Cable - coated</option>
     <option value="51" <?php if($field_line_type_value=='51'){ echo 'selected'; } ?>>Cable - Uncoat</option>
     <option value="52" <?php if($field_line_type_value=='52'){ echo 'selected'; } ?>>Chain - Galv</option>
     <option value="53" <?php if($field_line_type_value=='53'){ echo 'selected'; } ?>>Chain - nonGalv</option>
     <option value="54" <?php if($field_line_type_value=='54'){ echo 'selected'; } ?>>Chain - SS</option>
     <option value="55" <?php if($field_line_type_value=='55'){ echo 'selected'; } ?>>Nylon - braid</option>
     <option value="56" <?php if($field_line_type_value=='56'){ echo 'selected'; } ?>>Nylon - twist</option>
     <option value="57" <?php if($field_line_type_value=='57'){ echo 'selected'; } ?>>Polyest - braid</option>
     <option value="58" <?php if($field_line_type_value=='58'){ echo 'selected'; } ?>>Polyest - twist</option>
     <option value="59" <?php if($field_line_type_value=='59'){ echo 'selected'; } ?>>Polypro - braid</option>
     <option value="60" <?php if($field_line_type_value=='60'){ echo 'selected'; } ?>>Polypro - twist</option>
 </select>
</div>
<div class="form-item" id="edit-field-line-size-value-wrapper">
 <label for="edit-field-line-size-value">Line Size: </label>
 <select name="field_line_size_value" class="form-select" id="edit-field-line-size-value">
     <option value="" >- None -</option>
     <option value="46" <?php if($field_line_size_value=='46'){ echo 'selected'; } ?>>1"</option>
     <option value="48" <?php if($field_line_size_value=='48'){ echo 'selected'; } ?>>1-1/4"</option>
     <option value="47" <?php if($field_line_size_value=='47'){ echo 'selected'; } ?>>1-1/8"</option>
     <option value="43" <?php if($field_line_size_value=='43'){ echo 'selected'; } ?>>1/2"</option>
     <option value="41" <?php if($field_line_size_value=='41'){ echo 'selected'; } ?>>1/4"</option>
     <option value="45" <?php if($field_line_size_value=='45'){ echo 'selected'; } ?>>3/4"</option>
     <option value="42" <?php if($field_line_size_value=='42'){ echo 'selected'; } ?>>3/8"</option>
     <option value="44" <?php if($field_line_size_value=='44'){ echo 'selected'; } ?>>5/8"</option>
     <option value="49" <?php if($field_line_size_value=='49'){ echo 'selected'; } ?>>7/8"</option>
 </select>
</div>
<div class="form-item" id="edit-field-line-length-0-value-wrapper">
 <label for="edit-field-line-length-0-value">Line Length: </label>
 <input name="field_line_length_value" id="edit-field-line-length-0-value" size="60" value="<?php echo $field_line_length_value; ?>" class="form-text text" type="text">
</div>
<div class="form-item" id="edit-field-anchor-type-value-wrapper">
 <label for="edit-field-anchor-type-value">Buoy Anchor Type: </label>
 <select name="field_anchor_type_value" class="form-select" id="edit-field-anchor-type-value">
     <option value="">- None -</option>
     <option value="13"  <?php if($field_anchor_type_value=='13'){ echo 'selected'; } ?>>Cage &amp; Rock</option>
     <option value="14" <?php if($field_anchor_type_value=='14'){ echo 'selected'; } ?>>Cement - Large</option>
     <option value="15" <?php if($field_anchor_type_value=='15'){ echo 'selected'; } ?>>Cement - Small</option>
     <option value="16" <?php if($field_anchor_type_value=='16'){ echo 'selected'; } ?>>Iron Weight</option>
     <option value="17" <?php if($field_anchor_type_value=='17'){ echo 'selected'; } ?>>Rod Screws</option>
     <option value="18" <?php if($field_anchor_type_value=='18'){ echo 'selected'; } ?>>Wreck / Site</option>
 </select>
</div>
<div class="form-item" id="edit-field-anchor-weight-0-value-wrapper">
 <label for="edit-field-anchor-weight-0-value">Buoy Anchor Weight: </label>
 <input name="field_anchor_weight_value" id="edit-field-anchor-weight-0-value" size="60" value="<?php echo $field_anchor_weight_value; ?>" class="form-text text" type="text">
</div>
<div class="form-item">
 <label>SOS Plaque: </label>
 <div class="form-radios"><div class="form-item" id="edit-field-plaque-value--wrapper">
 <label class="option" for="edit-field-plaque-value-">
     <input id="edit-field-plaque-value-" name="field_plaque_value" value="" checked="checked" class="form-radio" type="radio"> N/A</label>
</div>
<div class="form-item" id="edit-field-plaque-value-Yes-wrapper">
 <label class="option" for="edit-field-plaque-value-Yes">
     <input id="edit-field-plaque-value-Yes" name="field_plaque_value" value="Yes" class="form-radio" type="radio"> Yes</label>
</div>
<div class="form-item" id="edit-field-plaque-value-No-wrapper">
 <label class="option" for="edit-field-plaque-value-No">
     <input id="edit-field-plaque-value-No" name="field_plaque_value" value="No" class="form-radio" type="radio"> No</label>
</div>
</div>
</div>
<div class="form-item" id="edit-field-buoy-notess-0-value-wrapper">
 <label for="edit-field-buoy-notess-0-value">Notes: </label>
 <div class="resizable-textarea"><span>
     <textarea cols="60" rows="3" name="field_buoy_notess_value" id="edit-field-buoy-notess-0-value" class="form-textarea resizable textarea-processed"><?php echo $field_buoy_notess_value; ?></textarea>
     <div class="grippie" style="margin-right: -6px;"></div></span></div>
</div>
<div class="attachments"><fieldset class=" collapsible collapsed"><legend class="collapse-processed"><a href="#">File attachments</a></legend><div class="fieldset-wrapper"><div class="description">Changes made to the attachments are not permanent until you save this post. The first "listed" file will be included in RSS feeds.</div><div id="attach-wrapper"><div class="form-item" id="edit-upload-wrapper">
 <label for="edit-upload">Attach new file: </label>
 <input name="files[upload]" class="form-file" id="edit-upload" size="40" type="file">

 <div class="description">The maximum upload size is <em>20 MB</em>. Only files with the following extensions may be uploaded: <em>jpg jpeg gif png txt doc xls pdf ppt pps odt ods odp</em>. </div>
</div>
<input name="attach" id="edit-attach" value="Attach" class="form-submit ahah-processed" type="submit">
</div></div></fieldset>
</div>  </div>
  <div class="admin">
    <div class="authored">
    </div>
    <div class="options">
<fieldset class=" collapsible collapsed"><legend class="collapse-processed"><a href="#">Publishing options</a></legend><div class="fieldset-wrapper"></div></fieldset>
    </div>
  </div>
<input name="submit" id="edit-submit" value="Add" class="form-submit" type="submit">
</div>

</div></form>
<?php else : ?>
    <h1>You are not allowed to add Buoy Site</h1>
<?php endif; ?>
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
