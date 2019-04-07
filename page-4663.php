<?php 
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
	
    	<div class="about-single">
    		<div class="container row-eq-height">
    			<div class="col-md-8 col-sm-7 about-single-content">
    					<div class="about-single-info">
<?php /* old data

    					<h2>Buoy Program Members</h2>
<p><a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/Buoy-Program-Overview.pdf" target="_blank" rel="noopener">Buoy Program Overview</a> (PDF)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/G70-Double-Clevis-Link.pdf" target="_blank" rel="noopener">3/8&#8243; G70 Double Clevis Link</a> (PDF)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/Mooring-Decal.pdf" target="_blank" rel="noopener">Mooring Decal</a> (PDF)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/SOR-99-335.pdf" target="_blank" rel="noopener">SOR-99-335</a> (PDF)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/SOS-Buoy-Site-Application-Form.xls" target="_blank" rel="noopener">Buoy Site Application Form</a> (XLS)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/SOS-Mooring-Program-Handbook-2015-07-24-1900hrs.pdf" target="_blank" rel="noopener">Mooring Program Handbook, 2015-07-24, 1900hrs</a> (PDF)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/SOS-Spar-Buoy-Application-Form.doc" target="_blank" rel="noopener">Spar Buoy Application Form</a> (DOC)</p>
<h2>Chapter Report Templates</h2>
<p><a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/Application-for-project-funding.xls" target="_blank" rel="noopener">Application for project funding</a> (XLS)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/Old-Chapter-Financial-Rpt.xls" target="_blank" rel="noopener">Old Chapter Financial Report</a> (XLS)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/Old-Project-Cost-Sum.xls" target="_blank" rel="noopener">Old Project Cost Sum</a> (XLS)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/Old-SOS-ASSET-PROPERTY-REPORT.xls" target="_blank" rel="noopener">Old SOS Asset Property Report</a> (XLS)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/SOS-Administrative-Calendar.pdf" target="_blank" rel="noopener">Administrative Calendar</a> (PDF)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/SOS-Annual-Chapter-Workbook.xls" target="_blank" rel="noopener">Annual Chapter Workbook</a> (XLS)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/SOS-Appearance-Release.pdf" target="_blank" rel="noopener">Appearance Release</a> (PDF)</p>
<h2>Financial Members</h2>
<p><a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/Expense-Claim.xls" target="_blank" rel="noopener">Expense Claim</a> (XLS)</p>
<h2>Handbook Documents (Members)</h2>
<p><a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/1-Binder-covers.pdf" target="_blank" rel="noopener">1 &#8211; Binder Covers</a> (PDF)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/2-Binder-Index.pdf" target="_blank" rel="noopener">2 &#8211; Binder Index</a> (PDF)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/3-Handbook.pdf" target="_blank" rel="noopener">3 &#8211; Handbook</a> (PDF)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/4-Job-Descriptions.pdf" target="_blank" rel="noopener">4 &#8211; Job Descriptions</a> (PDF)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/5-BY-LAW-No-2.pdf" target="_blank" rel="noopener">5 &#8211; By-law No 2</a> (PDF)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/6-Resolutions.pdf" target="_blank" rel="noopener">6 &#8211; Resolutions</a> (PDF)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/7-Policies.pdf" target="_blank" rel="noopener">7 &#8211; Policies</a> (PDF)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/8-Senior-Tutor-Agreement.pdf" target="_blank" rel="noopener">8 &#8211; Senior Tutor Agreement</a> (PDF)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/9-Tutor-Agreement.pdf" target="_blank" rel="noopener">9 &#8211; Tutor Agreement</a> (PDF)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/10-Administrative-Calendar.pdf" target="_blank" rel="noopener">10 &#8211; Administrative Calendar</a> (PDF)<br />
<a href="https://saveontarioshipwrecks.ca/wp-content/uploads/2018/10/2013-Binder.pdf" target="_blank" rel="noopener">2013 Binder</a> (PDF)</p>

*/ ?>    						
						<?php
							$user_info = wp_get_current_user();
							if ( 
								in_array("provincial_membership", $user_info->roles)
								|| in_array("administrator", $user_info->roles)
							) :
				    	?>
						<?php
				                acf_form(array(
				                    'id'	   => 'group_5c9e5f1b6d247',
				                    'post_title'   => false,
				                    'post_content' => false,
				                    'field_groups' => array('group_5c9e5f1b6d247'),      
				                    'submit_value' => 'Update Member Documents'
				                )); 
				        ?> 
    				<?php else : ?>

			            <?php if(have_rows('field_5c9e6181857a0') ) : ?>    
			                <?php while( have_rows('field_5c9e6181857a0') ): the_row(); ?>
			                    <h2><?php the_sub_field('field_5c9e629380921'); ?></h2>    
					            
					            <?php if(have_rows('field_5c9e61f9ccf95') ) : ?>    
					                <?php while( have_rows('field_5c9e61f9ccf95') ): the_row(); ?>	
					                	<?php 
					                		$file     = get_sub_field('field_5c9e6225b229d'); 
					                		$file_url = wp_get_attachment_url($file);
					                		$filetype = wp_check_filetype( $file_url );
					                	?>	                           
					                	<?php if( is_user_logged_in() ) : ?>
					                		<a href="<?php echo wp_get_attachment_url($file); ?>">
					                	<?php endif; ?>
					                		<?php the_sub_field('field_5c9e621bb229c'); ?>
					                	<?php if( is_user_logged_in() ) : ?>
					                		</a>
					                	<?php else : ?>
					                		<sup>You need to be logged in to view this</sup>	
					                	<?php endif; ?>	
					                	(<?php echo strtoupper($filetype['ext']); ?>)<br>
					                	
					                <?php endwhile; ?>	
					            <?php endif; ?>    

			                <?php endwhile; ?>           
			            <?php endif; ?>      					

    				<?php endif; ?>	
    				</div>
    			</div>
                <?php get_sidebar(); ?>
    		</div>
    	</div>
	
<?php endwhile; ?>
<?php endif; ?>

<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>
