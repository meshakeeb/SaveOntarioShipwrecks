<?php
/*-----------------------------------------------------------------------------------*/
/* Admin Interface
/*-----------------------------------------------------------------------------------*/
//$functions_path = THEME_ADMIN . '/';
function siteoptions_add_admin() {

	global $query_string, $themename;
	if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'siteoptions' ) {
		if (isset($_REQUEST['of_save']) && 'reset' == $_REQUEST['of_save']) {
			$options =  get_option('of_template');  //print_r($options);
			of_reset_options($options,'siteoptions');
			header("Location: admin.php?page=siteoptions&reset=true");
			die;
		}
	}

	$tt_page = add_menu_page($themename.' Options', 'Theme Options', 'edit_theme_options', 'siteoptions','siteoptions_options_page');
	//add_action("admin_print_scripts-$tt_page", 'of_load_only');
	//add_action("admin_print_styles-$tt_page",'of_style_only');
}

add_action('admin_menu', 'siteoptions_add_admin');




/*-----------------------------------------------------------------------------------*/
/* Display Portfolio categories function
/*-----------------------------------------------------------------------------------*/
function theme_display_categories($shortname,$page_id) {
	//get selected page_id for portfolio
	$get_custom_options = get_option($shortname.'_portfolio_page_id');
	$get_page_id  = $get_custom_options['portfolio_to_cat_'.$page_id];

	//get category name
	$get_category_name = get_option($shortname.'_portfolio_categories_'.$page_id);

	$output = '';
	$output .= '<select name="portfolio_to_cat_'.$page_id.'" class="of-input" style="height:32px;">';
	$output .= '<option value="0">All Categories</option>';


	//list terms in a given taxonomy (useful as a widget for twentyten)
	$taxonomy = 'portfolio_entries';
	$tax_terms = get_terms($taxonomy);

	foreach ($tax_terms as $tax_term) {
		$selected_option = $tax_term->term_id;
		if ($get_page_id == $selected_option) {
			$output .= '<option selected value="'.$tax_term->term_id.'">'.$tax_term->name.'</option>';
		} else {
			$output .= '<option value="'.$tax_term->term_id.'">'.$tax_term->name.'</option>';
		}
	}

	$output .= '</select>';

	return $output;
}

/*-----------------------------------------------------------------------------------*/
/* Check if is portfolio page template function
/*-----------------------------------------------------------------------------------*/
function theme_is_pagetemplate_portfolio($pagetemplate = '') {
	global $wpdb, $shortname;
	$output = '';
	$output .= '<div><small>To show from all categories select "All Categories"</small></div>';
	$sql = "select post_id from $wpdb->postmeta where meta_key like '_wp_page_template' and meta_value like '" . $pagetemplate . "'";
	$result = $wpdb->get_results($sql);
	foreach ($result as $value){
		$page_id = $value->post_id;
		$page_data = get_page( $page_id );
		$title = $page_data->post_title;
		$output .=  '<div><br />Page <strong>'.$title.'</strong><br />'.theme_display_categories($shortname,$page_id).'</div>';
	}
	wp_reset_query();
	return $output;
}


/*-----------------------------------------------------------------------------------*/
/* Display Blog categories function
/*-----------------------------------------------------------------------------------*/
function theme_display_blog_categories($shortname,$page_id) {

	$get_custom_options = get_option($shortname.'_blog_page_id');
	$get_page_id  = $get_custom_options['blog_to_cat_'.$page_id];
	$cat_option = '<select name="blog_to_cat_'.$page_id.'" class="of-input" style="height:32px;">';
	$cat_option .= '<option value="0">All Categories</option>';
	$categories = get_categories();
	foreach ($categories as $category) {
		$selected_option = $category->term_id;
		if ($get_page_id == $selected_option) {
			$cat_option .= '<option selected value="'.$category->term_id.'">';
		} else {
			$cat_option .= '<option value="'.$category->term_id.'">';
		}
		$cat_option .= $category->cat_name;
		$cat_option .= '</option>';
	}
	$cat_option .= '</select>';

	return $cat_option;
}

/*-----------------------------------------------------------------------------------*/
/* Check if is blog page template function
/*-----------------------------------------------------------------------------------*/
function theme_is_pagetemplate_blog($pagetemplate = '') {
	global $wpdb, $shortname;
	$output_select = '';
	$output_select .= '<div><small>To show from all categories select "All Categories"</small></div>';
	$sql = "select post_id from $wpdb->postmeta where meta_key like '_wp_page_template' and meta_value like '" . $pagetemplate . "'";
	$result = $wpdb->get_results($sql);
	foreach ($result as $value){
		$page_id = $value->post_id;
		$page_data = get_page( $page_id );
		$title = $page_data->post_title;
		$output_select .=  '<div><br />Page <strong>'.$title.'</strong><br />'.theme_display_blog_categories($shortname,$page_id).'</div>';
	}
	wp_reset_query();
	return $output_select;
}






