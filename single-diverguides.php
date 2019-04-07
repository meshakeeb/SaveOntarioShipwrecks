<?php 
global $shortname; 
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
								<li><a href="<?php bloginfo('url'); ?>/resources/diver-guides">Diver Guides</a></li>
								<li><span><?php the_title(); ?></span></li>
							</ul>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>
	<?php 
        if( isset( $_GET['diverguides-cpt'] ) && !empty( $_GET['diverguides-cpt'] ) && !isset( $_GET['updated'] ) && empty( $_GET['updated']  ) ):
            echo '<div class="container">';
    
                acf_form(array(
            		'post_id'		  => $_GET['diverguides-cpt'],
            		'post_title'	  => true,
            		'post_content'	  => true,
                    'fields'          => array('_thumbnail_id' ),
                    'updated_message' => __("Diverguides updated", 'acf'),
                    'new_post'		  => array(
            			'post_type'     => 'diverguides', 
            			'post_status'	=> 'publish'
            		),
                    'submit_value'	=> 'Update Diverguides'
            	));
            
            echo '</div>';
        else:
    ?>
	<div class="about-single">
		<div class="container row-eq-height">
			<div class="col-md-8 col-sm-7 blog-single">

                <h1 class="post-title"><?php the_title(); ?></h1>
				<a href="<?php the_permalink(); ?>?diverguides-cpt=<?php echo get_the_ID(); ?>" class="edit-btn">Edit Diverguides</a>
				<p>&nbsp;</p>

                <?php the_content(); ?>

            <div class="nav-post">
            <div class="row">
            <div class="col-sm-4 col-xs-6">
            	<?php previous_post_link('%link', '<i class="fa fa-arrow-left"></i> prev'); ?>
            </div>
            
            <div class="col-sm-4 hidden-xs text-center">
            	&nbsp;
            </div>
            
            <div class="col-sm-4 col-xs-6 text-right">
            	<?php next_post_link('%link', 'next <i class="fa fa-arrow-right"></i>'); ?>
            </div>
            </div>
            </div>

					
			</div>
            
            <?php get_sidebar(); ?>
		</div>
	</div>
    <?php endif; ?>
<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>