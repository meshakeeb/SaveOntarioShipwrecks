<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php wp_title( '' ); ?></title>

	<link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

	<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/font-awesome/css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/defaults.css">
	<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/js/vendor/lity/lity.min.css">
	<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/js/vendor/mfp/magnific-popup.min.css">
	<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/style.css">


	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<?php
	global $shortname;
	$favicon = get_option( $shortname . '_favicon' );
	if ( $favicon ) {
		?>
	<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
	<?php } ?>

<?php wp_head(); ?>

</head>