/*-----------------------------------------------------------------------------------*/
/* Display News categories function
/*-----------------------------------------------------------------------------------*/
function theme_display_news_categories($shortname,$page_id) {
	//get selected page_id for news
	$get_custom_options = get_option($shortname.'_news_page_id');
	$get_page_id  = $get_custom_options['news_to_cat_'.$page_id];

	//get category name
	$get_category_name = get_option($shortname.'_news_categories_'.$page_id);

	$output = '';
	$output .= '<select name="news_to_cat_'.$page_id.'" class="of-input" style="height:32px;">';
	$output .= '<option value="0">All Categories</option>';


	//list terms in a given taxonomy (useful as a widget for twentyten)
	$taxonomy = 'news_entries';
	$tax_terms = get_terms($taxonomy);

	foreach ($tax_terms as $tax_term) {
		$selected_option = $tax_term->term_id;
		if ($get_page_id == $selected_option) {
			$output .= '<option selected value="'.$tax_term->term_id.'">'.$tax_term->name.'</option>';
		} else {
			$output .= '<option value="'.$tax_term->term_id.'">'.$tax_term->name.'</option>';
		}
	}

	$output .= '</select>';

	return $output;
}

/*-----------------------------------------------------------------------------------*/
/* Check if is news page template function
/*-----------------------------------------------------------------------------------*/
function theme_is_pagetemplate_news($pagetemplate = '') {
	global $wpdb, $shortname;
	$output = '';
	$output .= '<div><small>To show from all categories select "All Categories"</small></div>';
	$sql = "select post_id from $wpdb->postmeta where meta_key like '_wp_page_template' and meta_value like '" . $pagetemplate . "'";
	$result = $wpdb->get_results($sql);
	foreach ($result as $value){
		$page_id = $value->post_id;
		$page_data = get_page( $page_id );
		$title = $page_data->post_title;
		$output .=  '<div><br />Page <strong>'.$title.'</strong><br />'.theme_display_news_categories($shortname,$page_id).'</div>';
	}
	wp_reset_query();
	return $output;
}




/*-----------------------------------------------------------------------------------*/
/* Display Media categories function
/*-----------------------------------------------------------------------------------*/
function theme_display_media_categories($shortname,$page_id) {
	//get selected page_id for media
	$get_custom_options = get_option($shortname.'_media_page_id');
	$get_page_id  = $get_custom_options['media_to_cat_'.$page_id];

	//get category name
	$get_category_name = get_option($shortname.'_media_categories_'.$page_id);

	$output = '';
	$output .= '<select name="media_to_cat_'.$page_id.'" class="of-input" style="height:32px;">';
	$output .= '<option value="0">All Categories</option>';


	//list terms in a given taxonomy (useful as a widget for twentyten)
	$taxonomy = 'media_entries';
	$tax_terms = get_terms($taxonomy);

	foreach ($tax_terms as $tax_term) {
		$selected_option = $tax_term->term_id;
		if ($get_page_id == $selected_option) {
			$output .= '<option selected value="'.$tax_term->term_id.'">'.$tax_term->name.'</option>';
		} else {
			$output .= '<option value="'.$tax_term->term_id.'">'.$tax_term->name.'</option>';
		}
	}

	$output .= '</select>';

	return $output;
}

/*-----------------------------------------------------------------------------------*/
/* Check if is media page template function
/*-----------------------------------------------------------------------------------*/
function theme_is_pagetemplate_media($pagetemplate = '') {
	global $wpdb, $shortname;
	$output = '';
	$output .= '<div><small>To show from all categories select "All Categories"</small></div>';
	$sql = "select post_id from $wpdb->postmeta where meta_key like '_wp_page_template' and meta_value like '" . $pagetemplate . "'";
	$result = $wpdb->get_results($sql);
	foreach ($result as $value){
		$page_id = $value->post_id;
		$page_data = get_page( $page_id );
		$title = $page_data->post_title;
		$output .=  '<div><br />Page <strong>'.$title.'</strong><br />'.theme_display_media_categories($shortname,$page_id).'</div>';
	}
	wp_reset_query();
	return $output;
}






/*-----------------------------------------------------------------------------------*/
/* Reset Function
/*-----------------------------------------------------------------------------------*/

