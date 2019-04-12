<?php
/**
 * ACF manager.
 *
 * @since      1.0.0
 * @package    Ontario
 * @subpackage Ontario\Core
 * @author     BoltMedia <info@boltmedia.ca>
 */

namespace Ontario;

use Ontario\Traits\Hooker;

defined( 'ABSPATH' ) || exit;

/**
 * ACF class.
 */
class ACF {

	use Hooker;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		require_once 'acf/member-documents.php';
		require_once 'acf/new-product.php';
	}
}
