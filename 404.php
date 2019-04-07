<?php global $shortname; ?>

<?php

get_header(); ?>

	<div class="page_header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1>Page Not Found</h1>
				</div>
		
				<div class="col-sm-6">
					<div class="bcrumbs">
						<div class="container">
			                 <ul>
				                <li><a href="<?php bloginfo('url'); ?>">Home</a></li>
				                <li><span>Page Not found</span></li>
			                 </ul>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>
	
    	<div class="about-single">
    		<div class="container row-eq-height">
    			<div class="about-single-content">

    				<div class="about-single-info">
						<p>We're sorry! We have recently made several changes to our website and the page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
					
						<h2>Please try the following:</h2>

						<ul class="list">
							<li>If you typed the page address in your browser's address bar, make sure that it is spelled correctly.</li>
							<li>Use the navigation bar on the top of this page to find the link you are looking for.</li>
							<li>Open the <a href="<?php bloginfo('url'); ?>">home page</a>, and then look for links to the information you want.</li>
							<li>
								Type in a keyword in the search box below.
								<?php get_search_form(); ?>
							</li>
						</ul>
						
						
    				</div>
    			</div>
    		</div>
    	</div>


<?php get_footer(); ?>
