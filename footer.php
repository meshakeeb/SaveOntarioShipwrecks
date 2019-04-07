<?php global $shortname; ?>

	<footer>
		<div class="container">
			<p class="footer-about">SOS is a Provincial Heritage Organization  |  Registration Number: 886164193RR0001  |  Designation: Charitable Organization</p>
			<div class="row">
				<div class="col-sm-7">
					<?php 
						$location = 'footer_menu1';
							if (has_nav_menu($location)) :
								//$menu_obj = get_menu_by_location($location); 
								wp_nav_menu( array( 
									'theme_location'  => $location,
									'depth' => 1,
									'container' => 'div',
									'container_class' => 'footer-links',
									'items_wrap'=> '<h5>About SOS</h5><ul>%3$s</ul>'
								)); 
							endif;
					?>
					
					<?php 
						$location = 'footer_menu2';
							if (has_nav_menu($location)) :
								//$menu_obj = get_menu_by_location($location); 
								wp_nav_menu( array( 
									'theme_location'  => $location,
									'depth' => 1,
									'container' => 'div',
									'container_class' => 'footer-links',
									'items_wrap'=> '<h5>Membership</h5><ul>%3$s</ul>'
								)); 
							endif;
					?>
					
					<?php 
						$location = 'footer_menu3';
							if (has_nav_menu($location)) :
								//$menu_obj = get_menu_by_location($location); 
								wp_nav_menu( array( 
									'theme_location'  => $location,
									'depth' => 1,
									'container' => 'div',
									'container_class' => 'footer-links',
									'items_wrap'=> '<h5>Get Involved</h5><ul>%3$s</ul>'
								)); 
							endif;
					?>
					
				</div>
				<div class="col-sm-5">
					<div class="newsletter">
						<h5>Newsletter Signup</h5>
						<?php echo do_shortcode('[contact-form-7 id="3516" title="Newsletter"]'); ?>
					</div>
				</div>
			</div>
		</div>
	</footer>
	
	<div class="footer-bottom">
		<div class="container">
			<?php
				wp_nav_menu( array(
				'theme_location'    => 'meta_menu',
				'depth'             => 1,
				'container'         => '',
				'container_class'   => '',
				'container_id'      => '',
				'menu_class'        => '')
				);
			?>
		</div>
	</div>
</div>

<script src="<?php bloginfo('template_url'); ?>/js/vendor/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/vendor/lity/lity.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/vendor/mfp/jquery.magnific-popup.min.js"></script>	
<script src="<?php bloginfo('template_url'); ?>/js/main.js"></script>

<?php echo stripslashes(get_option($shortname."_tracking_code")); ?>
<?php wp_footer(); ?>
<script>
     jQuery(document).ready(function(){
        jQuery('.dropdown-toggle').dropdown();
jQuery(".dropdown-menu").on('click', 'li a', function(){
      jQuery(".btn:first-child").text(jQuery(this).text());
      jQuery(".btn:first-child").val($(this).text());
   });

    });
</script>
<script>
function cat_ajax_get(catID) {
    jQuery("a.ajax").removeClass("current");
    jQuery("a.ajax").addClass("current"); //adds class current to the category menu item being displayed so you can style it with css
    jQuery("#loading-animation").show();
    var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); //must echo it ?>';
    jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {"action": "load-filter", cat: catID },
        success: function(response) {
            jQuery("#category-post-content").html(response);
            jQuery("#loading-animation").hide();
            return false;
        }
    });
}
</script>
</body>
</html>