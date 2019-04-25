<?php
$officers = \Ontario\Chapter::get_officers_by_chapter( get_the_ID() );
if ( empty( $officers ) ) {
	return;
}

foreach ( $officers as $officer ) :
	$date_ended = get_field( 'date_ended', $officer->ID );
	$date_ended = strtotime( str_replace( '/', '-', $date_ended ) );
	$is_expired = $date_ended && current_time( 'timestamp' ) > $date_ended ? true : false;

	if ( $is_expired ) {
		continue;
	}

	$user = get_userdata( get_post_meta( $officer->ID, 'member', true ) )
	?>
<div class="get-involved">
	<ul>
		<li class="col-sm-12">
			<div class="item">
				<?php
					echo wp_get_attachment_image(
						$user->bolt_profilePic,
						'thumbnail'
					);
				?>
				<h4>
					<?php echo $user->billing_first_name . ' ' . $user->billing_last_name; ?>
				</h4>
				<span>
					<?php echo $officer->post_title; ?><br><?php echo $user->user_email; ?>
				</span>
			</div>
		</li>
	</ul>
</div>
<?php endforeach; ?>
