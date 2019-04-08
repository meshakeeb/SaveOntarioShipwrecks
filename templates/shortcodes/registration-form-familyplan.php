<?php
/**
 * Family registration member shortcode.
 */

$current_member = get_current_user_id();
$chapter        = absint( get_user_meta( $current_member, 'chapter', true ) );

if ( isset( $_POST['submit'] ) ) {
	$reg_errors = new WP_Error;

	// Sanitize user form input.
	$username   = sanitize_user( $_POST['username'] );
	$password   = esc_attr( $_POST['password'] );
	$email      = sanitize_email( $_POST['email'] );
	$website    = esc_url( $_POST['website'] );
	$first_name = sanitize_text_field( $_POST['first_name'] );
	$last_name  = sanitize_text_field( $_POST['last_name'] );
	$nickname   = sanitize_text_field( $_POST['nickname'] );
	$bio        = esc_textarea( $_POST['bio'] );

	// Validation.
	if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
		$reg_errors->add( 'field', 'Required form field is missing' );
	}

	if ( 4 > strlen( $username ) ) {
		$reg_errors->add( 'username_length', 'Username too short. At least 4 characters is required' );
	}

	if ( username_exists( $username ) ) {
		$reg_errors->add( 'user_name', 'Sorry, that username already exists!' );
	}

	if ( ! is_email( $email ) ) {
		$reg_errors->add( 'email_invalid', 'Email is not valid' );
	}

	if ( email_exists( $email ) ) {
		$reg_errors->add( 'email', 'Email Already in use' );
	}

	if ( ! empty( $website ) && ! filter_var( $website, FILTER_VALIDATE_URL ) ) {
		$reg_errors->add( 'website', 'Website is not a valid URL' );
	}

	if ( 1 > count( $reg_errors->get_error_messages() ) ) {
		$userdata = array(
			'user_login'  => $username,
			'user_email'  => $email,
			'role'        => 'bolt_chapter_member',
			'user_pass'   => $password,
			'user_url'    => $website,
			'first_name'  => $first_name,
			'last_name'   => $last_name,
			'nickname'    => $nickname,
			'description' => $bio,
		);

		$user = wp_insert_user( $userdata );

		update_user_meta( $user, 'chapter', $chapter );
		update_user_meta( $user, 'billing_first_name', $first_name );
		update_user_meta( $user, 'billing_last_name', $last_name );

		// Get subscription plan.
		$current_member       = get_current_user_id();
		$member_subscriptions = pms_get_member_subscriptions( array( 'user_id' => $current_member ) );
		$subscription_plan    = pms_get_subscription_plan( $member_subscriptions[0]->subscription_plan_id );
		$subscription_data    = array(
			'user_id'              => $user,
			'subscription_plan_id' => $subscription_plan->id,
			'expiration_date'      => $subscription_plan->get_expiration_date(),
			'status'               => $member_subscriptions[0]->status,
			'start_date'           => $member_subscriptions[0]->start_date,
		);

		$member_subscription = new PMS_Member_Subscription();
		$inserted            = $member_subscription->insert( $subscription_data );

		add_user_meta( $user, 'family_plan_member', '1' );
		add_user_meta( $user, 'parent_family_id', $current_member );
		$u = new WP_User( $user );
		add_user_meta( $current_member, 'parent_id', '1' );

		$family    = get_option( 'email_family' );
		$user_info = get_userdata( $current_member );

		$headers  = null;
		$headers .= 'From: Save Ontario Shipwrecks <wordpress@saveontarioshipwrecks.ca>' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$filter_search  = array( '{parent_name}', '{name}', '{member_login}', '{member_pass}' );
		$filter_replace = array( get_user_meta( $current_member, 'billing_first_name', true ), get_user_meta( $user, 'billing_first_name', true ), $username, $password );

		$title   = str_replace( $filter_search, $filter_replace, $family['title'] );
		$content = str_replace( $filter_search, $filter_replace, $family['content'] );

		wp_mail( $email, $title, wpautop( $content ), $headers );
		echo 'Family Member  Added.';
	} else {
		echo $reg_errors->get_error_messages();
	}
}
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
	<input type="hidden" name="chapter" value="<?php echo $chapter; ?>" readonly="1">

	<div>
		<label for="username">Username <strong>*</strong></label>
		<input type="text" name="username" value="<?php echo ! empty( $_POST ) ? $username : ''; ?>" required>
	</div>

	<div>
		<label for="username">Password <strong>*</strong></label>
		<input type="text" name="password" value="<?php echo ! empty( $_POST ) ? $password : ''; ?>" required>
	</div>

	<div>
		<label for="email">Email <strong>*</strong></label>
		<input type="text" name="email" value="<?php echo ! empty( $_POST ) ? $email : ''; ?>" required>
	</div>

	<div>
		<label for="website">Website</label>
		<input type="text" name="website" value="<?php echo ! empty( $_POST ) ? $website : ''; ?>">
	</div>

	<div>
		<label for="firstname">First Name</label>
		<input type="text" name="first_name" value="<?php echo ! empty( $_POST ) ? $first_name : ''; ?>" required>
	</div>

	<div>
		<label for="lastname">Last Name</label>
		<input type="text" name="last_name" value="<?php echo ! empty( $_POST ) ? $last_name : ''; ?>" required>
	</div>

	<div>
		<label for="nickname">Nickname</label>
		<input type="text" name="nickname" value="<?php echo ! empty( $_POST ) ? $nick_name : ''; ?>">
	</div>

	<div>
		<label for="bio">About / Bio</label>
		<textarea name="bio"><?php echo ! empty( $_POST ) ? $bio : ''; ?></textarea>
	</div>

	<input type="submit" name="submit" value="Register"/>

</form>
