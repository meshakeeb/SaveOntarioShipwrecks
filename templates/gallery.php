<?php global $shortname; ?>
<?php
/* Template Name: Photo Gallery */
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
	

	
	<div class="gallery-listing">
		<div class="container">
			<?php //print_r( $boltFront->dropdowns() ); ?>
			<div class="map-search gallery-search">
				<div class="col-md-9">
					<form method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
						<input type="text" placeholder="Search a photo by name..." name="s"/>
						<button type="submit"><i class="fa fa-search"></i></button>
						<input type="hidden" name="post_type" value="page" />
					</form>
				</div>


				<form method="get" id="photoFilter">
					<div class="col-md-3">
						<div class="custom-select">
							<span class="fa fa-caret-down"></span>
								<select name="chapter">
									<option value="0">Select Chapter</option>
									<?php if( isset($_GET['chapter']) && $_GET['chapter'] !== "0" ) :?>
										<option value="<?php echo $_GET['chapter']; ?>" selected="selected"><?php echo get_the_title($_GET['chapter']); ?></option>
									<?php else : ?>	
									<?php endif; ?>

									<?php foreach( $boltFront->dropdowns()['chapters'] as $chapter ) : ?>
											<option value="<?php echo $chapter->ID; ?>"><?php echo $chapter->post_title; ?></option>
									<?php endforeach; ?>	
								</select>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="custom-select">
							<span class="fa fa-caret-down"></span>
								<select name="ship">
									<option value="0">Select Ship</option>									
									<?php if(  isset($_GET['ship']) && $_GET['ship']  !== "0" ) :?>
										<option value="<?php echo $_GET['ship']; ?>" selected="selected"><?php echo $_GET['ship']; ?></option>
									<?php else : ?>	
									<?php endif; ?>

									<?php foreach( $boltFront->dropdowns()['ships'] as $ship ) : ?>
											<option value="<?php echo $ship->meta_value; ?>"><?php echo $ship->meta_value; ?></option>
									<?php endforeach; ?>	
								</select>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="custom-select">
							<span class="fa fa-caret-down"></span>
								<select name="site">
									<option value="0">Select site</option>
									<?php if(  $_GET['site'] && $_GET['site']  !== "0" ) :?>
										<option value="<?php echo $_GET['site']; ?>" selected="selected"><?php echo get_the_title($_GET['site']); ?></option>
									<?php else : ?>											
									<?php endif; ?>

									<?php foreach( $boltFront->dropdowns()['sites'] as $site ) : ?>
											<option value="<?php echo $site->ID; ?>"><?php echo $site->post_title; ?></option>
									<?php endforeach; ?>	
								</select>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="custom-select">
							<span class="fa fa-caret-down"></span>
								<select name="author">
									<option value="0">Select author</option>									
									<?php if(  isset($_GET['author']) && $_GET['author']  !== "0" ) :?>
										<option value="<?php echo $_GET['author']; ?>" selected="selected"><?php echo $_GET['author']; ?></option>
									<?php else : ?>	
									<?php endif; ?>

									<?php foreach( $boltFront->dropdowns()['authors'] as $author ) : ?>
											<option value="<?php echo $author->meta_value; ?>"><?php echo $author->meta_value; ?></option>
									<?php endforeach; ?>	
								</select>
						</div>
					</div>

					<div class="col-md-3">
						<div class="custom-select">
							<span class="fa fa-caret-down"></span>
								<select name="water">
									<option value="0">Select water</option>									
									<?php if(  isset($_GET['water']) && $_GET['water']  !== "0" ) :?>
										<option value="<?php echo $_GET['water']; ?>" selected="selected"><?php echo $_GET['water']; ?></option>
									<?php else : ?>	
									<?php endif; ?>

									<?php foreach( $boltFront->dropdowns()['waters'] as $water ) : ?>
											<option value="<?php echo $water->field_bodywater_value; ?>"><?php echo $water->field_bodywater_value; ?></option>
									<?php endforeach; ?>	
								</select>
						</div>
					</div>		
					<div class="col-md-12">
						<p align="right" class="clearfix" style="margin: 15px 0; text-align: right"><a href="<?php bloginfo('url'); ?>/resources/photo-gallery/" style="color:#fff">Reset Search</a></p>
					</div>															
					<div class="clearfix"></div>
					
				</form>	
			</div>
			
			<ul class="gallery gallery-list">
			<?php $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; ?>
			<?php 

				$args = array(
								'paged'             => $paged, 
								'post_type'         => 'gallery', 
								'posts_per_page'    => 12, 			
						); 

				if( isset($_GET['ship']) && $_GET['ship'] != "0" ){

					$args['meta_query'] = array(array(
					    'key' => 'ship',
					    'value' => $_GET['ship']
					));					
					$args['orderby'] = 'meta_value';
					$args['order'] = 'ASC';

				} else if( isset($_GET['author']) && $_GET['author'] != "0" ){

					$args['meta_query'] = array(array(
					    'key' => 'photo_author',
					    'value' => $_GET['author']
					));					
					$args['orderby'] = 'meta_value';
					$args['order'] = 'ASC';

				} else if( isset($_GET['water']) && $_GET['water'] != "0" ){

					$args['meta_query'] = array(array(
					    'key' => 'body_of_water',
					    'value' => $_GET['water']
					));					
					$args['orderby'] = 'meta_value';
					$args['order'] = 'ASC';

				} else if( isset($_GET['chapter']) && $_GET['chapter'] != "0" ){

					$args['meta_query'] = array(array(
					    'key' => 'chapter',
					    'value' => $_GET['chapter']
					));					
					$args['orderby'] = 'meta_value';
					$args['order'] = 'ASC';

				} else if( isset($_GET['site']) && $_GET['site'] != "0" ){

					$args['meta_query'] = array(array(
					    'key' => 'site',
					    'value' => $_GET['site']
					));					
					$args['orderby'] = 'meta_value';
					$args['order'] = 'ASC';

				}

				//echo '<pre>'; print_r($args); echo '</pre>';

			$gallery = new WP_Query( $args ); 
			?>

			<?php if ( $gallery->have_posts() ) : ?>				
			
				<?php while ( $gallery->have_posts() ) : $gallery->the_post(); ?>
				
				<?php 	
				$id = get_field('photo'); 
				$size_full = "large";
				$size_thumb = "gallery-thumb";
				$photo = wp_get_attachment_image_src( $id, $size_full );
				$thumb = wp_get_attachment_image_src( $id, $size_thumb );
				?>
			
				<li class="col-sm-4">
					<?php //print_r( get_post_meta( get_the_ID()) ); ?>
					<a href="<?php echo $photo[0]; ?>">
						<div class="item">
							<img src="<?php echo $thumb[0]; ?>" class="img-full" alt=""/>
							<div class="overlay">
								<div class="overlay-inner">
									<i class="fa fa-search-plus"></i>
									<h4><?php the_field('ship'); ?></h4>
								</div>
							</div>
						</div>
					</a>
				</li>

				<?php endwhile; ?>
						
			</ul>
            
            <div class="pagination">
				
        				<?php 
        				echo paginate_links( array(
        				'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        				'total'        => $gallery->max_num_pages,
        				'current'      => max( 1, get_query_var( 'paged' ) ),
        				'format' => '?paged=%#%',
        				'prev_next'    => true,
        				'prev_text' => '<i class="fa fa-arrow-left"></i>',
        				'next_text' => '<i class="fa fa-arrow-right"></i>',
        				'add_fragment' => '',
        				) );
        				?>
				
            </div>			

		</div>
	</div>
	<?php else : ?>
	Nothing found...
	<?php endif; ?>
			
<?php endwhile; ?>
<?php endif; ?>

<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>
