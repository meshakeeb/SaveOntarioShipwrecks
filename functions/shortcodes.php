<?php
/**
 * Theme Shortcodes Functions
*/

/*
[column]
[/column]
*/
function theme_columns($atts, $content=null){
    
	extract(shortcode_atts(array(
		"number" => "",
    ), $atts));

	return '
		<div class="col-sm-'.$number.' columns no-padding">
		'.do_shortcode($content).'
		</div>
	';
}

add_shortcode('column', 'theme_columns');

/*
[button]
[/button]
*/
function theme_button($atts, $content=null){
    
	extract(shortcode_atts(array(
		"link" => "",
    ), $atts));

	return '
		<a href="'.$link.'" class="bttn-inline">'.do_shortcode($content).'</a>
	';
}

add_shortcode('button', 'theme_button');

/*
[content]
[/content]
*/
function theme_content($atts, $content=null){
    
	extract(shortcode_atts(array(
		"src" => "",
    ), $atts));

	return '
<div class="about-inner">
    <div class="container">
	   <div class="about-info">
		  <div class="row">
				'.do_shortcode($content).'
            </div>
        </div>	
    </div>
</div>
	';
}

add_shortcode('content', 'theme_content');

/*
[narrow]
[/narrow]
*/
function theme_narrow($atts, $content=null){
    
	extract(shortcode_atts(array(
    ), $atts));

	return '
		<div class="col-md-8 col-md-offset-2">
			'.do_shortcode($content).'
		</div>
	';
}

add_shortcode('narrow', 'theme_narrow');

/*
[image-block]
[/image-block]
*/
function theme_block($atts, $content=null){
    
	extract(shortcode_atts(array(
        "src" => "",
		"side" => "",
    ), $atts));
	
	if ( ($atts["side"] == "left") ) {

	return '
<div class="about-inner">
    <div class="container">
	   <div class="about-info">
		  <div class="row">
				<div class="col-sm-6">
					<img src="'.$src.'" alt="" class="img-full" />
				</div>
				<div class="col-sm-6">
					'.do_shortcode($content).'
				</div>
            </div>
        </div>	
    </div>
</div>
	';
	
	} else {
		
	return '
<div class="about-inner">
    <div class="container">
	   <div class="about-info">
		  <div class="row">
				<div class="col-sm-6">
					'.do_shortcode($content).'
				</div>
				<div class="col-sm-6">
					<img src="'.$src.'" alt="" class="img-full" />
				</div>
            </div>
        </div>	
    </div>
</div>
	';
		
	}
}

add_shortcode('image-block', 'theme_block');

/*
[center]
[/center]
*/
function theme_center($atts, $content=null){
    
	extract(shortcode_atts(array(
		"src" => "",
    ), $atts));

	return '
<div class="text-center">
	'.do_shortcode($content).'
</div>
	';
}

add_shortcode('center', 'theme_center');

/*
[accordion]
[/accordion]
*/
function theme_accordion($atts, $content=null){
	
	extract(shortcode_atts(array(
    ), $atts));

	return '
		<ul class="accordion-wrapper">
		'.do_shortcode($content).'
		</ul>
	';
}

add_shortcode('accordion', 'theme_accordion');

/*
[panel]
[/panel]
*/
function theme_panel($atts, $content=null){
    
	extract(shortcode_atts(array(
		"title" => "",
		"class" => "",
    ), $atts));

	return '
						<li>
							<button class="accordion '.$class.'"><span></span>'.$title.'</button>
							<div class="accordion-panel">
								'.do_shortcode($content).'
							</div>
						</li>
	';
}

add_shortcode('panel', 'theme_panel');

/*
[tabs]
[/tabs]
*/
function theme_tabs($atts, $content=null){
	
	extract(shortcode_atts(array(
    ), $atts));

	return '
		<ul class="nav nav-tabs">
		'.do_shortcode($content).'
		</ul>
	';
}

add_shortcode('tabs', 'theme_tabs');

/*
[tab]
[/tab]
*/
function theme_tab($atts, $content=null){
    
	extract(shortcode_atts(array(
		"id" => "",
		"class" => "",
    ), $atts));

	if ( ($atts["class"] == "active") ) {

	return '
        <li class="'.$class.'"><a data-toggle="tab" href="#'.$id.'">'.do_shortcode($content).'</a></li>
	';
    
    } else {
    
	return '
        <li><a data-toggle="tab" href="#'.$id.'">'.do_shortcode($content).'</a></li>
	';
    
    }
}

add_shortcode('tab', 'theme_tab');

/*
[tab-wrapper]
[/tab-wrapper]
*/
function theme_tabwrapper($atts, $content=null){
	
	extract(shortcode_atts(array(
    ), $atts));

	return '
		<div class="tab-content">
		'.do_shortcode($content).'
		</div>
	';
}

add_shortcode('tab-wrapper', 'theme_tabwrapper');

/*
[tab-content]
[/tab-content]
*/
function theme_tabcontent($atts, $content=null){
    
	extract(shortcode_atts(array(
		"id" => "",
		"class" => "",
    ), $atts));

	return '
        <div id="'.$id.'" class="tab-pane fade '.$class.'">
            '.do_shortcode($content).'
        </div>
	';
}

add_shortcode('tab-content', 'theme_tabcontent');

/*
[clear]
*/
function theme_clear(){

	return '
		<div class="clearfix"></div>
	';
}

add_shortcode('clear', 'theme_clear');

/*
[articles]
*/
function theme_articles() {
	ob_start();
	get_template_part('widgets/articles');
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_shortcode('articles', 'theme_articles');

/*
[lawyers]
*/
function theme_team() {
	ob_start();
	get_template_part('widgets/team');
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_shortcode('lawyers', 'theme_team');

/*
[students]
*/
function theme_students() {
	ob_start();
	get_template_part('widgets/students');
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_shortcode('students', 'theme_students');

/*
[practice]
*/
function theme_practice() {
	ob_start();
	get_template_part('widgets/practice-full');
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_shortcode('practice', 'theme_practice');

?>