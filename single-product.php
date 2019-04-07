<?php 
global $shortname; 
acf_form_head();
get_header(); 
if (have_posts()) : 
    while (have_posts()) : the_post(); ?>

	<div class="page_header">
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<h1><?php the_title(); ?></h1>
				</div>
		
				<div class="col-sm-3">
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
    <?php 
        if( isset( $_GET['product-id'] ) && !empty( $_GET['product-id'] ) && !isset( $_GET['updated'] ) && empty( $_GET['updated']  ) ):
            echo '<div class="container">';
                acf_form(array(
                    'post_id'	   => $_GET['product-id'], //Variable that you'll get from the URL
                    'post_title'   => true,
                    'post_content' => true,
                    'fields'          => array('_thumbnail_id', '_regular_price', '_sale_price', 'woocommerce_short_description', 'product_image_gallery' ),
                    'submit_value' => 'Update Content'
                )); 
            echo '</div>';
        else:
    ?>
	<div class="about-single">
		<div class="container row-eq-height">
			<div class="col-md-8 col-sm-7 about-single-content">
				<?php if ( has_post_thumbnail() ) { ?>
                <?php the_post_thumbnail( 'feature-image', array( 'class' => 'pull-right' ) ); ?>
                <?php } ?>
                <a href="<?php the_permalink(); ?>?product-id=<?php echo get_the_ID(); ?>" class="edit-btn">Edit Product</a>
				<div class="about-single-info">
					<?php the_content(); ?>
				</div>
			</div>
            <?php get_sidebar(); ?>
		</div>
	</div>
    <?php endif; ?>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
