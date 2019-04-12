<?php
/**
 * The template for creating new products.
 * Template Name: Create New Product
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @since   1.0.0
 * @package Ontario
 * @author  BoltMedia <info@boltmedia.ca>
 */

acf_form_head();

get_header();

get_template_part( 'templates/page', 'header' );
?>

<div class="about-single account-page">

	<div class="container row-eq-height">

		<div class="col-md-8 col-sm-7 about-single-content">

			<div class="about-single-info">

				<div class="form-block">

					<?php
					acf_form(
						[
							'post_id'         => isset( $_GET['post_id'] ) ? $_GET['post_id'] : 'new_post',
							'post_title'      => true,
							'post_content'    => true,
							'updated_message' => 'Product Created',
							'fields'          => [
								'_regular_price',
								'_sale_price',
								'field_5cafbc02bf9c3',
								'field_5cafc203d5543',
							],
							'new_post'        => [
								'post_type'   => 'product',
								'post_status' => 'publish',
								'product_cat' => [],
							],
							'submit_value'    => 'Create Product',
						]
					);

					?>

				</div>

				<div class="form-block">
					<?php
					$products = get_posts(
						[
							'posts_per_page'   => -1,
							'offset'           => 0,
							'post_type'        => 'product',
							'post_status'      => 'publish',
							'suppress_filters' => true,
						]
					);
					?>
					<h3>All Products</h3>

					<ul class="list-group">
					<?php
					$page_url = home_url( 'dashboard/add-product/?post_id=' );
					foreach ( $products as $product ) :
						?>
						<li class="list-group-item">
							<?php echo $product->post_title; ?> <a href="<?php echo $page_url . $product->ID; ?>" class="badge">Edit</a>
						</li>
					<?php endforeach; ?>
					</ul>

				</div>

			</div>

		</div>

		<div class="col-md-4 col-sm-5 about-single-sidebar">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>

	</div>

</div>

<?php
get_footer();
