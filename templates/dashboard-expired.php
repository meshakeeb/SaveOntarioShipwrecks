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
                                <?php if ( is_page('dashboard') ) { ?>
				                <li><span><?php the_title(); ?></span></li>
                                <?php } else { ?>
                                <li><a href="<?php bloginfo('url'); ?>/dashboard">Dashboard</a></li>
                                <li><span><?php the_title(); ?></span></li>
                                <?php } ?>
			                 </ul>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>
	
	<div class="about-single account-page">
		<div class="container row-eq-height">
			<div class="col-md-12 col-sm-12 about-single-content">
                
                <?php if ( is_page('dashboard') ) { ?>
                
				<div class="about-single-info">
					<h2>Welcome, <strong><?php echo $username; ?></strong> <span>Not <?php echo $username; ?>? <a href="<?php echo wp_logout_url(); ?>">Logout</a>.</span></h2>
					
					<hr/>
				</div>
                
                <div class="account-navigation">
                    <div class="container">
                        <div class="row">
                            
                            <div class="col-sm-12">
                                <a href="<?php echo BoltMediaFront::RenewalLink(); ?>" class="item">
                                    <div class="content">
                                        <h4>Your account has expired.</h4>
                                        <p>Please click here to manage your membership and renew your account.</p>
                                        <span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
                                    </div>
                                </a>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                
				<?php } else { ?>
				
				<?php the_content(); ?>
				
				<?php } ?>

            </div>
        </div>
    </div>