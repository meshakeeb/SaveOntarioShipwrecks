<?php
	$id = get_field('slide_image'); 
	$size = "slider-image";
	$image = wp_get_attachment_image_src( $id, $size );
	
	// check if the repeater field has rows of data
	if( have_rows('slides') ):
	$nav_counter = 1;
	$nav_slideto = $nav_counter-1;
	$slide_counter = 1
?>

	<div class="hero-wrap" style="background: #031420 url(<?php echo $image[0]; ?>) no-repeat center top;
	background-size: cover;">
		<div class="container">
			<div id="myCarousel" class="hero-slider carousel slide" data-ride="carousel">
				<div class="nav-wrap">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<?php while ( have_rows('slides') ) : the_row(); ?>
						<li data-target="#myCarousel" data-slide-to="<?php echo $nav_slideto; ?>" class="<?php if ($nav_counter==1) { echo 'active'; }?>"><?php echo $nav_counter; ?></li>
						<?php $nav_counter++; $nav_slideto = $nav_counter-1; ?>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</ol>
					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">
					<span class="fa fa-arrow-left"></span>
					</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
					<span class="fa fa-arrow-right"></span>
					</a>	
				</div>
				<!-- Slides -->
				<div class="carousel-inner">
		
		<?php
			// loop through the rows of data
			while ( have_rows('slides') ) : the_row();
		?>
		
			<div class="item<?php if ($slide_counter==1) { echo ' active'; }?>">
				<?php the_sub_field('slide_description'); ?>
				<?php if ( get_sub_field('slide_button_link') ) { ?>
				<a href="<?php the_sub_field('slide_button_link'); ?>" class="bttn"><?php the_sub_field('slide_button_text'); ?> ></a>
				<?php } ?>
			</div>
			
		<?php $slide_counter++; ?>
		<?php endwhile; ?>

		</div>
	</div>	

<?php endif; ?>
<?php wp_reset_postdata(); ?>

				</div>
			</div>
		</div>
	</div>