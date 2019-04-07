<?php
define( 'WP_USE_THEMES', false ); // Don't load theme support functionality
require( $_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );

//GET/LOAD ALL FUNCTION FILES @ 'functions' DIRECTORY
$files = glob( $_SERVER['DOCUMENT_ROOT'].'wp-content/uploads/member_badges/' . "*.pdf");

ob_start();
foreach($files as $file){
    $user_id =  str_replace( array($_SERVER['DOCUMENT_ROOT'].'wp-content/uploads/member_badges/user_', '.pdf') , array('',''), $file);

    if( !get_user_by( 'ID', $user_id ) ){
    	ob_flush();
    	unlink( $_SERVER['DOCUMENT_ROOT'].'wp-content/uploads/member_badges/user_'.$user_id.'.pdf' );
    	unlink( $_SERVER['DOCUMENT_ROOT'].'wp-content/uploads/member_badges/user_'.$user_id.'.png' );
    	echo 'User ID: '. $user_id .' does not exist.. deleted the generated png/pdf badges'.'<br>';
    	ob_flush();
    }

}
echo "<h1>All Done with the cleanup!</h1>";
ob_flush();
ob_end_flush(); 