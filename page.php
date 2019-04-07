<?php 
global $shortname; 
$current_user = wp_get_current_user();
acf_form_head();
get_header(); 
if (have_posts()) : 
    while (have_posts()) : the_post(); ?>

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
	
    <?php 
        if( isset( $_GET['page-id'] ) && !empty( $_GET['page-id'] ) && !isset( $_GET['updated'] ) && empty( $_GET['updated']  ) && in_array( 'administrator', (array) $current_user->roles ) ):
            echo '<div class="container">';
                acf_form(array(
                    'post_id'	   => $_GET['page-id'], //Variable that you'll get from the URL
                    'post_title'   => true,
                    'post_content' => true,
                    'fields'          => array('_thumbnail_id' ),          
                    'submit_value' => 'Update Content'
                )); 
            echo '</div>';
        else:
    ?>
    	<div class="about-single">
    		<div class="container row-eq-height">
    			<div class="col-md-8 col-sm-7 about-single-content">
    				<?php if ( has_post_thumbnail() ) { ?>
                    <?php the_post_thumbnail( 'feature-image', array( 'class' => 'pull-right' ) ); ?>
                    <?php } ?>
					<?php if ( is_page('181') || is_page('183') || is_page('210') ) { ?>
					<?php if ( in_array( 'buoy_site_administrator', (array) $current_user->roles ) ) { ?> 
					 <a href="<?php the_permalink(); ?>?page-id=<?php echo get_the_ID(); ?>" class="edit-btn">Edit Post</a>
					<?php } ?>
					<?php } ?>
					
					<?php if ( in_array( 'administrator', (array) $current_user->roles ) ) { ?> 
                    <a href="<?php the_permalink(); ?>?page-id=<?php echo get_the_ID(); ?>" class="edit-btn">Edit Post</a>
					<?php } ?>
    				<div class="about-single-info">
    					<?php the_content(); ?>
    				</div>
    			</div>
                <?php get_sidebar(); ?>
    		</div>
    	</div>
	<?php endif; ?>	
<?php endwhile; ?>
<?php endif; ?>

<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>
