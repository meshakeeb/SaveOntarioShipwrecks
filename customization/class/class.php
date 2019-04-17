<?php
/**
 * SOS Customizations MotherClass
 *
 * @category Null
 * @package  SOS_Customizations
 * @author   Japol <japol69@gmail.com>
 * @license  FREE
 * @link     http://www.boltmedia.ca
 * @
 */

class BoltMedia {

	/**
	 * CREATE USER ROLES
	 **/
	function create_roles() {

		add_role(
			'bolt_chapter_editor',
			'Chapter Editor*',
			array(
				'edit_user' => true,
				'read' => true,
				'edit_posts' => true,
				'edit_others_posts' => true,
				'create_posts' => true,
				'edit_published_posts' =>true,
				'manage_categories' => true,
				'publish_posts' => true,
				'edit_pages' => true,
				'upload_files' => true,
				'send_newsletter' => true,
				'publish_buoy_status' => true,
				'publish_buoy_site' => true,
				'publish_tribe_events' => true,
				'publish_chapters' => true,
				'manage_chapter_members' => true
			)
		);

		add_role(
			'bolt_chapter_member',
			'Chapter Member*',
			array(
				'edit_user' => true,
				'read' => true,
				'edit_posts' => true,
				'create_posts' => true,
				'upload_files' => true
			)
		);
	}

	/**
	 * CREATE EXTRA PROFILE FIELDS
	 * TO TAKE OWNERSHIP OF TITLE
	 **/
	function profile_fields() {
		global $pagenow;

		if (!isset($_GET['user_id'])) {
			$user = wp_get_current_user();
		} else {
			$user = get_userdata($_GET['user_id']);
		}

		if ($user->has_cap('bolt_chapter_editor')
			|| $user->has_cap('activate_plugins')
			|| $user->has_cap('bolt_chapter_member')
			|| current_user_can('administrator')
		) {
			wp_enqueue_style('thickbox');
			wp_enqueue_script('media-upload');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('thickbox');
			require get_theme_file_path().'/customization/views/form.editor.profile.php';
		}
	}

	/***********************
	SAVE CUSTOM PROFILE FIELDS
	************************/
	function save_profile_fields($user_id) {

		global $pagenow;

		if (!current_user_can('edit_user', $user_id) || is_page( array('family-plan') ) ) {
			return false;
		}
		update_user_meta($user_id, 'bolt_profilePic', $_POST['j_photo']);
		update_user_meta($user_id, 'chapter', $_POST['bolt_chapter']);

		if ($pagenow === 'user-new.php') {
			update_user_meta($user_id, 'billing_phone', $_POST['billing_phone']);
			update_user_meta($user_id, 'billing_address_1', $_POST['billing_address_1']);
			update_user_meta($user_id, 'billing_address_2', $_POST['billing_address_2']);
			update_user_meta($user_id, 'billing_city', $_POST['billing_city']);
			update_user_meta($user_id, 'billing_postcode', $_POST['billing_postcode']);
			update_user_meta($user_id, 'billing_country', $_POST['billing_country']);
			update_user_meta($user_id, 'billing_state', $_POST['billing_state']);
			update_user_meta($user_id, 'billing_first_name', $_POST['first_name']);
			update_user_meta($user_id, 'billing_last_name', $_POST['last_name']);
		}
	}

	/***********************
	TEMPLATE FOR AUTO GENERATING
	PAGES
	************************/
	function create_page($title,$page_content,$template,$post_type, $post_parent = null) {
		$new_page_title = $title;
		$new_page_content = $page_content;
		$new_page_template = $template;

		$page_check = get_page_by_title($new_page_title);
		$new_page = array(
				'post_type' => $post_type,
				'post_title' => $new_page_title,
				'post_content' => $new_page_content,
				'post_parent' => $post_parent,
				'post_status' => 'publish',
				'comment_status' => 'closed'
	   );

		if (!isset($page_check->ID)) {
				$new_page_id = wp_insert_post($new_page);
				if (!empty($new_page_template)) {
						update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
				}
		}
	}

