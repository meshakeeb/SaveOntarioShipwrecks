<?php
namespace Boltmedia\Includes\Taxonomies;

function GenerateTaxonomy() {
	//GET/LOAD ALL FUNCTION FILES @ 'taxonomies' DIRECTORY
	$files = glob( get_template_directory().'/customization/includes/taxonomies/' . "*.php");
	foreach($files as $file): 
		require $file; 
	endforeach;
}	

