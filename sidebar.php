<?php global $shortname; ?>

			<div class="col-md-4 col-sm-5 about-single-sidebar">    

<?php if ( is_woocommerce() ) { ?>

<?php

$args = array( 'taxonomy' => 'product_cat' );
$terms = get_terms('product_cat', $args);
$url = get_bloginfo('url');

if (count($terms) > 0) {
	echo '<h3 class="heading">SHOP CATEGORIES</h3>';
    echo '<div class="side-links"><ul>';
    foreach ($terms as $term) {
        echo '<li><a href="'. $url .'/product-category/' . $term->slug . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a></li>';    
    }
    echo '</ul></div>';
}

?>

<?php } else { ?>			
                
<?php
$current = $post->ID;
$parent = $post->post_parent;
$grandparent_get = get_post($parent);
$grandparent = $grandparent_get->post_parent;
global $wp_query;
$post = $wp_query->post;
$ancestors = get_post_ancestors($post);
if( empty($post->post_parent) ) {
    $parent = $post->ID;
} else {
    $parent = end($ancestors);
} 
if(wp_list_pages("title_li=&child_of=$parent&echo=0" )) { ?>

<h3 class="heading">
    <?php if ($root_parent = get_the_title($grandparent) !== $root_parent = get_the_title($current)) {echo get_the_title($grandparent); }else {echo get_the_title($parent); }?>
</h3>

                
<div class="side-links">
<ul>
    <?php wp_list_pages("title_li=&child_of=$parent&depth=2" ); ?>
</ul>
</div>

<?php } ?>
                
<?php include('widgets/volunteer.php'); ?>
				
<?php } ?>
				
			</div>

<?php /*
		<aside class="col-sm-4">
			<?php dynamic_sidebar( 'Page Sidebar' ); ?>	
		</aside>
*/ ?>