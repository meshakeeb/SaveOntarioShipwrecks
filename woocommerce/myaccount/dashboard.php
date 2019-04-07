<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

                <div class="account-navigation" style="margin-top:0px;">
                    <div class="container">
                        <div class="row">
						
                            <div class="col-sm-12">
                                <a href="<?php printf ( esc_url( wc_get_endpoint_url( 'orders' ) ) ); ?>" class="item">
                                    <div class="content">
                                        <h4>View Orders</h4>
                                        <p>View your recent purchases from the SOS shop.</p>
                                        <span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-12">
                                <a href="<?php printf ( esc_url( wc_get_endpoint_url( 'edit-address' ) ) ); ?>" class="item">
                                    <div class="content">
                                        <h4>Edit Addresses</h4>
                                        <p>Manage your default shipping and billing addresses for your SOS shop orders.</p>
                                        <span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
                                    </div>
                                </a>
                            </div>
							
						</div>
					</div>
				</div>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
