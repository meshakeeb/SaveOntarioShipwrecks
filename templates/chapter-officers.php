<?php
$officers = BoltMediaFront::get_chapter_officers( get_the_ID() );
if ( empty( $officers ) ) {
	return;
}

foreach ( $officers as $officer ) :
	$date_ended = strtotime( get_field( 'date_ended', $officer->post_info->ID ) );
	$is_expired = $date_ended && current_time( 'timestamp' ) > $date_ended ? true : false;

	if ( $is_expired ) {
		continue;
	}
	?>
<div class="get-involved">
	<ul>
		<li class="col-sm-12">
			<div class="item">
				<?php
					echo wp_get_attachment_image(
						get_the_author_meta( 'bolt_profilePic', $officer->data->ID ),
						'thumbnail'
					);
				?>
				<h4>
					<?php echo get_user_meta( $officer->data->ID, 'billing_first_name', true ) . ' ' . get_user_meta( $officer->data->ID, 'billing_last_name', true ); ?>
				</h4>
				<span>
					<?php echo $officer->data->post_info->post_title; ?><br><?php echo $officer->data->user_email; ?>
				</span>
			</div>
		</li>
	</ul>
</div>
<?php endforeach; ?>
