<?php
/**
 * News posts shortcode.
 */

$my_posts = get_posts([
	'posts_per_page' => 5,
	'tax_query' => [
		'relation' => 'OR',
		[
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => 'news' //pass your term name here
		],
		[
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => $this->get_chapter_slug(),
		],
	],
]);

?>
<div class="side-links">

	<h3 class="heading">Chapter Activity</h3>

	<ul>
		<?php foreach ( $my_posts as $my_post ) : ?>
			<li><a href="<?php echo get_permalink( $my_post ); ?>"><?php echo $my_post->post_title; ?></a></li>
		<?php endforeach; ?>
	</ul>

</div>