function of_reset_options($options,$page = ''){

	global $wpdb;
	$query_inner = '';
	$count = 0;

	$excludes = array( 'blogname' , 'blogdescription' );

	foreach($options as $option){
		if(isset($option['id'])){
			$count++;
			$option_id = $option['id'];
			$option_type = $option['type'];

			//Skip assigned id's
			if(in_array($option_id,$excludes)) { continue; }

			if($count > 1){ $query_inner .= ' OR '; }
			if($option_type == 'multicheck'){
				$multicount = 0;
				foreach($option['options'] as $option_key => $option_option){
					$multicount++;
					if($multicount > 1){ $query_inner .= ' OR '; }
					$query_inner .= "option_name = '" . $option_id . "_" . $option_key . "'";

				}

			} else if(is_array($option_type)) {
				$type_array_count = 0;
				foreach($option_type as $inner_option){
					$type_array_count++;
					$option_id = $inner_option['id'];
					if($type_array_count > 1){ $query_inner .= ' OR '; }
					$query_inner .= "option_name = '$option_id'";
				}

			} else {
				$query_inner .= "option_name = '$option_id'";
			}
		}

	}

	//When Theme Options page is reset - Add the of_options option
	if($page == 'siteoptions'){
		$query_inner .= " OR option_name = 'of_options'";
	}

	//echo $query_inner;

	$query = "DELETE FROM $wpdb->options WHERE $query_inner";
	$wpdb->query($query);

}










/*-----------------------------------------------------------------------------------*/
/* Build the Options Page
/*-----------------------------------------------------------------------------------*/

function siteoptions_options_page(){ error_reporting(1);
	$options =  get_option('of_template');
	//$themename =  get_option('of_themename');
	global $themename, $themeversion;
?>

<div class="wrap" id="truethemes_container">
  <div id="of-popup-save" class="of-save-popup">
	<div class="of-save-save">Options Updated</div>
  </div>
  <div id="of-popup-reset" class="of-save-popup">
	<div class="of-save-reset">Options Reset</div>
  </div>
  <form action="" enctype="multipart/form-data" id="ofform" class="yrt">
	<div id="header">
	  <div class="logo">

		<h2 style="width:693px;"><?php echo $themename; ?> v<?php echo $themeversion; ?> / <a href="<?php echo get_template_directory_uri(); ?>/admin/Documentation/index.html" target="_blank">Theme Documentation</a>

			<div style="float:right">
				<img style="display:none;" src="<?php echo get_template_directory_uri() ?>/admin/images/wpspin_light.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
				<input type="submit" value="Save All Changes" class="button-primary" style="height:25px;" />
			</div>
		</h2>
	  </div>
	  <div class="icon-option"> </div>
	  <div class="clear"></div>
	</div>
	<?php
		// Rev up the Options Machine
		$return = siteoptions_machine($options);
		?>
   <div id="main">
	  <div id="of-nav">
		<ul>
		  <?php echo $return[1] ?>
		</ul>
	  </div>
	  <div id="content"> <?php echo $return[0]; /* Settings */ ?> </div>
	  <div class="clear"></div>
	</div>
	<div class="save_bar_top">
	  <img style="display:none;" src="<?php echo get_template_directory_uri() ?>/admin/images/wpspin_light.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
	  <input type="submit" value="Save All Changes" class="button-primary" style="height:25px;" />
  </form>
  <form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="post" style="display:inline" id="ofform-reset">
	<span class="submit-footer-reset">
	<input name="reset" type="submit" value="Reset Options" class="button submit-button reset-button" onclick="return confirm('CAUTION: Any and all settings will be lost! Click OK to reset.');" />
	<input type="hidden" name="of_save" value="reset" />
	</span>
  </form>
</div>
<?php  if (!empty($update_message)) echo $update_message; ?>
<div style="clear:both;"></div>
</div>
<!--wrap-->
<?php
}








/*-----------------------------------------------------------------------------------*/
/* Load required styles for Options Page
/*-----------------------------------------------------------------------------------*/

function of_style_only() {
	wp_enqueue_style('admin-style', get_template_directory_uri().'/admin/admin-style.css');
	wp_enqueue_style('color-picker', get_template_directory_uri().'/admin/colorpicker.css');
	$color = get_user_option('admin_color');
	if ($color == "fresh")
		{
		wp_enqueue_style('admin-style-grey', get_template_directory_uri().'/admin/admin-style-grey.css');
		wp_enqueue_style('color-picker', get_template_directory_uri().'/admin/colorpicker.css');
		}
}
add_action('admin_init', 'of_style_only');





/*-----------------------------------------------------------------------------------*/
/* Load required javascripts for Options Page
/*-----------------------------------------------------------------------------------*/

