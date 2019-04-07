<?php
/* Template Name: User signup member
*/
global $shortname; global $wpdb;
  if($_POST["code"]){
	$user_id = get_current_user_id();
	$code = $_POST['code'];
	$email= $_POST['email'];
   $password= $_POST['password'];
   $firstname= $_POST['firstname'];
   $lastname= $_POST['lastname'];
   $meta_key = 'mycode';
   $codeuserid = $wpdb->get_row("SELECT user_id FROM {$wpdb->prefix}usermeta  WHERE meta_key = 'mycode' and meta_value='".$code."'");
   $mainuserid= $codeuserid->user_id;


   /* get subscription plan */


  $subplanid= $wpdb->get_row("SELECT subscription_plan_id FROM {$wpdb->prefix}pms_member_subscriptions  WHERE user_id ='".$mainuserid."'");
  $substart_date= $wpdb->get_row("SELECT start_date  FROM {$wpdb->prefix}pms_member_subscriptions  WHERE user_id ='".$mainuserid."'");
  $subexpiration_date = $wpdb->get_row("SELECT expiration_date  FROM {$wpdb->prefix}pms_member_subscriptions  WHERE user_id ='".$mainuserid."'");
  $substatus = $wpdb->get_row("SELECT status  FROM {$wpdb->prefix}pms_member_subscriptions  WHERE user_id ='".$mainuserid."'");

  /* create user */
  $userdata = array(
	'user_login'  =>  $_POST['username'],
	'user_email'  =>  $email,
	'user_pass'   =>  $_POST['password'],
	'first_name'   =>  $_POST['firstname'],
	'last_name'   =>  $_POST['lastname'], // When creating an user, `user_pass` is expected.
 );

 $user_idnew = wp_insert_user( $userdata ) ;

/* insert into plan detail */

global $wpdb;
$wpdb->insert( {$wpdb->prefix} . 'pms_member_subscriptions', array('subscription_plan_id'=>$subplanid->subscription_plan_id,'start_date'=>$substart_date->start_date,'expiration_date'=>$subexpiration_date->expiration_date,'status'=>$substatus->status,'user_id'=>$user_idnew,'parent'=>$mainuserid),array('%s','%s','%s','%s','%s','%s'));
  }
?>

<?php get_header(); ?>

<?php //if (have_posts()) : ?>
<?php //while (have_posts()) : the_post(); ?>


	<div class="services">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-8">
					<a href="#">
						<div class="item">
							<div class="ico">
								<img src="<?php bloginfo('template_url'); ?>/images/icon-join.png" alt=""/>
							</div>
							<h4>
							  Sign Up
														</h4>
						</div>
					</a>
				</div>


			</div>
		</div>
	</div>

	<div class="">
		<div class="container">
			<div class="col-sm-12">
					<h4>SIgn Up</h4>
					<form action="" method="post" id="pms_register-form" class="pms-form">
											<input type="text" name="username" value="" placeholder="User Name"><br>
											<input type="email" name="email" value="" placeholder="Email"><br>
											<input type="password" name="password" value="" placeholder="Password"><br>
											<input type="text" name="code" value="" placeholder="Code"><br>
											<input type="text" name="firstname" value="" placeholder="First Name"><br>
											<input type="text" name="lastname" value="" placeholder="Last Name"><br>
										   <button class="btn btn-submit"> Save</button>
									   </form>

			</div>

		</div>
	</div>

<?php //include('widgets/news.php'); ?>

	<div class="container">
		<div class="cta">
			<p>Save Ontario Shipwrecks gratefully acknowledge the Ministry of Tourism, Culture and Sport, Culture Programs Unit and our many sponsors for their support. We also gratefully acknowledge the financial support of the Ontario Trillium Foundation, an agency of the Ministry of Culture.</p>
			<img src="<?php bloginfo('template_url'); ?>/images/logos.jpg" alt=""/>
		</div>
	</div>

<?php //endwhile; ?>
<?php //endif; ?>

<?php get_footer(); ?>
