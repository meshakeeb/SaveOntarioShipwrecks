<?php
class BoltMediaBuoy {

	public static function GetBuoys($query_string = null){

		global $wpdb, $post;

		//if( !is_page_template('templates/bouylist-v2.php') || $query_string = null ) return;

		$search = ( isset($_GET['search']) ) ? 'AND ( CONCAT(A.post_name, F.name, E.field_bodywater_value, D.latitude, D.longitude) LIKE "%'.$_GET["search"].'%" )' : "";

		if( isset( $_GET['orderby'] ) ){
			$order = $_GET['orderby']." ".$_GET['order']  ;
		} else {
			$order = "A.post_name ASC" ;
		}

		$query = "SELECT
					  A.ID AS postID,
					  B.meta_value AS postmetaVID,
					  B.meta_value AS postmetaVID,
					  C.lid AS lid,
					  D.latitude, D.longitude,
					  E.field_organization_value,
					  E.field_bodywater_value AS water,
					  F.name AS group_name,
					  G.post_id AS buoystatusID,
					  G.meta_key AS buoystatusKEY,
					  H.meta_key AS wtf2,
					  H.meta_value AS status,
					  I.post_status, I.post_type, I.post_name

					FROM {$wpdb->prefix}posts AS A


						LEFT JOIN {$wpdb->prefix}postmeta AS B ON  A.ID = B.post_id AND  B.meta_key = 'vid'
						LEFT JOIN location_instance AS C ON B.meta_value = C.vid
						LEFT JOIN location AS D ON C.lid = D.lid
						LEFT JOIN content_type_buoy AS E ON  C.vid = E.vid
						LEFT JOIN term_data AS F ON  E.field_organization_value = F.tid

						LEFT JOIN {$wpdb->prefix}postmeta AS G ON A.ID = G.meta_value AND G.meta_key = 'site_name'
						LEFT JOIN {$wpdb->prefix}postmeta AS H ON G.post_id = H.post_id AND H.meta_key = 'buoy_status'
						LEFT JOIN {$wpdb->prefix}posts AS I ON G.post_id = I.ID AND I.post_type = 'buoystatus1' AND I.post_name = A.post_name


					WHERE
						A.post_status = 'publish'
						AND  A.post_type = 'buoysites'
						$search
						group by postID
					ORDER BY $order";

		$data = $wpdb->get_results($query);
		return $data;
	}

	public static function GetBuoys1(){

		global $wpdb, $post;

		//if( !is_page_template('templates/bouylist-v2.php') ) return;

		$search = ( isset($_GET['search']) ) ? 'AND ( CONCAT(A.post_name, F.name, E.field_bodywater_value, D.latitude, D.longitude) LIKE "%'.$_GET["search"].'%" )' : "";

		if( isset( $_GET['orderby'] ) ){
			$order = $_GET['orderby']." ".$_GET['order']  ;
		} else {
			$order = "A.post_name ASC" ;
		}



		$query = "SELECT
					  A.ID AS postID,
					  B.meta_value AS postmetaVID,
					  B.meta_value AS postmetaVID,
					  C.lid AS lid,
					  D.latitude, D.longitude,
					  E.field_organization_value,
					  E.field_bodywater_value AS water,
					  F.name AS group_name,
					  G.post_id AS buoystatusID,
					  G.meta_key AS buoystatusKEY,
					  H.meta_key AS wtf2,
					  H.meta_value AS status,
					  I.post_status, I.post_type, I.post_name

					FROM {$wpdb->prefix}posts AS A


						LEFT JOIN {$wpdb->prefix}postmeta AS B ON  A.ID = B.post_id AND  B.meta_key = 'vid'
						LEFT JOIN location_instance AS C ON B.meta_value = C.vid
						LEFT JOIN location AS D ON C.lid = D.lid
						LEFT JOIN content_type_buoy AS E ON  C.vid = E.vid
						LEFT JOIN term_data AS F ON  E.field_organization_value = F.tid

						LEFT JOIN {$wpdb->prefix}postmeta AS G ON A.ID = G.meta_value AND G.meta_key = 'site_name'
						LEFT JOIN {$wpdb->prefix}postmeta AS H ON G.post_id = H.post_id AND H.meta_key = 'buoy_status'
						LEFT JOIN {$wpdb->prefix}posts AS I ON G.post_id = I.ID AND I.post_type = 'buoystatus1' AND I.post_name = A.post_name


					WHERE
						A.post_status = 'publish'
						AND  A.post_type = 'buoysites'
						$search
					group by postID
					ORDER BY $order";

		$data = $wpdb->get_results($query);
		return $data;
	}


	public static function Sort() {

			if( isset($_GET['orderby']) ) :
				$output[0] = $_GET['orderby'];
				$output[1] = ($_GET['order'] === "DESC" || !isset($_GET['order']) )  ? "ASC" : "DESC" ;
			else :
				$output[0] = "A.post_name" ;
				$output[1] = "DESC" ;
			endif;

			return $output;

	}

	function exportBuoy() {
	  $response = false;
	  //print_r( $_POST );
	  //[query_string] => userID=orderby%3DE.field_bodywater_value%26order%3DDESC

	  $response = $this->GetBuoys($_POST['query_string']);

	  wp_send_json( json_encode($response) );

	  wp_die();
	}

}
