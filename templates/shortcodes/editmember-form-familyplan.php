<?php
/**
 * Family edit member shortcode.
 */

if( !isset($_GET['member_id'])) {
	echo '<h3>ERROR: Invalid Member ID.</h3>';
	return;
}

if ( isset($_POST['submit'] ) ) {
	$reg_errors = new WP_Error;

	// Sanitize user form input.
	$username   = sanitize_user( $_POST['username'] );
	//$password   = esc_attr( $_POST['password'] );
	$email      = sanitize_email( $_POST['email'] );
	$website    = esc_url( $_POST['website'] );
	$first_name = sanitize_text_field( $_POST['fname'] );
	$last_name  = sanitize_text_field( $_POST['lname'] );
	$nickname   = sanitize_text_field( $_POST['nickname'] );
	$bio        = esc_textarea( $_POST['bio'] );


	// Validation.
	if ( empty( $username )  || empty( $email ) ) {
		$reg_errors->add( 'username_email', 'Required form field is missing' );
	}

	if ( 4 > strlen( $username ) ) {
		$reg_errors->add( 'username_length', 'Username too short. At least 4 characters is required' );
	}

	if ( ! is_email( $email ) ) {
		$reg_errors->add( 'email_invalid', 'Email is not valid' );
	}

	if ( ! empty( $website ) && ! filter_var( $website, FILTER_VALIDATE_URL ) ) {
		$reg_errors->add( 'website', 'Website is not a valid URL' );
	}

	if ( 1 > count( $reg_errors->get_error_messages() ) ) {
		$userdata1 = array(
			'ID'          => $_GET['member_id'],
			'user_login'  => $username,
			'user_email'  => $email,
			'user_url'    => $website,
			'first_name'  => $first_name,
			'last_name'   => $last_name,
			'nickname'    => $nickname,
			'description' => $bio
		);

		$user = wp_update_user( $userdata1 );

		echo 'Member updated successfully..';

	} else {
		echo $reg_errors->get_error_messages();
	}
}

$get_userdata = get_userdata( $_GET['member_id'] );
$first_name   = get_user_meta( $_GET['member_id'], 'first_name', true );
$last_name    = get_user_meta( $_GET['member_id'], 'last_name', true );
$nick_name    = get_user_meta( $_GET['member_id'], 'nickname', true );
$description  = get_user_meta( $_GET['member_id'], 'description', true );

?>
<style>
	div {
		margin-bottom:2px;
	}

	input{
		margin-bottom:4px;
	}
</style>
<p>
	Use this form to register family members to your Family Plan. Once registered, your family members will be able to login as a regular SOS chapter member.
</p>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" class="family-form">
	<div>
		<label for="username">Username <strong>*</strong></label>
		<input type="text" name="username" value="<?php echo $get_userdata->user_login; ?>" required>
	</div>

	<div>
		<label for="email">Email <strong>*</strong></label>
		<input type="text" name="email" value="<?php echo $get_userdata->user_email; ?>" required>
	</div>

	<div>
		<label for="website">Website</label>
		<input type="text" name="website" value="<?php echo $get_userdata->user_url; ?>">
	</div>

	<div>
		<label for="firstname">First Name</label>
		<input type="text" name="fname" value="<?php echo $first_name ; ?>" required>
	</div>

	<div>
		<label for="lastname">Last Name</label>
		<input type="text" name="lname" value="<?php echo $last_name; ?>" required>
	</div>

	<div>
		<label for="nickname">Nickname</label>
		<input type="text" name="nickname" value="<?php echo $nick_name; ?>">
	</div>

	<div>
		<label for="bio">About / Bio</label>
		<textarea name="bio"><?php echo $description; ?></textarea>
	</div>

	<input type="submit" name="submit" value="Register"/>

</form>