add_action('admin_init', 'of_load_only');
function of_load_only() {

	add_action('admin_head', 'of_admin_head');

	wp_enqueue_script('jquery-ui-core');
	wp_register_script('jquery-input-mask', get_template_directory_uri().'/admin/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ), '1.2.2', true);
	wp_enqueue_script('jquery-input-mask');
	wp_enqueue_script('color-picker', get_template_directory_uri().'/admin/js/colorpicker.js', array('jquery'), '', true);
	wp_enqueue_script('ajaxupload', get_template_directory_uri().'/admin/js/ajaxupload.js', array('jquery'), '', true);

	function of_admin_head() {

		if ( ! isset( $_GET['page'] ) || 'siteoptions' !== $_GET['page'] ) {
			return;
		}

	?>

<script type='text/javascript' src='http://dev.boltmedia.ca/ericksons/wp/wp-content/themes/ericksons/admin/js/jquery.maskedinput-1.2.2.js?ver=1.2.2'></script>
<script type='text/javascript' src='http://dev.boltmedia.ca/ericksons/wp/wp-content/themes/ericksons/admin/js/colorpicker.js?ver=4.7.5'></script>
<script type='text/javascript' src='http://dev.boltmedia.ca/ericksons/wp/wp-content/themes/ericksons/admin/js/ajaxupload.js?ver=4.7.5'></script>
<script type='text/javascript' src='http://dev.boltmedia.ca/ericksons/wp/wp-content/plugins/wordpress-seo/js/dist/wp-seo-admin-global-471.min.js?ver=4.7.1'></script>

<script type="text/javascript" language="javascript">
//cooment
		jQuery(document).ready(function(){

		// Race condition to make sure js files are loaded
		if (typeof AjaxUpload != 'function') {
			return ++counter < 6 && window.setTimeout(init, counter * 500);
		}

			//Color Picker
			<?php $options = get_option('of_template');

			foreach($options as $option){

			if (isset($option['type'])) {
			  if( ($option['type'] == 'color') || ($option['type'] == 'typography') || ($option['type'] == 'border') ){
				if($option['type'] == 'typography' OR $option['type'] == 'border'){
					$option_id = $option['id'];
					$temp_color = get_option($option_id);
					$option_id = $option['id'] . '_color';
					$color = $temp_color['color'];
				}
				else {
					$option_id = $option['id'];
					$color = get_option($option_id);
				}
				?>
				 jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '<?php echo $color; ?>');
				 jQuery('#<?php echo $option_id; ?>_picker').ColorPicker({
					color: '<?php echo $color; ?>',
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						//jQuery(this).css('border','1px solid red');
						jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '#' + hex);
						jQuery('#<?php echo $option_id; ?>_picker').next('input').attr('value','#' + hex);

					}
				  });
			  <?php } } } ?>

		});

		</script>

		<?php
		//AJAX Upload
		?>
