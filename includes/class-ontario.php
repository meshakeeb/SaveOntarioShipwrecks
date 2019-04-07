<?php
/**
 * The Ontario bootstrap loader.
 *
 * @since      1.0.0
 * @package    Ontario
 * @subpackage Ontario\Core
 * @author     BoltMedia <info@boltmedia.ca>
 */

/**
 * The main theme class.
 */
final class Ontario {

	/**
	 * Theme Version.
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * Holds various class instances.
	 *
	 * @var array
	 */
	private $container = [];

	/**
	 * The single instance of the class.
	 *
	 * @var Ontario
	 */
	protected static $instance = null;

	/**
	 * Magic isset to bypass referencing plugin.
	 *
	 * @param  string $prop Property to check.
	 * @return bool
	 */
	public function __isset( $prop ) {
		return isset( $this->{$prop} ) || isset( $this->container[ $prop ] );
	}

	/**
	 * Magic get method.
	 *
	 * @param  string $prop Property to get.
	 * @return mixed Property value or NULL if it does not exists
	 */
	public function __get( $prop ) {
		if ( array_key_exists( $prop, $this->container ) ) {
			return $this->container[ $prop ];
		}
		return $this->{$prop};
	}

	/**
	 * Magic set method.
	 *
	 * @param mixed $prop  Property to set.
	 * @param mixed $value Value to set.
	 */
	public function __set( $prop, $value ) {
		if ( property_exists( $this, $prop ) ) {
			$this->$prop = $value;
			return;
		}
		$this->container[ $prop ] = $value;
	}

	/**
	 * Magic call method.
	 *
	 * @param  string $name      Method to call.
	 * @param  array  $arguments Arguments to pass when calling.
	 * @return mixed Return value of the callback.
	 */
	public function __call( $name, $arguments ) {
		$hash = [
			'theme_dir'    => ONTARIO_PATH,
			'theme_uri'    => ONTARIO_URL,
			'includes_dir' => ONTARIO_PATH . '/includes',
			'assets'       => ONTARIO_URL . '/assets',
		];
		if ( isset( $hash[ $name ] ) ) {
			return $hash[ $name ];
		}
		return call_user_func_array( $name, $arguments );
	}

	/**
	 * Main Ontario instance.
	 *
	 * Ensure only one instance is loaded or can be loaded.
	 *
	 * @see ontario()
	 * @return Ontario
	 */
	public static function get() {
		if ( is_null( self::$instance ) && ! ( self::$instance instanceof Ontario ) ) {
			self::$instance = new Ontario;
			self::$instance->setup();
		}
		return self::$instance;
	}

	/**
	 * Instantiate the plugin.
	 */
	private function setup() {
		// Define constants.
		$this->define_constants();

		// instantiate classes.
		$this->instantiate();

		// Loaded action.
		do_action( 'ontario_loaded' );
	}

	/**
	 * Define the plugin constants.
	 */
	private function define_constants() {
		define( 'ONTARIO_VERSION', $this->version );
		define( 'ONTARIO_PATH', get_template_directory() );
		define( 'ONTARIO_URL', get_template_directory_uri() );
	}

	/**
	 * Include the required files and initialize .
	 */
	private function instantiate() {
		include ONTARIO_PATH . '/vendor/autoload.php';
		new \Ontario\Theme_Setup;
	}
}

/**
 * Main instance of Ontario.
 *
 * Returns the main instance of Ontario to prevent the need to use globals.
 *
 * @return Ontario
 */
function ontario() {
	return Ontario::get();
}


// Kick it off!
ontario();
