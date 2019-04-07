<?php global $shortname; ?>

<?php
/* Template Name:  Trash Buoy status*/
get_header(); 
global $wpdb;
$postid=$_GET['id'];
$post = get_post($postid); //echo '<pre>'; print_r($post); echo '<pre>';

            
/*

$args1 = array(
       'role' => array('chapter_editor','manitoulin'),
       'orderby' => 'user_nicename',
       'order' => 'ASC'
      ); $subscribers = get_users($args1); echo '<pre>'; print_r($subscribers); echo '</pre>';
       $display_name=array(); $user_email=array();
      foreach ($subscribers as $user) {
        $display_name[]=$user->display_name;
        $user_email[]=$user->user_email;
      } print_r($display_name); //print_r($user_email);  echo $display_name[0]; echo $user_email[0]; */
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
} $bolt_user = wp_get_current_user();  $current_user = wp_get_current_user();
if($postid!=''){
 if ( in_array( 'buoy_editors', (array) $current_user->roles ) || in_array( 'buoy_site_administrator', (array) $current_user->roles ) || in_array( 'administrator', (array) $current_user->roles ) || in_array( 'bolt_chapter_editor', (array) $current_user->roles )) { 
  wp_trash_post( $postid );
                //print_r($_POST);
        ?><div class="page_header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="text-capitalize">Buoy Status Removed</h1>
				</div>
		
				<div class="col-sm-6">
					<div class="bcrumbs">
						<div class="container">
							<ul>
								<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
								<li><span>Buoy Status</span></li>
							</ul>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>
		<?php
}  }
?>

	

<?php get_footer(); ?>