<script type="text/javascript">
			jQuery(document).ready(function(){

				var i = 0;
				jQuery('#of-nav li a').attr('id', function() {
				   i++;
				   return 'item'+i;
				});


			var flip = 0;

			jQuery('#expand_options').click(function(){
				if(flip == 0){
					flip = 1;
					jQuery('#truethemes_container #of-nav').hide();
					jQuery('#truethemes_container #content').width(755);
					jQuery('#truethemes_container .group').add('#truethemes_container .group h2').show();

					jQuery(this).text('[-]');

				} else {
					flip = 0;
					jQuery('#truethemes_container #of-nav').show();
					jQuery('#truethemes_container #content').width(579);
					jQuery('#truethemes_container .group').add('#truethemes_container .group h2').hide();
					jQuery('#truethemes_container .group:first').show();
					jQuery('#truethemes_container #of-nav li').removeClass('current');
					jQuery('#truethemes_container #of-nav li:first').addClass('current');

					jQuery(this).text('[+]');

				}

			});

				jQuery('.group').hide();
				jQuery('.group:first').fadeIn();

				jQuery('.group .collapsed').each(function(){
					jQuery(this).find('input:checked').parent().parent().parent().nextAll().each(
						function(){
							   if (jQuery(this).hasClass('last')) {
								   jQuery(this).removeClass('hidden');
								   return false;
							   }
							   jQuery(this).filter('.hidden').removeClass('hidden');
						   });
				   });

				jQuery('.group .collapsed input:checkbox').click(unhideHidden);

				function unhideHidden(){
					if (jQuery(this).attr('checked')) {
						jQuery(this).parent().parent().parent().nextAll().removeClass('hidden');
					}
					else {
						jQuery(this).parent().parent().parent().nextAll().each(
							function(){
								   if (jQuery(this).filter('.last').length) {
									   jQuery(this).addClass('hidden');
									return false;
								   }
								   jQuery(this).addClass('hidden');
							   });

					}
				}

				jQuery('.of-radio-img-img').click(function(){
					jQuery(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
					jQuery(this).addClass('of-radio-img-selected');

				});
				jQuery('.of-radio-img-label').hide();
				jQuery('.of-radio-img-img').show();
				jQuery('.of-radio-img-radio').hide();
				jQuery('#of-nav li:first').addClass('current');
				jQuery('#of-nav li a').click(function(evt){

						jQuery('#of-nav li').removeClass('current');
						jQuery(this).parent().addClass('current');

						var clicked_group = jQuery(this).attr('href');

						jQuery('.group').hide();

							jQuery(clicked_group).fadeIn();

						evt.preventDefault();

					});

				if('<?php if(isset($_REQUEST['reset'])) { echo $_REQUEST['reset'];} else { echo 'false';} ?>' == 'true'){

					var reset_popup = jQuery('#of-popup-reset');
					reset_popup.fadeIn();
					window.setTimeout(function(){
						   reset_popup.fadeOut();
						}, 2000);
						//alert(response);

				}

			//Update Message popup
			jQuery.fn.center = function () {
				this.animate({"top":( jQuery(window).height() - this.height() - 200 ) / 2+jQuery(window).scrollTop() + "px"},100);
				this.css("left", 250 );
				return this;
			}


			jQuery('#of-popup-save').center();
			jQuery('#of-popup-reset').center();
			jQuery(window).scroll(function() {

				jQuery('#of-popup-save').center();
				jQuery('#of-popup-reset').center();

			});



			//AJAX Upload
			jQuery('.image_upload_button').each(function(){

			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');
			new AjaxUpload(clickedID, {
				  action: '<?php echo admin_url("admin-ajax.php"); ?>',
				  name: clickedID, // File upload name
				  data: { // Additional data to send
						action: 'of_ajax_post_action',
						type: 'upload',
						data: clickedID },
				  autoSubmit: true, // Submit file after selection
				  responseType: false,
				  onChange: function(file, extension){},
				  onSubmit: function(file, extension){
						clickedObject.text('Uploading'); // change button text, when user selects file
						this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
						interval = window.setInterval(function(){
							var text = clickedObject.text();
							if (text.length < 13){	clickedObject.text(text + '.'); }
							else { clickedObject.text('Uploading'); }
						}, 200);
				  },
				  onComplete: function(file, response) {

					window.clearInterval(interval);
					clickedObject.text('Upload Image');
					this.enable(); // enable upload button

					// If there was an error
					if(response.search('Upload Error') > -1){
						var buildReturn = '<span class="upload-error">' + response + '</span>';
						jQuery(".upload-error").remove();
						clickedObject.parent().after(buildReturn);

					}
					else{
						var buildReturn = '<img class="hide of-option-image" id="image_'+clickedID+'" src="'+response+'" alt="" />';

						jQuery(".upload-error").remove();
						jQuery("#image_" + clickedID).remove();
						clickedObject.parent().after(buildReturn);
						jQuery('img#image_'+clickedID).fadeIn();
						clickedObject.next('span').fadeIn();
						clickedObject.parent().prev('input').val(response);
					}
				  }
				});

			});

			//AJAX Remove (clear option value)
			jQuery('.image_reset_button').click(function(){

					var clickedObject = jQuery(this);
					var clickedID = jQuery(this).attr('id');
					var theID = jQuery(this).attr('title');

					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';

					var data = {
						action: 'of_ajax_post_action',
						type: 'image_reset',
						data: theID
					};

					jQuery.post(ajax_url, data, function(response) {
						var image_to_remove = jQuery('#image_' + theID);
						var button_to_hide = jQuery('#reset_' + theID);
						image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });
						button_to_hide.fadeOut();
						clickedObject.parent().prev('input').val('');



					});

					return false;

				});




/* Top save button
jQuery(document).ready( function(){
  // bind "click" event for links with title="submit"
  jQuery("a[title=submit]").click( function(){
	// it submits the form it is contained within
	jQuery(this).parents("form").submit();
  });
}); */


			//Save everything else
			jQuery('#ofform').submit(function(){

					function newValues() {
					  var serializedValues = jQuery("#ofform").serialize();
					  return serializedValues;
					}
					jQuery(":checkbox, :radio").click(newValues);
					jQuery("select").change(newValues);
					jQuery('.ajax-loading-img').fadeIn();
					var serializedReturn = newValues();

					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';

					 //var data = {data : serializedReturn};
					var data = {
						<?php if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'siteoptions'){ ?>
						type: 'options',
						<?php } ?>

						action: 'of_ajax_post_action',
						data: serializedReturn
					};

					jQuery.post(ajax_url, data, function(response) {
						var success = jQuery('#of-popup-save');
						var loading = jQuery('.ajax-loading-img');
						loading.fadeOut();
						success.fadeIn();
						window.setTimeout(function(){
						   success.fadeOut();


						}, 2000);
					});

					return false;

				});

			});
		</script>
<?php }
}











/*-----------------------------------------------------------------------------------*/
/* Ajax Save Action
/*-----------------------------------------------------------------------------------*/

add_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');

