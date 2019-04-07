		<div class="map-search gallery-search">
			<div class="col-md-12">
				<form method="get"  action="/uploaded-galleries/">
					<input type="text" placeholder="Search a gallery by name..." name="s"/>
					<button type="submit"><i class="fa fa-search"></i></button>
					<input type="hidden" name="post_type" value="bolt_user_gallery" />
				</form>
			</div>


			<form method="get" id="photoFilter" action="/uploaded-galleries/">
				<div class="col-md-6">
					<div class="custom-select">
						<span class="fa fa-caret-down"></span>
							<select name="chapter">
								<option value="0">Select Chapter</option>
								<?php if( isset($_GET['chapter']) && $_GET['chapter'] !== "0" ) :?>
									<option value="<?php echo $_GET['chapter']; ?>" selected="selected"><?php echo get_the_title($_GET['chapter']); ?></option>
								<?php else : ?>	
								<?php endif; ?>

								<?php foreach( BoltMediaFront::dropdowns()['chapters'] as $chapter ) : ?>
										<option value="<?php echo $chapter->ID; ?>"><?php echo $chapter->post_title; ?></option>
								<?php endforeach; ?>	
							</select>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="custom-select">
						<span class="fa fa-caret-down"></span>
							<select name="uploader">
								<option value="0">Select Uploader</option>									
								<?php if(  isset($_GET['uploader']) && $_GET['uploader']  !== "0" ) :?>
									<option value="<?php echo $_GET['uploader']; ?>" selected="selected"><?php echo get_user_meta( $_GET['uploader'],'billing_last_name',true); ?>, <?php echo get_user_meta( $_GET['uploader'],'billing_first_name',true); ?></option>
								<?php else : ?>	
								<?php endif; ?>

								<?php foreach( BoltMediaFront::membersWithGallery()as $author ) : ?>
										<option value="<?php echo $author; ?>"><?php echo get_user_meta($author,'billing_last_name',true); ?>, <?php echo get_user_meta($author,'billing_first_name',true); ?></option>
								<?php endforeach; ?>	
							</select>
					</div>
				</div>

				<div class="col-md-12">
					<p align="right" class="clearfix" style="margin: 15px 0; text-align: right"><a href="<?php bloginfo('url'); ?>/uploaded-galleries/" style="color:#fff">Reset Search</a></p>
				</div>															
				<div class="clearfix"></div>
				
			</form>	
		</div>	