<?php 
/* Template Name: My Member
*/
global $shortname; global $wpdb;
  
    $user_id = get_current_user_id();
   
?>

<?php get_header(); ?>

<?php //if (have_posts()) : ?>
<?php //while (have_posts()) : the_post(); ?>

	
	<div class="container">
		<div class="container-fluid">
			<div class="row">
			<div class="col-sm-12">
					<h4>My Member</h4>
			</div>
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