function of_ajax_callback() {
	global $wpdb, $shortname; // this is how you get access to the database


	$save_type = $_POST['type'];
	//Uploads
	if($save_type == 'upload'){

		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
		   $filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']);

		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';
		$uploaded_file = wp_handle_upload($filename,$override);

				$upload_tracking[] = $clickedID;
				update_option( $clickedID , $uploaded_file['url'] );

		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }
		 else { echo $uploaded_file['url']; } // Is the Response
	}
	elseif($save_type == 'image_reset'){

			$id = $_POST['data']; // Acts as the name
			$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
			$wpdb->query($query);

	}
	elseif ($save_type == 'options' OR $save_type == 'framework') {
		$data = $_POST['data'];

		parse_str($data,$output);
		//print_r($output);

		//Pull options
		$options = get_option('of_template');

		foreach($options as $option_array){

			$id = $option_array['id'];
			$old_value = get_option($id);
			$new_value = '';

			if(isset($output[$id])){
				$new_value = $output[$option_array['id']];
			}

			//if ( preg_match("/blog_to_cat_/", $id) ) {
				//$blog_options[] = $output[$option_array['id']];
			//}
			/*$portfolio_options = $option_array['options'];
			$sidebar_options = $option_array['options'];*/

			if(isset($option_array['id'])) { // Non - Headings...

				$type = $option_array['type'];

				if ( is_array($type)){
					foreach($type as $array){
						if($array['type'] == 'text'){
							$id = $array['id'];
							$std = $array['std'];
							$new_value = $output[$id];
							if($new_value == ''){ $new_value = $std; }
							update_option( $id, stripslashes($new_value));
						}
					}
				}
				elseif($new_value == '' && $type == 'checkbox'){ // Checkbox Save

					update_option($id,'false');
				}
				elseif ($new_value == 'true' && $type == 'checkbox'){ // Checkbox Save

					update_option($id,'true');
				}
				elseif($type == 'multicheck'){ // Multi Check Save

					$option_options = $option_array['options'];

					foreach ($option_options as $options_id => $options_value){

						$multicheck_id = $id . "_" . $options_id;

						if(!isset($output[$multicheck_id])){
						  update_option($multicheck_id,'false');
						}
						else{
						   update_option($multicheck_id,'true');
						}
					}
				}

				elseif($type != 'upload_min'){

					update_option($id,stripslashes($new_value));
				}
			}
		}




	}




	$data = $_POST['data'];
	parse_str($data,$custom_output);
	// Update option 'portfolio_page_id' Portfolio ID to Category for unlimited portfolio subcategories
	foreach ($custom_output as $key => $value)
	{
		if ( preg_match("/portfolio_to_cat_/", $key) ) {
			if ($value != '') $portfolio_items[$key] = $value;
		}
		delete_option( $shortname.'_portfolio_page_id');
		update_option( $shortname.'_portfolio_page_id', $portfolio_items);

		if ( preg_match("/news_to_cat_/", $key) ) {
			if ($value != '') $news_items[$key] = $value;
		}
		delete_option( $shortname.'_news_page_id');
		update_option( $shortname.'_news_page_id', $news_items);

		if ( preg_match("/media_to_cat_/", $key) ) {
			if ($value != '') $media_items[$key] = $value;
		}
		delete_option( $shortname.'_media_page_id');
		update_option( $shortname.'_media_page_id', $media_items);

	}
	// Update option 'blog_page_id' Blog Post ID to Category for unlimited Blog Pages
	foreach ($custom_output as $key => $value)
	{
		if ( preg_match("/blog_to_cat_/", $key) ) {
			if ($value != '') $blog_items[$key] = $value;
		}
		delete_option( $shortname.'_blog_page_id');
		update_option( $shortname.'_blog_page_id', $blog_items);
	}
	/* Updates custom sidebars */
	$imagesCount = 0;
	foreach ($custom_output as $key => $value)
	{
		if ( preg_match("/sidebars_cp_url_/", $key) )
		{
			if ($value != '') $imagesCount = $imagesCount +1;
		}
	}
	foreach ($custom_output as $key => $value)
	{
		if ( preg_match("/sidebars_cp_url_/", $key) )
		{
			if ($value != '') $options_slider_custom[$key] = $value;
		}

		$options_slider_custom['sidebarsCount'] = $imagesCount;

		delete_option( $shortname.'_sidebars_cp');
		update_option( $shortname.'_sidebars_cp', $options_slider_custom);
	}



  die();

}



/*-----------------------------------------------------------------------------------*/
/* Cases fpr various option types
/*-----------------------------------------------------------------------------------*/

