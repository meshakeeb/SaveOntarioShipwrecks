<?php 
/* Template Name: send request mail
*/
global $wpdb;
global $shortname;
  if($_POST["email"]){ 
     $user_id = get_current_user_id();
    $key = 'mycode';
  $single = true;
  $user_code = get_user_meta( $user_id, $key, $single ); 
   //echo $code=the_field('mycode','user_'.$user_id);
    $contact_errors = false;

    // get the posted data
    $name = $_POST["name"];
    $email_address = $_POST["email"];

    // write the email content
 	$headers = 'From: Save Ontario Shipwrecks <wordpress@dev.boltmedia.ca>' . "\r\n";
    $message = "Please Use this Code for signup in family plan<br>";
   
    $message .= "Code : $user_code<br>";
    $message .= site_url().'signup-member/';
    $subject = "Use This code For registration";

    $to = $email_address;

    // send the email using wp_mail()
    wp_mail($to, $subject, $message, $headers);
      $msg='Sucesfully sent request to family member';
  }
?>

<?php get_header(); ?>

<?php //if (have_posts()) : ?>
<?php //while (have_posts()) : the_post(); ?>

	<div class="page_header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1><?php the_title(); ?></h1>
				</div>
		
				<div class="col-sm-6">
					<div class="bcrumbs">
						<div class="container">
			                 <ul>
				                <li><a href="<?php bloginfo('url'); ?>">Home</a></li>
				                <li><span><?php the_title(); ?></span></li>
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
                	<br><br>
					<h3>Send email to family member for registration</h3><br>
					<h5 style="color:green;"><?php if($msg!=''){ echo $msg;} ?></h5><br>
					<form action="" method="post">
                                            <input type="email" name="email" value="">
                                           <button class="btn btn-submit"> Send</button>
                                       </form>
				
			</div>
			
            
		<?php get_sidebar(); ?>
            
        </div>
    </div>
			

<?php include( get_template_directory() . '/widgets/cta.php'); ?>
<?php get_footer(); ?>