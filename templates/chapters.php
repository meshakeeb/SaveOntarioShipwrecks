<?php global $shortname; ?>

<?php
/* Template Name: Chapters */
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
                <li class="active"><a data-toggle="tab" href="#eastern">Eastern</a></li>
                <li><a data-toggle="tab" href="#central">Central</a></li>
                <li><a data-toggle="tab" href="#western">Western</a></li>
                <li><a data-toggle="tab" href="#northern">Northern</a></li>
            </ul>
					
            <div class="tab-content">
                
                <?php if( have_rows('eastern') ): ?>
                
                <div id="eastern" class="tab-pane fade in active">
                            
				    <div class="get-involved">
					   <ul>
                        
                          <?php while ( have_rows('eastern') ) : the_row(); ?>
                          <?php 	
                            $id = get_sub_field('eastern_photo'); 
	                        $size = "full";
	                        $image = wp_get_attachment_image_src( $id, $size );
                          ?>
                           
						  <li>
							<div class="item">
								<img src="<?php echo $image[0]; ?>" alt="<?php the_sub_field('eastern_name'); ?>" />
								
								<h4><?php the_sub_field('eastern_name'); ?></h4>
								<span><?php the_sub_field('eastern_title'); ?></span>
								
								<a href="mailto:<?php the_sub_field('eastern_email'); ?>"><?php the_sub_field('eastern_email'); ?></a>
							</div>
						  </li>
					
		                  <?php endwhile; ?>
					
					   </ul>
				    </div>
				
				</div>
                
                <?php endif; ?>
                
                <?php if( have_rows('central') ): ?>
						
                <div id="central" class="tab-pane fade">
                    
				    <div class="get-involved">
					   <ul>
                        
                          <?php while ( have_rows('central') ) : the_row(); ?>
                          <?php 	
                            $id = get_sub_field('central_photo'); 
	                        $size = "full";
	                        $image = wp_get_attachment_image_src( $id, $size );
                          ?>
                           
						  <li>
							<div class="item">
								<img src="<?php echo $image[0]; ?>" alt="<?php the_sub_field('central_name'); ?>" />
								
								<h4><?php the_sub_field('central_name'); ?></h4>
								<span><?php the_sub_field('central_title'); ?></span>
								
								<a href="mailto:<?php the_sub_field('central_email'); ?>"><?php the_sub_field('central_email'); ?></a>
							</div>
						  </li>
					
		                  <?php endwhile; ?>
					
					   </ul>
				    </div>
					
				</div>
                
                <?php endif; ?>
                
                <?php if( have_rows('western') ): ?>
						
                <div id="western" class="tab-pane fade">
                    
				    <div class="get-involved">
					   <ul>
                        
                          <?php while ( have_rows('western') ) : the_row(); ?>
                          <?php 	
                            $id = get_sub_field('western_photo'); 
	                        $size = "full";
	                        $image = wp_get_attachment_image_src( $id, $size );
                          ?>
                           
						  <li>
							<div class="item">
								<img src="<?php echo $image[0]; ?>" alt="<?php the_sub_field('western_name'); ?>" />
								
								<h4><?php the_sub_field('western_name'); ?></h4>
								<span><?php the_sub_field('western_title'); ?></span>
								
								<a href="mailto:<?php the_sub_field('western_email'); ?>"><?php the_sub_field('western_email'); ?></a>
							</div>
						  </li>
					
		                  <?php endwhile; ?>
					
					   </ul>
				    </div>
					
				</div>
                
                <?php endif; ?>
                
                <?php if( have_rows('northern') ): ?>
						
                <div id="northern" class="tab-pane fade">
                    
				    <div class="get-involved">
					   <ul>
                        
                          <?php while ( have_rows('northern') ) : the_row(); ?>
                          <?php 	
                            $id = get_sub_field('northern_photo'); 
	                        $size = "full";
	                        $image = wp_get_attachment_image_src( $id, $size );
                          ?>
                           
						  <li>
							<div class="item">
								<img src="<?php echo $image[0]; ?>" alt="<?php the_sub_field('northern_name'); ?>" />
								
								<h4><?php the_sub_field('northern_name'); ?></h4>
								<span><?php the_sub_field('northern_title'); ?></span>
								
								<a href="mailto:<?php the_sub_field('northern_email'); ?>"><?php the_sub_field('northern_email'); ?></a>
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
