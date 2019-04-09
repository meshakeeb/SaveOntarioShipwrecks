<?php
/**
 * Menbers plugin integration.
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
 * Capabilities class.
 */
class Capabilities {

	use Hooker;

	/**
	 * Members cap group name.
	 *
	 * @var string
	 */
	const GROUP = 'save_ontario_shipwrecks';

	/**
	 * Class Members constructor.
	 */
	public function __construct() {
		$this->action( 'members_register_caps', 'register_caps' );
		$this->action( 'members_register_cap_groups', 'register_cap_groups' );
	}

	/**
	 * Registers cap group.
	 */
	public function register_cap_groups() {
		members_register_cap_group(
			self::GROUP,
			[
				'label'    => esc_html__( 'Save Ontario Shipwrecks', 'sos' ),
				'caps'     => [],
				'icon'     => 'dashicons-sos',
				'priority' => 30,
			]
		);
	}

	/**
	 * Registers caps.
	 */
	public function register_caps() {
		$capabilities = [
			'manage_chapter_members' => esc_html__( 'Manage Chapter Members', 'sos' ),
			'send_newsletter'        => esc_html__( 'Send Newsletter', 'sos' ),
			'edit_email_templates'   => esc_html__( 'Edit Email Templates', 'sos' ),
			'moderate_upload_photos' => esc_html__( 'Moderate Upload Photos', 'sos' ),
		];

		foreach ( $capabilities as $key => $value ) {
			members_register_cap(
				$key,
				[
					'label' => html_entity_decode( $value ),
					'group' => self::GROUP,
				]
			);
		}
	}
}
