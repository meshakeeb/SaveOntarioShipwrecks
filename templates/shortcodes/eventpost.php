<?php
/**
 * Event posts shortcode.
 */

$my_posts = get_posts([
	'posts_per_page' => 5,
	'post_type'      => 'tribe_events',
	'orderby'        => 'date',
	'sort_order'     => 'desc',
]);

?>
<div class="side-links">

	<h3 class="heading">Upcoming Events</h3>

	<ul>
		<?php foreach ( $my_posts as $my_post ) : ?>
			<li><a href="<?php echo get_permalink( $my_post ); ?>"><?php echo $my_post->post_title; ?></a></li>
		<?php endforeach; ?>
	</ul>

</div>
