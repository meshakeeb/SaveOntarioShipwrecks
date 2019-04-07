<?php global $shortname; ?>

<?php 
/* Template Name: Add User */
get_header();
global $wpdb;


?>


<?php   $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//die();
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
   // $expire = date("Y-m-d H:i:s", strtotime("1 year"));
    //die();
 echo $query = "SELECT * FROM users order by uid asc";

  //echo $qry = "SELECT * FROM content_type_buoystatusorder by uid asc order by uid asc limit 80, 50";
  $result = mysqli_query($mysqli,$query);

  while ($row = mysqli_fetch_array($result)) {

   // echo '<pre>'; print_r($row); echo '</pre>';

        $username= $row['name'];
      //  $email = $row['mail'];
     $email = $row['mail'];
        $status = $row['status'];
        $picture = $row['picture'];
        $data = $row['data'];

       $qry_stt = "SELECT * FROM users_roles where uid='".$row['uid']."'";
        $rqry_stt= mysqli_query($mysqli,$qry_stt);
        $rqry_stts= mysqli_fetch_assoc($rqry_stt);
     $rollid=$rqry_stts['rid'];

        $qry_rname = "SELECT * FROM role where rid='".$rollid."'";
        $rqry_rname= mysqli_query($mysqli,$qry_rname);
        $rqry_rnames= mysqli_fetch_assoc($rqry_rname);
       $rollname=$rqry_rnames['name'];

       $qry_member = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='16'";
        $qry_members= mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $chapter=$qry_memberss['value'];

       $qry_member = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='2'";
        $qry_members= mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $first_name=$qry_memberss['value'];

       $qry_member = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='4'";
        $qry_members= mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $last_name=$qry_memberss['value'];

     $qry_member = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='6'";
        $qry_members= mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $address=$qry_memberss['value'];

        $qry_member = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='7'";
        $qry_members= mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $city=$qry_memberss['value'];

       $qry_member = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='10'";
        $qry_members= mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $zipcode=$qry_memberss['value'];

      $qry_member = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='11'";
        $qry_members= mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $phone1=$qry_memberss['value'];

        $qry_member = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='12'";
        $qry_members= mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $phone2=$qry_memberss['value'];

    $qry_member = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='47'";
        $qry_members= mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $agree=$qry_memberss['value'];

       $qry_member = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='35'";
        $qry_members= mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $membership_type=$qry_memberss['value'];

     $qry_member = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='33'";
        $qry_members= mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $fullname=$qry_memberss['value'];

       $qry_member = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='20'";
        $qry_members= mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $specialskill=$qry_memberss['value'];

     $qry_member = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='26'";
        $qry_members= mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $oucinsurance=$qry_memberss['value'];

    $qry_member = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='27'";
        $qry_members= mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $oucmembershipnumber=$qry_memberss['value'];

        $qry_member = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='53'";
        $qry_members= mysqli_query($mysqli,$qry_member);
        $qry_memberss = mysqli_fetch_assoc($qry_members);
        $oucexpiredate=$qry_memberss['value'];

     $qry_member  = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='57'";
        $qry_members = mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $nastraining =$qry_memberss['value'];


      $qry_member  = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='59'";
        $qry_members = mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $newsletter =$qry_memberss['value'];

    $qry_member  = "SELECT * FROM profile_values where uid='".$row['uid']."' and fid='5'";
        $qry_members = mysqli_query($mysqli,$qry_member);
        $qry_memberss= mysqli_fetch_assoc($qry_members);
        $profile_institution =$qry_memberss['value'];

        $num = rand(100, 999);
          $password = 's'.$num;
if($email!='' && $username!=''){

$exists = email_exists( $email );
if ( ! $exists ) {
        $uidss=wp_create_user($username, $password, $email );
global $wpdb;
$wpdb->query('UPDATE ' . $wpdb->prefix . 'users SET user_status ='.$status.' WHERE ID = '.$uidss);
      if($rollname=='Member' || $rollname==''){
        $roles1='bolt_chapter_member';
      }
if($rollname=='Chapter Editor'){  $roles1='bolt_chapter_editor';}
if($rollname=='Board'){  $roles1='board';}
if($rollname=='Buoy Editors'){  $roles1='buoy_editors';}
if($rollname=='Bouy Site Administrator'){  $roles1='buoy_site_administrator';}
if($rollname=='EQ Buoy Editor'){  $roles1='eq_buoy_editor';}
if($rollname=='Family Main'){  $roles1='family_main';}
if($rollname=='Family Member'){  $roles1='family_member';}
if($rollname=='Hamilton'){  $roles1='hamilton';}
if($rollname=='NDA Buoy Editor'){  $roles1='nda_buoy_editor';}
if($rollname=='Newsletter Editor'){  $roles1='newsletter_editor';}
if($rollname=='Family Main'){  $roles1='family_main';}
if($rollname=='Family Member'){  $roles1='family_member';}
if($rollname=='OUC'){  $roles1='ouc';}
if($rollname=='Provincial Membership'){  $roles1='provincial_membership';}
if($rollname=='Provincial'){  $roles1='provincial';}
if($rollname=='POW Buoy Editor'){  $roles1='pow';}
        wp_update_user( array ('ID' => $uidss, 'role' =>$roles1) ) ;

        $subject = 'New Password : Save Ontario Shipwrecks';

     $user_info = get_userdata($uidss);
     $user_name = $user_info->user_login;
       // $message = "A New password is generated, Password is: $password \n\n";
       // $message .= "Username: $user_name\n\n";
       // $message .= $post->post_title . ": " . $post_url;


    $message = "Hello $user_name, \n\n";
        $message .= "We have launched a brand new Save Ontario Shipwrecks website at http://saveontarioshipwrecks.ca/ \n\n";
         $message .= "For your security, please login to the site using the link below and update your password. Once you login, you may edit any additional information associated with your account. \n\n";
        $message .= "Link: https://saveontarioshipwrecks.ca/password-reset/ \n\n";
        $message .= "If your membership is expiring soon, you will receiving an additional email notification to help you renew your account. \n\n";
        $message .= "Thank you! \n\n";
        $message .= "Save Ontario Shipwrecks \n\n";

         $headers = 'From: Save Ontario Shipwrecks  <wordpress@saveontarioshipwrecks.ca>' . "\r\n";
         echo $message;
        // Send email to admin.
        //wp_mail( 'chauhanjayesh142@gmail.com', $subject, $message, $headers );
        wp_mail( $email, $subject, $message, $headers );
        //mail( 'chauhanjayesh142@gmail.com', $subject, $message, $headers );
//$mailResult = false;
        // $mailResult=wp_mail( 'chauhanjayesh142@gmail.com', $subject, $message, $headers );
    //  echo $mailResult;
//wp_mail( 'dan@boltmedia.ca', $subject, $message, $headers );

                                        if($chapter=='Windsor'){ $chapter='500'; }
                    if($chapter=='Toronto'){ $chapter='499'; }
                    if($chapter=='Thousand Islands'){ $chapter='498'; }
                    if($chapter=='Superior'){ $chapter='497'; }
                    if($chapter=='Ottawa'){ $chapter='495'; }
                    if($chapter=='Manitoulin'){ $chapter='494'; }
                    if($chapter=='Huron Shores'){ $chapter='493'; }
                    if($chapter=='Hamilton'){ $chapter='492'; }
                    if($chapter=='Barrie'){ $chapter='491'; }
                    if($chapter=='Durham/Northumberland'){ $chapter='3989'; }

         $qry_member = "SELECT * FROM ms_memberships where uid='".$row['uid']."'";
        $qry_members= mysqli_query($mysqli,$qry_member);


  while ($rowss = mysqli_fetch_array($qry_members)) {
        $expiration=date('Y-m-d H:i:s',$rowss['expiration']);
        $start_date=date('Y-m-d H:i:s',$rowss['start_date']);
        $mpid=$rowss['mpid'];
        $sstatus=$rowss['status'];

        $qry_member_detail = "SELECT * FROM ms_membership_plans where mpid='".$mpid."'";
        $qry_member_details= mysqli_query($mysqli,$qry_member_detail);
        $qry_member_detailss= mysqli_fetch_assoc($qry_member_details);
        $mname=$qry_member_detailss['name'];
        $main_amount=$qry_member_detailss['main_amount'];

        if($mname=='Individual - 1 Year'){  $subid='119'; }
        if($mname=='Individual - 2 Years'){  $subid='121'; }
        if($mname=='Individual - 5 Years'){  $subid='122'; }
        if($mname=='Family - 1 Year'){  $subid='149'; }
        if($mname=='Family - 2 Years'){  $subid='153'; }
        if($mname=='Family - 5 Years'){  $subid='154'; }
        if($mname=='Institution / Club - 1 Year'){  $subid='155'; }
        if($mname=='Institution / Club - 2 Years'){  $subid='156'; }
        if($mname=='Institution / Club - 5 Years'){  $subid='157'; }
        if($mname=='Corporate'){  $subid='158'; }
        if($subid==''){  $subid='159'; }
        if($sstatus=='3'){ $st='Completed'; }
        else if($sstatus=='1'){ $st='Active - Recurring'; }
        else if($sstatus=='2'){ $st='Cancelled'; }
        else if($sstatus=='4'){ $st='Expiring Soon'; }
        else{ $st='Inactive'; }
        $insert = "INSERT INTO `{$wpdb->prefix}pms_payments`
  ( `user_id`, `subscription_plan_id`, `status`, `date`, `amount`, `payment_gateway`, `currency`, `type`, `transaction_id`, `profile_id`, `logs`, `ip_address`, `discount_code`)
  VALUES ( '".$uidss."', '".$subid."', '".$st."', '".$start_date."', '".$main_amount."', 'paypal', '', 'manual_payment', '', '', '', '', '');";
        mysqli_query($mysqli,$insert);
        $lastpid=mysqli_insert_id($con);
  }    echo $qry_member11 = "SELECT * FROM ms_memberships where uid='".$row['uid']."' order by mid desc limit 1";
$qry_membersww= mysqli_query($mysqli,$qry_member11);
        $qry_memberss1= mysqli_fetch_assoc($qry_membersww);
        echo  $qry_memberss1['expiration']; echo $qry_memberss1[start_date];
        $expiration1=date('Y-m-d H:i:s',$qry_memberss1['expiration']);
        $start_date1=date('Y-m-d H:i:s',$qry_memberss1['start_date']);

        $mpid1=$qry_memberss1['mpid'];
        $sstatus1=$qry_memberss1['status'];

        echo $qry_member_detail = "SELECT * FROM ms_membership_plans where mpid='".$mpid1."'";
        $qry_member_details= mysqli_query($mysqli,$qry_member_detail);
        $qry_member_detailss= mysqli_fetch_assoc($qry_member_details);
        $mname1=$qry_member_detailss['name'];
        $main_amount1=$qry_member_detailss['main_amount'];

        if($mname1=='Individual - 1 Year'){  $subid1='119'; }
        if($mname1=='Individual - 2 Years'){  $subid1='121'; }
        if($mname1=='Individual - 5 Year'){  $subid1='122'; }
        if($mname1=='Family - 1 Year'){  $subid1='149'; }
        if($mname1=='Family - 2 Year'){  $subid1='153'; }
        if($mname1=='Family - 5 Year'){  $subid1='154'; }
        if($mname1=='Institution / Club - 1 Year'){  $subid1='155'; }
        if($mname1=='Institution / Club - 2 Year'){  $subid1='156'; }
        if($mname1=='Institution / Club - 5 Year'){  $subid1='157'; }
        if($mname1=='Corporate'){  $subid1='158'; }
        if($subid==''){  $subid='159'; }

        add_user_meta($uidss,'chapter',$chapter);
        add_user_meta($uidss,'billing_first_name',$first_name);
        add_user_meta($uidss,'billing_last_name',$last_name);
        add_user_meta($uidss,'billing_address_1',$address);
        add_user_meta($uidss,'billing_city',$city);
        add_user_meta($uidss,'billing_postcode',$zipcode);
        add_user_meta($uidss,'agree',$agree);


if (strpos($phone1,'-') !== false) {
  $phone1=$phone1;
}else{
  $phone1= preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $phone1);
}
        add_user_meta($uidss,'billing_phone',$phone1);
        add_user_meta($uidss,'phone2',$phone2);
        add_user_meta($uidss,'agree',$agree);
        add_user_meta($uidss,'membership_type',$membership_type);
        add_user_meta($uidss,'fullname',$fullname);
        add_user_meta($uidss,'specialskill',$specialskill);
        add_user_meta($uidss,'oucinsurance',$oucinsurance);
        add_user_meta($uidss,'oucmembershipnumber',$oucmembershipnumber);
        add_user_meta($uidss,'oucexpiredate',$oucexpiredate);
        add_user_meta($uidss,'nastraining',$nastraining);
        add_user_meta($uidss,'newsletter',$newsletter);
        add_user_meta($uidss,'passwords',$password);
        add_user_meta($uidss,'profile_institution',$profile_institution);
if($sstatus=='3'){ $st='active'; }
        else if($sstatus1=='1'){ $st1='Active - Recurring'; }
        else if($sstatus1=='2'){ $st1='Cancelled'; }
        else if($sstatus1=='4'){ $st1='active'; }
        else{ $st1='pending'; }
       $inset = "insert into {$wpdb->prefix}pms_member_subscriptions (`user_id`, `subscription_plan_id`, `start_date`, `expiration_date`, `status`, `payment_profile_id`, `payment_gateway`, `billing_amount`, `billing_duration`, `billing_duration_unit`, `billing_cycles`, `billing_next_payment`, `billing_last_payment`, `trial_end`, `parent`)
        VALUES ( '".$uidss."','".$subid."', '".$start_date1."', '".$expiration1."', '".$st."', '', '".$lastpid."', '0', '0', '', '0', NULL, NULL, NULL, '0')";
        mysqli_query($mysqli,$inset);
} }
  }

?>

<?php get_footer(); ?>