function siteoptions_machine($options) {
	 //echo '<pre>'; print_r($options);  echo '</pre>';
	 global $shortname;

	$counter = 0;
	$menu = '';
	$output = '';
	foreach ($options as $value) {

		$counter++;
		$val = '';

		//Start Heading
		if( isset($value['type'])) {
			if ( $value['type'] != "heading" )
			{
				$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
				//$output .= '<div class="section section-'. $value['type'] .'">'."\n".'<div class="option-inner">'."\n";
				$output .= '<div class="section section-'.$value['type'].' '. $class .'">'."\n";
				$output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";
				$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";

			 }
		}

		//End Heading
		if( isset($value['type'])) {
			$select_value = '';
			switch ( $value['type'] ) {

			case 'text':
				$val = $value['std'];
				$std = get_option($value['id']);
				if ( $std != "") { $val = $std; }
				$output .= '<input class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $val .'" />';
			break;






			case 'select':

				$output .= '<select class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';

				$select_value = get_option($value['id']);

				foreach ($value['options'] as $option) {

					$selected = '';

					 if($select_value != '') {
						 if ( $select_value == $option) { $selected = ' selected="selected"';}
					 } else {
						 if ( isset($value['std']) )
							 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
					 }

					 $output .= '<option'. $selected .'>';
					 $output .= $option;
					 $output .= '</option>';

				 }
				 $output .= '</select>';


			break;






			case 'fontsize':

			/* Font Size */
				$val = $default['size'];
				if ( $typography_stored['size'] != "") { $val = $typography_stored['size']; }
				$output .= '<select class="of-typography of-typography-size" name="'. $value['id'].'_size" id="'. $value['id'].'_size">';
					for ($i = 9; $i < 71; $i++){
						if($val == $i){ $active = 'selected="selected"'; } else { $active = ''; }
						$output .= '<option value="'. $i .'" ' . $active . '>'. $i .'px</option>'; }
				$output .= '</select>';


			break;







			case "multicheck":

				$std =  $value['std'];

				foreach ($value['options'] as $key => $option) {

				$tt_key = $value['id'] . '_' . $key;
				$saved_std = get_option($tt_key);

				if(!empty($saved_std))
				{
					  if($saved_std == 'true'){
						 $checked = 'checked="checked"';
					  }
					  else{
						  $checked = '';
					  }
				}
				elseif( $std == $key) {
				   $checked = 'checked="checked"';
				}
				else {
					$checked = '';                                                                                    }
				$output .= '<input type="checkbox" class="checkbox of-input" name="'. $tt_key .'" id="'. $tt_key .'" value="true" '. $checked .' /><label for="'. $tt_key .'">'. $option .'</label><br />';

				}
			break;








			case 'textarea':

				$cols = '8';
				$ta_value = '';

				if(isset($value['std'])) {

					$ta_value = $value['std'];

					if(isset($value['options'])){
						$ta_options = $value['options'];
						if(isset($ta_options['cols'])){
						$cols = $ta_options['cols'];
						} else { $cols = '8'; }
					}

				}
					$std = get_option($value['id']);
					if( $std != "") { $ta_value = stripslashes( $std ); }
					$output .= '<textarea class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';


			break;








			case "radio":

				 $select_value = get_option( $value['id']);

				 foreach ($value['options'] as $key => $option)
				 {

					 $checked = '';
					   if($select_value != '') {
							if ( $select_value == $key) { $checked = ' checked'; }
					   } else {
						if ($value['std'] == $key) { $checked = ' checked'; }
					   }
					$output .= '<input class="of-input of-radio" type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' /><label style="float:left; width:100px;">' . $option .'</label><br />';

				}

			break;









			case "checkbox":

			   $std = $value['std'];

			   $saved_std = get_option($value['id']);

			   $checked = '';

				if(!empty($saved_std)) {
					if($saved_std == 'true') {
					$checked = 'checked="checked"';
					}
					else{
					   $checked = '';
					}
				}
				elseif( $std == 'true') {
				   $checked = 'checked="checked"';
				}
				else {
					$checked = '';
				}
				$output .= '<input type="checkbox" class="checkbox of-input" name="'.  $value['id'] .'" id="'. $value['id'] .'" value="true" '. $checked .' />';

			break;








			case "upload":

				$output .= siteoptions_uploader_function($value['id'],$value['std'],null);

			break;









			case "upload_min":

				$output .= siteoptions_uploader_function($value['id'],$value['std'],'min');

			break;
			case "color":
				$val = $value['std'];
				$stored  = get_option( $value['id'] );
				if ( $stored != "") { $val = $stored; }
				$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div></div></div>';
				$output .= '<input class="of-color" name="'. $value['id'] .'" id="'. $value['id'] .'" type="text" value="'. $val .'" />';
			break;









			case "images":
				$i = 0;
				$select_value = get_option( $value['id']);

				foreach ($value['options'] as $key => $option)
				 {
				 $i++;

					 $checked = '';
					 $selected = '';
					   if($select_value != '') {
							if ( $select_value == $key) { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
						} else {
							if ($value['std'] == $key) { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
							elseif ($i == 1  && !isset($select_value)) { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
							elseif ($i == 1  && $value['std'] == '') { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
							else { $checked = ''; }
						}

					$output .= '<span>';
					$output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="'.$key.'" name="'. $value['id'].'" '.$checked.' />';
					$output .= '<div class="of-radio-img-label">'. $key .'</div>';
					$output .= '<img src="'.$option.'" alt="" class="of-radio-img-img '. $selected .'" onClick="document.getElementById(\'of-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
					$output .= '</span>';

				}

			break;








			case "info":
				$default = $value['std'];
				$output .= $default;
			break;

			case "link":
				$link_desc = $value['link_desc'];
				$link_url = $value['link'];
				$output .= '<a href="'.$link_url.'" target="_blank">'.$link_desc.'</a><br />';
			break;

			case "custom_sidebars_panel":
			$output .= '<table class="slider-box" id="demo">
				<thead>
				<tr>
					<th style="text-align:left;width:10%;">N.&nbsp;&nbsp;&nbsp;</th>
					<th style="text-align:left;width:90%;">Sidebar Name</th>

				</tr>
				</thead>
				<tbody>';

				$get_custom_options = get_option($shortname.'_sidebars_cp');
				$get_custom_options['sidebarsCount'];
				$m = 0;
				for($i = 1; $i <= $get_custom_options['sidebarsCount']; $i++)
				{
					if ($get_custom_options[$shortname.'_sidebars_cp_url_'.$i])
					{
						$output .= '
						<tr class="sidebars" rel="sidebar_'.($m+1).'"><td>'.($m+1).'</td>
						<td><input name="'.$value['id'].'_url_'.($m+1).'" id="'.$value['id'].'_url_'.($m+1).'"
							type="text" value="'.$get_custom_options[$shortname.'_sidebars_cp_url_'.$i].'"></td>
						</tr>
						';
						$m = $m + 1;
					}
				}

				$output .= '<p>'.$value['desc'].'</p>
				<p>
					<input type="button" value="Add New Sidebar" onclick="addRowToTable();" />
				</p>
			</tbody>
			</table>';
			break;



			case "portfolio_add_cats":
			$output .= theme_is_pagetemplate_portfolio('template-portfolio%');
			break;

			case "blog_add_cats":
			$output .= theme_is_pagetemplate_blog('template-blog%');
			break;

			case "news_add_cats":
			$output .= theme_is_pagetemplate_news('template-news%');
			break;

			case "media_add_cats":
			$output .= theme_is_pagetemplate_media('template-media%');
			break;




			case "heading":

				if($counter >= 2){
				   $output .= '</div>'."\n";
				}
				$jquery_click_hook = preg_replace("[^A-Za-z0-9]", "", strtolower($value['name']) );
				$jquery_click_hook = "of-option-" . $jquery_click_hook;
								if($jquery_click_hook=='of-option-social media'){ $jquery_click_hook='of-option-social'; }
				$menu .= '<li><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
				$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
			break;
			}

			// if TYPE is an array, formatted into smaller inputs... ie smaller values
			if ( is_array($value['type'])) {
				foreach($value['type'] as $array){

						$id = $array['id'];
						$std = $array['std'];
						$saved_std = get_option($id);
						if($saved_std != $std){$std = $saved_std;}
						$meta = $array['meta'];

						if($array['type'] == 'text') { // Only text at this point

							 $output .= '<input class="input-text-small of-input" name="'. $id .'" id="'. $id .'" type="text" value="'. $std .'" />';
							 $output .= '<span class="meta-two">'.$meta.'</span>';
						}
					}
			}
			if ( $value['type'] != "heading" ) {
				if ( $value['type'] != "checkbox" ) {
					//$output .= '<br/>';
				}
				if(!isset($value['desc'])){
					$explain_value = '';
				} else {
						if ($value['type'] != 'custom_sidebars_panel') { $explain_value = $value['desc']; } else { $explain_value = ''; }
				}

				$output .= '</div><div class="explain">'. $explain_value .'</div>'."\n";
				$output .= '<div class="clear"> </div></div></div>'."\n";
			}
		}

	}
	$output .= '</div>';
	return array($output,$menu);

}










/*-----------------------------------------------------------------------------------*/
/* File Uploading
/*-----------------------------------------------------------------------------------*/

function siteoptions_uploader_function($id,$std,$mod){

	$uploader = '';
	$upload = get_option($id);

	if($mod != 'min') {
			$val = $std;
			if ( get_option( $id ) != "") { $val = get_option($id); }
			$uploader .= '<input class="of-input" name="'. $id .'" id="'. $id .'_upload" type="text" value="'. $val .'" />';
	}

	$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">Upload Image</span>';

	if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}

	$uploader .= '<span class="button image_reset_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
	$uploader .='</div>' . "\n";
	$uploader .= '<div class="clear"></div>' . "\n";
	if(!empty($upload)){
		$uploader .= '<a class="of-uploaded-image" href="'. $upload . '">';
		$uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
		$uploader .= '</a>';
		}
	$uploader .= '<div class="clear"></div>' . "\n";


return $uploader;
}

?>
