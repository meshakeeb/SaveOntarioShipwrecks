<?php 
global $shortname;
get_header(); 
?>

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
		<?php get_template_part('templates/partials/user-gallery', 'search'); ?>	

			

		<?php $images = get_field('u_gallery_images'); ?>
		<?php if( is_user_logged_in() ) : ?>
		<p></p>
		<p align="right"><a href="<?php echo add_query_arg( array('edit' => get_the_ID() ), '/dashboard/user-gallery/'); ?>" class="btn btn-danger">Edit this gallery</a></p>
		<?php endif; ?>
		<ul class="gallery gallery-list" style="width: 100%">
		<?php foreach($images as $img) : ?>
			<li class="col-sm-4">	
				<?php //print_r($img); ?>
				<a href="<?php echo $img['url']; ?>">
					<div class="item">
						<img src="<?php echo $img['url']; ?>" class="img-full" alt=""/>
						<div class="overlay">
							<div class="overlay-inner">
								<i class="fa fa-search-plus"></i>
								<h4><?php echo $img['title']; ?></h4>
							</div>
						</div>
					</div>
				</a>
			</li>
		<?php endforeach; ?>	
		</ul>	

		<?php if( is_user_logged_in() ) : ?>
		<p align="right"><a href="<?php echo add_query_arg( array('edit' => get_the_ID() ), '/dashboard/user-gallery/'); ?>" class="btn btn-danger">Edit</p>
		<?php endif; ?>			

	</div>
</div>

<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>