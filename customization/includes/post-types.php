<?php
namespace Boltmedia\Includes\PostTypes;

function GeneratePostTypes() {
	//GET/LOAD ALL FUNCTION FILES @ 'post-types' DIRECTORY
	$files = glob( get_template_directory().'/customization/includes/post-types/' . "*.php");
	foreach($files as $file): 
		require $file; 
	endforeach;
}