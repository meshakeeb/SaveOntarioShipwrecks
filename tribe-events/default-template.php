<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header();
?>
	<div class="page_header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1>Events</h1>
				</div>
		
				<div class="col-sm-6">
					<div class="bcrumbs">
						<div class="container">
			                 <ul>
				                <li><a href="<?php bloginfo('url'); ?>">Home</a></li>
				                <li><span>Events</span></li>
			                 </ul>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>

	<div class="about-single">
		<div class="container row-eq-height">
			<div class="col-md-12 event-single">

	               <?php tribe_events_before_html(); ?>
	               <?php tribe_get_view(); ?>
	               <?php tribe_events_after_html(); ?>

			</div>
		</div>
	</div>

	<div class="cta-info">
		<div class="container">
			<p>Become a Member. <b class="fw500">Sign up now!</b> <a href="#">Register</a></p>
		</div>
	</div>

	<div class="cta-dark">
		<div class="container">
			<div class="cta">
				<p>Save Ontario Shipwrecks gratefully acknowledge the Ministry of Tourism, Culture and Sport, Culture Programs Unit and our many sponsors for their support. We also gratefully acknowledge the financial support of the Ontario Trillium Foundation, an agency of the Ministry of Culture.</p>
				<img src="<?php bloginfo('template_url'); ?>/images/logos-dark.jpg" alt=""/>
			</div>
		</div>
	</div>

<?php
get_footer();
