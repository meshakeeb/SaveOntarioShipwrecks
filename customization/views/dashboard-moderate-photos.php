<!-- the loop -->
<?php if ( $photos->have_posts() ) : ?>
	<ol class="gallery gallery-list" style="height: auto; list-style: none">
	<?php while ( $photos->have_posts()) : $photos->the_post(); ?>
		<?php
			$photo_id = get_field('photo');
			$checked = ( get_post_status() === "publish") ? ' checked="checked" ' : '';
		?>	
		<li style="list-style: none">
			<div class="media">
			  <div class="media-left">
				<a href="<?php  echo wp_get_attachment_url($photo_id) ; ?>">
					<img src="<?php echo wp_get_attachment_image_src($photo_id, 'thumbnail')[0]; ?>">
				</a>
			  </div>
			  <div class="media-body">
			    <h4 class="media-heading"><?php the_title(); ?></h4>
				    <dl>
				    	<dt>Body of water: </dt>
						<dd><?php echo ( get_field('body_of_water') != "" ) ? get_field('body_of_water') : 'NOT SET'; ?> </dd>
						<dt>Ship:</dt>
						<dd><?php echo ( get_field('ship') != "") ? get_field('ship') : 'NOT SET'; ?> </dd>
						<dt>Author:</dt>
						<dd><?php echo ( get_field('photo_author') != "") ? get_field('photo_author') : 'NOT SET'; ?></dd>
						<dt>Site:</dt>
						<dd><?php echo ( get_field('site') != "") ? get_the_title(get_field('site')) : 'NOT SET'; ?></dd>					
						<dt>Published</dt>
						<dd>
							<form method="post" id="publish_<?php the_ID();?>" class="publish_post" action="<?php echo admin_url('admin-ajax.php'); ?>">
								<p>
								<input type="hidden" name="post_id" value="<?php the_ID();?>">
								<input type="hidden" name="status" value="draft">
								<input type="checkbox" name="status" id="<?php the_ID();?>" value="publish" <?php echo $checked; ?>>
								<input type="hidden" name="action" value="moderate_photos"> &nbsp; &nbsp;  <input type="submit" class="btn btn-xs btn-primary" value="Update Status">
								<?php wp_nonce_field( 'moderate_photos_nonce', 'nonce_field' ); ?>								
								</p>
							</form>
						</dd>
					</dl>
			  </div>
			</div>		
			<hr>
			<?php //print_r(get_post_meta($photos->ID)); ?>
		</li>
	<?php endwhile; ?>
	</ol>

	<!-- pagination -->
	<div style="float: none; clear: both; font-weight: bold" align="center">
		<?php
			$big = 999999999;
			echo paginate_links( 
				array(
					'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
					'current' => max( 1, get_query_var('paged') ),
					'total' => $photos->max_num_pages,
					'mid_size' => 5
				) 
			);
		?>
	</div>
<?php else : ?>
	No Gallery Found.	
<?php endif; ?>

<script type="text/javascript">
jQuery(document).ready( function($) {
	/*
	$('.publish_post input[type=checkbox]').on('change', function(e) {
 		var $form = $(this).parent('form').submit();
		e.preventDefault();		
	});
	*/
	$('.publish_post').on('submit', function(e) {
		e.preventDefault();
 		var $form = $(this);
 		$.post($form.attr('action'), $form.serialize(), function(data) {
			$form.prepend(data);
		}, 'json');
	});

})
</script>	