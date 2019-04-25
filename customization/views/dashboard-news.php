<?php
wp_enqueue_media();

// Delete news.
$delete_id = isset( $_GET['delete_id'] ) ? absint( $_GET['delete_id'] ) : 0;
if ( $delete_id > 0 ) {
	wp_delete_post( $delete_id, true );
}
?>
<div class="form-block">

	<form method="post" id="add_news">

		<p>
			<input type="text" name="post_title" value="" class="form-control" placeholder="Content Title">
		</p>

		<p>
			<span id="j_photo" style="display:block"></span>
		</p>

		<input type="hidden" name="j_photo" class="j_photo" />

		<button class="btn btn-default featuredUpload" style="cursor: pointer">Add Featured Image</button>

		<p>&nbsp;</p>

		<?php
		if (
			$user_info->has_cap( 'provincial_membership' ) ||
			$user_info->has_cap( 'administrator' ) ||
			$user_info->has_cap( 'board' )
		) :
			?>

		<p>
			<strong>Type of content:</strong>
			<input type="hidden" name="post_type" value="">
			<label class="col-sm-12" style="font-weight: normal"><input type="radio" name="content_type" value="news"> &nbsp; News</label>
			<label class="col-sm-12" style="font-weight: normal"><input type="radio" name="content_type" value="post"> &nbsp; Chapter Post</label>
		</p>

		<p>&nbsp;</p>

		<p>
			<label>Category</label>
			<?php
			wp_dropdown_categories(
				array(
					'show_option_all'   => '',
					'show_option_none'  => '',
					'option_none_value' => '-- Select Category --',
					'orderby'           => 'name',
					'order'             => 'ASC',
					'show_count'        => 0,
					'hide_empty'        => 0,
					'child_of'          => 0,
					'exclude'           => '',
					'include'           => '',
					'echo'              => 1,
					'selected'          => 0,
					'hierarchical'      => 0,
					'name'              => 'post_category',
					'id'                => '',
					'class'             => 'form-control',
					'depth'             => 0,
					'tab_index'         => 0,
					'taxonomy'          => 'category',
					'hide_if_empty'     => false,
					'value_field'       => 'name',
				)
			);
			?>
		</p>
		<?php else : ?>
		<p>
			<input type="hidden" name="content_type" value="post">
			<input type="hidden" name="post_category" value="<?php echo $category->name; ?>">
		</p>
		<?php endif; ?>

		<div class="clear"></div>
		<?php
		$settings = array(
			'media_buttons' => true,
			'textarea_name' => 'bolt_news',
			'textarea_rows' => get_option( 'default_post_edit_rows', 20 ),
			'tabindex'      => '',
			'teeny'         => true,
			'dfw'           => false,
			'tinymce'       => true,
			'quicktags'     => true,
		);
		wp_editor( '', 'bolt_event', $settings );
		?>

		<input type="hidden" name="userID" value="<?php echo $user_info->ID; ?>">

		<input type="hidden" name="action" value="add_news">

		<?php wp_nonce_field( 'add_event_nonce', 'nonce_field' ); ?>

		<p>&nbsp;</p>

		<p><label>Attachment</label><span id="j_attachment" style="display:block"></span></p>

		<ul class="clonable">
			<li>
				<p>
					<span id="j_attachment_0" class="img_container"></span>
					<input type="hidden" name="j_attachment[]" class="j_attachment_0" value="" />
					<button  class="btn btn-default attachmentUpload" style="cursor: pointer">Upload Attachment</button>
				</p>
			</li>
		</ul>

		<p align="right"><button class="clone_attachment">Add More Attachment</button></p>

		<p><button class="button custom-content-button">Publish</button></p>
	</form>

</div>

<?php
if (
	$user_info->has_cap( 'provincial_membership' ) ||
	$user_info->has_cap( 'administrator' ) ||
	$user_info->has_cap( 'bolt_chapter_editor' ) ||
	$user_info->has_cap( 'edit_posts' )
	) :
	?>
	<div class="form-block">

		<?php
		$should_all    = ( $user_info->has_cap( 'provincial_membership' ) || $user_info->has_cap( 'administrator' ) ) && ! $user_info->has_cap( 'bolt_chapter_editor' );
		$category      = $should_all ? '' : get_the_title( $user_info->data->chapter );
		$heading_title = $should_all ? 'All' : get_the_title( $user_info->data->chapter );
		$products      = get_posts(
			array(
				'posts_per_page'   => -1,
				'offset'           => 0,
				'category_name'    => $category,
				'orderby'          => 'title',
				'order'            => 'ASC',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				'suppress_filters' => true,
				'fields'           => '',
			)
		);
		?>
		<h3><?php echo $heading_title; ?> Chapter News</h3>

		<ul class="list-group">
		<?php
		foreach ( $products as $product ) :
			$delete_url = home_url( 'dashboard/add-news/?delete_id=' );
			?>
			<li class="list-group-item"><?php echo $product->post_title; ?> <a href="<?php echo $delete_url . $product->ID; ?>" class="badge badge-error">Delete</a> <a href="<?php echo get_permalink( $product->ID ); ?>?post=<?php echo $product->ID; ?>" class="badge">Edit</a></li>
		<?php endforeach; ?>
		</ul>

	</div>
<?php endif; ?>

<script>
	function AppendImage( imageUrl, imgDiv ) {
		jQuery("#"+imgDiv).empty().prepend('<img src="'+imageUrl+'" style="width: 150px; height: auto">');
	}

	jQuery(document).ready( function($) {

		$('#insert-media-button').on('click', function(e) {
			wp.media.model.settings.post.id = 0;
		});

		//featured
		jQuery(".featuredUpload").click(function () {
			uploadID = jQuery(this).prev('input');
			var formfield = jQuery('#upload_image').attr('name');
			tb_show('', '<?php echo get_site_url(); ?>/wp-admin/media-upload.php?type=image&amp;TB_iframe=true');
			return false;
		});

		// Attachment
		var attachmentFrame;
		jQuery( '.clonable' ).on( 'click', '.attachmentUpload', function ( event ) {
			event.preventDefault();

			var uploadIDField = jQuery(this).prev('input');

			// Sets up the media library frame
			attachmentFrame = wp.media.frames.metaImageFrame = wp.media({
				title: 'Choose or Upload Media',
				button: { text:  'Use this file' },
			});

			// Runs when an image is selected.
			attachmentFrame.on('select', function() {
				var attachment = attachmentFrame.state().get('selection').first().toJSON();
				var thumbnail = attachment.icon;
				if ( attachment.sizes ) {
					thumbnail = 'thumbnail' in attachment.sizes ? attachment.sizes.thumbnail.url : attachment.url;
				}

				uploadIDField.val( attachment.id );
				AppendImage( thumbnail, uploadIDField.attr('class') );
			});

			// Opens the media library frame.
			attachmentFrame.open();
		});

		// More attachments
		jQuery(".clone_attachment").live( "click", function () {
			var key =  jQuery('.clonable li').length;
			jQuery(".clonable li:last-child").clone().appendTo(".clonable");
			jQuery(".clonable li:last-child input").removeClass().addClass('j_attachment_'+ key ).val("");
			jQuery(".clonable li:last-child .img_container").empty().attr('id', 'j_attachment_'+ key );
			return false;
		});
	})
</script>