	/***********************
	AUTO GENERATE PAGES ON
	THEME ACTIVATION
	************************/
	function generate_pages() {

		$this->create_page('Dashboard','[dashboard main]','template-dashboard.php','page');
		$dashboard = get_page_by_title("Dashboard");
			sleep(1);
			$this->create_page('Edit Profile','[dashboard profile]','template-dashboard.php','page', $dashboard->ID);
			sleep(1);
			$this->create_page('Members','[dashboard members]','template-dashboard.php','page', $dashboard->ID);
			sleep(1);
			$this->create_page('Add Event','[dashboard event]','template-dashboard.php','page', $dashboard->ID);
			sleep(1);
			$this->create_page('Add News','[dashboard news]','template-dashboard.php','page', $dashboard->ID);
			sleep(1);
			$this->create_page('Newsletter','[dashboard newsletter]','template-dashboard.php','page', $dashboard->ID);
			sleep(1);
			$this->create_page('Photos','[dashboard photos]','template-dashboard.php','page', $dashboard->ID);
			sleep(1);
			$this->create_page('Chapter Activity','[dashboard activity]','template-dashboard.php','page', $dashboard->ID);
	}

	public static function users_opted_in_newsletter($chapter,$user) {

		if (!$chapter || !$user)
			return;

		$args = array(
			'meta_query' => array(
				array(
					'key' => 'chapter',
					'value' => $chapter,
					'compare' => '='
			   ),
				array(
					'key' => 'newslatter',
					'value' => 'on',
					'compare' => '='
			   )
		   ),

			'orderby'      => 'name',
			'order'        => 'ASC',
			'count_total'  => false,
			'fields'       => 'all',
			'exclude'      => array($user),
		);
		$users = get_users($args);

		return $users;
	}

	public static function users_opted_in_globally($user) {

		if (!$user)
			return;

		$args = array(
			'meta_query' => array(
				array(
					'key' => 'global_newslatter',
					'value' => 'on',
					'compare' => '='
			   )
		   ),

			'orderby'      => 'name',
			'order'        => 'ASC',
			'count_total'  => false,
			'fields'       => 'all'
		);
		$users = get_users($args);

		return $users;
	}


	/**
	 * Custom $_GET params
	 *
	 * @param int $post_id - ID of the post
	 */
	function new_post_notification($post_id) {
		remove_action('save_post', 'my_project_updated_send_email', 10);

		global $post;
		$post = get_post($post_id);
		$type = get_post_type($post_id);

		if (get_current_user_id() === 0
			|| wp_is_post_revision($post_id)
			|| wp_is_post_autosave($post_id)
			|| @$post->post_status === 'trash'
			|| @$post->post_status === 'auto-draft'
		) {
			return;
		}

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		if (!in_array($type, array('post', 'tribe_events'))
		) {
			return;
		}

		if ($type == "post") {
			$categories = get_the_category($post_id);
		} else if ($type == "tribe_events") {
			$categories = get_the_terms($post_id, 'tribe_events_cat');
		}

		if (empty($categories)) {
			return;
		}

		foreach ($categories as $c) {
			if ($c->slug == "") continue;
			$args = array(
				'name'           => $c->slug,
				'post_type'      => 'chapters',
				'post_status'    => 'publish',
			);

			$chapter = get_posts($args);

			if (count($chapter) < 1) {
				//send to global
				$users = BoltMedia::users_opted_in_globally(get_current_user_id());
					//print_r($users); exit;

			} else {
				//send to users opted in newsletter
				foreach($chapter as $c) {
					$users = BoltMedia::users_opted_in_newsletter($c->ID, get_current_user_id());
				}
			}

			if (count($users) > 0) {

				$newpost = get_option('email_newpost');
				$post_url = get_permalink($post_id);
				$headers = null;
				$headers .= 'From: Save Ontario Shipwrecks <wordpress@saveontarioshipwrecks.ca>' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				foreach ($users as $u) {
					//array_push($to, $u->user_email);
					$filter_search = array('{name}', '{type}', '{post_url}');
					$filter_replace = array(get_user_meta($u->ID,'billing_first_name',true) , $type, $post_url);

					$title = str_replace($filter_search, $filter_replace, $newpost['title']);
					$content = str_replace($filter_search, $filter_replace, $newpost['content']);

					$mail = wp_mail($u->user_email, $title, $content, $headers);
				}

			} else {
				continue;
			}
		}

		remove_action('save_post', array($this, 'new_post_notification'));
	}

	function show_current_user_attachments($wp_query) {
		if (strpos($_SERVER[ 'REQUEST_URI' ], '/wp-admin/media-upload.php') !== false) {
			if (!current_user_can('activate_plugins')) {
				global $current_user;
				$wp_query->set('author', $current_user->id);
			}
		}
	}

	function show_current_user_attachments_upload_photos ($query = array()) {
		$user_id = get_current_user_id();
		if ($user_id) {
			$query['author'] = $user_id;
		}
		return $query;
	}
}
