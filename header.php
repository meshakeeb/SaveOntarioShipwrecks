<?php global $shortname; ?>
<?php include('includes/head.php'); ?>

<?php if ( is_front_page() ) { ?>
<body>
<?php } else { ?>
<body class="subpage">
<?php } ?>
    
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=218550351512495&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="wrapper">
	<div class="logo">
		<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt=""/></a>
	</div>
	
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="topbar">
				<div class="row">
					<div class="col-sm-5">
						<div class="top-left-content">
							<div class="social">
								<?php if (get_option($shortname."_linkedin")) { ?>
									<a href="<?php echo get_option($shortname."_linkedin"); ?>" target="_blank"><i class="fa fa-linkedin-square"></i></a>
								<?php } ?>
								<?php if (get_option($shortname."_facebook")) { ?>
									<a href="<?php echo get_option($shortname."_facebook"); ?>" target="_blank"><i class="fa fa-facebook-square"></i></a>
								<?php } ?>
								<?php if (get_option($shortname."_instagram")) { ?>
									<a href="<?php echo get_option($shortname."_instagram"); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
								<?php } ?>
								<?php if (get_option($shortname."_twitter")) { ?>
									<a href="<?php echo get_option($shortname."_twitter"); ?>" target="_blank"><i class="fa fa-twitter-square"></i></a>
								<?php } ?>
								<?php if (get_option($shortname."_youtube")) { ?>
									<a href="<?php echo get_option($shortname."_youtube"); ?>" target="_blank"><i class="fa fa-youtube"></i></a>
								<?php } ?>
							</div>
							<a href="<?php bloginfo('url'); ?>">SaveOntarioShipwrecks.ca</a>
						</div>
					</div>
					<div class="col-sm-7">
						<?php
							wp_nav_menu( array(
							'theme_location'    => 'header_menu',
							'depth'             => 1,
							'container'         => 'div',
							'container_class'   => 'top-right-content',
							'container_id'      => 'header-menu',
							'menu_class'        => 'top-links')
							);
						?>
					</div>
				</div>
			</div>
			<div class="search-trigger">
			</div>

			<form role="search" method="get" id="search-form" class="search-form" action="<?php bloginfo('url'); ?>/">
				<input type="text" value="" name="s" id="search-term" placeholder="Search..." />
				<button type="submit"><i class="fa fa-search"></i></button>
			</form>
			
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			Menu <i class="fa fa-navicon"></i>
			</button>
			
			<?php
				wp_nav_menu( array(
				'theme_location'    => 'main_menu',
				'depth'             => 3,
				'container'         => 'div',
				'container_class'   => 'navbar-collapse collapse',
				'container_id'      => 'navbar',
				'menu_class'        => 'nav navbar-nav',
				'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
				'walker'            => new wp_bootstrap_navwalker()
				)
				);
			?>
			
		</div>
	</nav>