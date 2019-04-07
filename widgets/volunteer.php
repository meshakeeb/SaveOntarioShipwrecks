				<h3 class="heading">Donate to sos</h3>
				<div class="volunteer">
				
					<?php if ( !is_user_logged_in() ) { ?>
					<h4>Wanna be a<br>Volunteer?</h4>
					<img src="<?php bloginfo('template_url'); ?>/images/icon-volunteer.png" class="center-block img-responsive" alt=""/>
					<a href="<?php bloginfo('url'); ?>/membership/register" class="bttn bttn-white">Join Us Now!</a>
					<?php } else { ?>
					<h4>Donate <br>to SOS</h4>
					<img src="<?php bloginfo('template_url'); ?>/images/icon-volunteer.png" class="center-block img-responsive" alt=""/>
					<?php } ?>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_s-xclick" /><br />
						<input type="hidden" name="hosted_button_id" value="E44ARADM665G4" /><br />
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" /><br />
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1" /><br />
					</form>
					
				</div>