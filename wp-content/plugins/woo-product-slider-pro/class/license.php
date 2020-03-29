<?php
/**
 * This is to plugin license page.
 *
 * @package woo-product-slider-pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WPSPRO_License {

	private static $_instance;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'license_page' ), 99 );
		add_action( 'admin_init', array( $this, 'sp_wpspro_register_option' ) );
		add_action( 'admin_init', array( $this, 'sp_wpspro_activate_license' ) );
		add_action( 'admin_init', array( $this, 'sp_wpspro_deactivate_license' ) );
		add_action( 'admin_notices', array( $this, 'sp_wpspro_admin_notices' ) );
	}

	public static function getInstance() {
		if ( ! self::$_instance ) {
			self::$_instance = new WPSPRO_License();
		}

		return self::$_instance;
	}

	/**
	 * Add SubMenu Page
	 */
	function license_page() {
		add_submenu_page( 'edit.php?post_type=sp_wpsp_shortcodes', __( 'Product Slider Pro for WooCommerce License', 'woo-product-slider-pro' ), __( 'License', 'woo-product-slider-pro' ), 'manage_options', 'wpspro_license', array( $this, 'license_page_callback' ) );
	}

	/**
	 * License Page Callback
	 */
	public function license_page_callback() {
		$license = get_option( 'sp_wpspro_license_key' );
		$status  = get_option( 'sp_wpspro_license_status' );
		?>
		<div class="wrap">
		<h2><?php _e( 'Product Slider Pro for WooCommerce License Activation', 'woo-product-slider-pro' ); ?></h2>
		<form method="post" action="options.php">

			<?php settings_fields( 'sp_wpspro_license' ); ?>

			<table class="form-table">
				<tbody>
				<tr valign="top">
					<th scope="row" valign="top">
						<?php _e( 'License Key', 'woo-product-slider-pro' ); ?>
					</th>
					<td>
						<input id="sp_wpspro_license_key" name="sp_wpspro_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
						<label class="description" for="sp_wpspro_license_key">
						<?php
						_e( 'Enter your license key', 'woo-product-slider-pro' );
						?>
						</label>
					</td>
				</tr>
				<?php if ( false !== $license ) { ?>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e( 'Activate License', 'woo-product-slider-pro' ); ?>
						</th>
						<td>
							<?php if ( $status !== false && $status == 'valid' ) { ?>
								<span style="line-height: 28px;background-color: green;color: #ffffff;padding: 5px 10px;"><?php _e( 'active' ); ?></span>
								<?php wp_nonce_field( 'sp_wpspro_nonce', 'sp_wpspro_nonce' ); ?>
								<input type="submit" class="button-secondary" name="sp_wpspro_license_deactivate" value="<?php _e( 'Deactivate License', 'woo-product-slider-pro' ); ?>"/>
								<?php
							} else {
								wp_nonce_field( 'sp_wpspro_nonce', 'sp_wpspro_nonce' );
								?>
								<input type="submit" class="button-secondary" name="sp_wpspro_license_activate" value="<?php _e( 'Activate License', 'woo-product-slider-pro' ); ?>"/>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<?php submit_button(); ?>

		</form>
		<?php
	}

	function sp_wpspro_register_option() {
		// creates our settings in the options table
		register_setting( 'sp_wpspro_license', 'sp_wpspro_license_key', 'sp_wpspro_sanitize_license' );
	}

	function sp_wpspro_sanitize_license( $new ) {
		$old = get_option( 'sp_wpspro_license_key' );
		if ( $old && $old != $new ) {
			delete_option( 'sp_wpspro_license_status' ); // new license has been entered, so must reactivate
		}
		return $new;
	}

	/************************************
	 this illustrates how to activate
	 a license key
	 *************************************/

	function sp_wpspro_activate_license() {

		// listen for our activate button to be clicked
		if ( isset( $_POST['sp_wpspro_license_activate'] ) ) {

			// run a quick security check
			if ( ! check_admin_referer( 'sp_wpspro_nonce', 'sp_wpspro_nonce' ) ) {
				return;} // get out if we didn't click the Activate button

			// retrieve the license from the database
			$license = trim( get_option( 'sp_wpspro_license_key' ) );

			// data to send in our API request
			$api_params = array(
				'edd_action' => 'activate_license',
				'license'    => $license,
				'item_id'    => SP_WPSPRO_ITEM_ID,
				'url'        => home_url(),
			);

			// Call the custom API.
			$response = wp_remote_post(
				SP_WPSPRO_STORE_URL, array(
					'timeout'   => 15,
					'sslverify' => false,
					'body'      => $api_params,
				)
			);

			// make sure the response came back okay
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

				if ( is_wp_error( $response ) ) {
					$message = $response->get_error_message();
				} else {
					$message = __( 'An error occurred, please try again.', 'woo-product-slider-pro' );
				}
			} else {

				$license_data = json_decode( wp_remote_retrieve_body( $response ) );

				if ( false === $license_data->success ) {

					switch ( $license_data->error ) {

						case 'expired':
							$message = sprintf(
								__( 'Your license key expired on %s.', 'woo-product-slider-pro' ),
								date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
							);
							break;

						case 'revoked':
							$message = __( 'Your license key has been disabled.', 'woo-product-slider-pro' );
							break;

						case 'missing':
							$message = __( 'Invalid license.', 'woo-product-slider-pro' );
							break;

						case 'invalid':
						case 'site_inactive':
							$message = __( 'Your license is not active for this URL.', 'woo-product-slider-pro' );
							break;

						case 'item_name_mismatch':
							$message = sprintf(
								__( 'This appears to be an invalid license key for %s.', 'woo-product-slider-pro' ),
								SP_WPSPRO_ITEM_NAME
							);
							break;

						case 'no_activations_left':
							$message = __( 'Your license key has reached its activation limit.', 'woo-product-slider-pro' );
							break;

						default:
							$message = __( 'An error occurred, please try again.', 'woo-product-slider-pro' );
							break;
					}
				}
			}

			// Check if anything passed on a message constituting a failure
			if ( ! empty( $message ) ) {
				$base_url = admin_url( 'edit.php?post_type=sp_wpsp_shortcodes&page=wpspro_license' );
				$redirect = add_query_arg(
					array(
						'wpspro_activation' => 'false',
						'message'           => urlencode( $message ),
					), $base_url
				);

				wp_redirect( $redirect );
				exit();
			}

			// $license_data->license will be either "valid" or "invalid"
			update_option( 'sp_wpspro_license_status', $license_data->license );
			wp_redirect( admin_url( 'edit.php?post_type=sp_wpsp_shortcodes&page=wpspro_license' ) );
			exit();
		}
	}

	/***********************************************
	 Illustrates how to deactivate a license key.
	 This will decrease the site count
	 ***********************************************/
	function sp_wpspro_deactivate_license() {

		// listen for our activate button to be clicked
		if ( isset( $_POST['sp_wpspro_license_deactivate'] ) ) {

			// run a quick security check
			if ( ! check_admin_referer( 'sp_wpspro_nonce', 'sp_wpspro_nonce' ) ) {
				return;} // get out if we didn't click the Activate button

			// retrieve the license from the database
			$license = trim( get_option( 'sp_wpspro_license_key' ) );

			// data to send in our API request
			$api_params = array(
				'edd_action' => 'deactivate_license',
				'license'    => $license,
				'item_id'    => SP_WPSPRO_ITEM_ID,
				'url'        => home_url(),
			);

			// Call the custom API.
			$response = wp_remote_post(
				SP_WPSPRO_STORE_URL, array(
					'timeout'   => 15,
					'sslverify' => false,
					'body'      =>
						$api_params,
				)
			);

			// make sure the response came back okay
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

				if ( is_wp_error( $response ) ) {
					$message = $response->get_error_message();
				} else {
					$message = __( 'An error occurred, please try again.', 'woo-product-slider-pro' );
				}

				$base_url = admin_url( 'edit.php?post_type=sp_wpsp_shortcodes&page=wpspro_license' );
				$redirect = add_query_arg(
					array(
						'wpspro_activation' => 'false',
						'message'           => urlencode( $message ),
					), $base_url
				);

				wp_redirect( $redirect );
				exit();
			}

			// decode the license data
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			// $license_data->license will be either "deactivated" or "failed"
			if ( $license_data->license == 'deactivated' ) {
				delete_option( 'sp_wpspro_license_status' );
			}

			wp_redirect( admin_url( 'edit.php?post_type=sp_wpsp_shortcodes&page=wpspro_license' ) );
			exit();

		}
	}

	/************************************
	 this illustrates how to check if
	 a license key is still valid
	 the updater does this for you,
	 so this is only needed if you
	 want to do something custom
	 *************************************/

	function sp_wpspro_check_license() {

		global $wp_version;

		$license = trim( get_option( 'sp_wpspro_license_key' ) );

		$api_params = array(
			'edd_action' => 'check_license',
			'license'    => $license,
			'item_id'    => SP_WPSPRO_ITEM_ID,
			'url'        => home_url(),
		);

		// Call the custom API.
		$response = wp_remote_post(
			SP_WPSPRO_STORE_URL, array(
				'timeout'   => 15,
				'sslverify' => false,
				'body'      =>
					$api_params,
			)
		);

		if ( is_wp_error( $response ) ) {
			return false;}

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		if ( $license_data->license == 'valid' ) {
			echo 'valid';
			exit;
			// this license is still valid
		} else {
			echo 'invalid';
			exit;
			// this license is no longer valid
		}
	}

	/**
	 * This is a means of catching errors from the activation method above and displaying it to the customer
	 */
	public function sp_wpspro_admin_notices() {
		settings_errors();
		if ( isset( $_GET['wpspro_activation'] ) && ! empty( $_GET['message'] ) ) {

			switch ( $_GET['wpspro_activation'] ) {

				case 'false':
					$message = urldecode( $_GET['message'] );
					?>
				<div class="error">
					<p><?php echo $message; ?></p>
				</div>
					<?php
					break;

				case 'true':
				default:
					// Developers can put a custom success message here for when activation is successful if they way.
					break;

			}
		}
	}

}
