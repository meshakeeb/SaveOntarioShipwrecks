<?php global $shortname; ?>

<?php
/* Template Name: Executive */
get_header(); ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

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
                
            <div class="about-single-info">
                
                <?php the_content(); ?>
				
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#directors">Board of Directors</a></li>
                <li><a data-toggle="tab" href="#special">Special Functions</a></li>
            </ul>
					
            <div class="tab-content">
                
                <?php if( have_rows('board_of_directors') ): ?>
                
                <div id="directors" class="tab-pane fade in active">
                            
				    <div class="get-involved">
					   <ul>
                        
                          <?php while ( have_rows('board_of_directors') ) : the_row(); ?>
                          <?php 	
                            $id = get_sub_field('board_photo'); 
	                        $size = "full";
	                        $image = wp_get_attachment_image_src( $id, $size );
                          ?>
                           
						  <li>
							<div class="item">
								<img src="<?php echo $image[0]; ?>" alt="<?php the_sub_field('board_name'); ?>" />
								
								<h4><?php the_sub_field('board_name'); ?></h4>
								<span><?php the_sub_field('board_title'); ?></span>
								
								<a href="mailto:<?php the_sub_field('board_email'); ?>"><?php the_sub_field('board_email'); ?></a>
							</div>
						  </li>
					
		                  <?php endwhile; ?>
					
					   </ul>
				    </div>
				
				</div>
                
                <?php endif; ?>
                
                <?php if( have_rows('special_functions') ): ?>
						
                <div id="special" class="tab-pane fade">
                    
				    <div class="get-involved">
					   <ul>
                        
                          <?php while ( have_rows('special_functions') ) : the_row(); ?>
                          <?php 	
                            $id = get_sub_field('function_photo'); 
	                        $size = "full";
	                        $image = wp_get_attachment_image_src( $id, $size );
                          ?>
                           
						  <li>
							<div class="item">
								<img src="<?php echo $image[0]; ?>" alt="<?php the_sub_field('function_name'); ?>" />
								
								<h4><?php the_sub_field('function_name'); ?></h4>
								<span><?php the_sub_field('function_title'); ?></span>
								
								<a href="mailto:<?php the_sub_field('function_email'); ?>"><?php the_sub_field('function_email'); ?></a>
							</div>
						  </li>
					
		                  <?php endwhile; ?>
					
					   </ul>
				    </div>
					
				</div>
                
                <?php endif; ?>

            </div> 
                
            </div>
                
            </div>
            
<?php get_sidebar(); ?>
            
        </div>
    </div>
			
<?php endwhile; ?>
<?php endif; ?>

<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>
