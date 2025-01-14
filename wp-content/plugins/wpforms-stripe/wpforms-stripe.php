<?php
/**
 * Plugin Name:       WPForms Stripe
 * Plugin URI:        https://wpforms.com
 * Description:       Stripe integration with WPForms.
 * Requires at least: 5.2
 * Requires PHP:      5.6
 * Author:            WPForms
 * Author URI:        https://wpforms.com
 * Version:           2.11.0
 * Text Domain:       wpforms-stripe
 * Domain Path:       languages
 *
 * WPForms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * WPForms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WPForms. If not, see <https://www.gnu.org/licenses/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WPFormsStripe\Install;
use WPFormsStripe\Loader;

// phpcs:disable WPForms.Comments.PHPDocDefine.MissPHPDoc
// Plugin constants.
define( 'WPFORMS_STRIPE_VERSION', '2.11.0' );
define( 'WPFORMS_STRIPE_FILE', __FILE__ );
define( 'WPFORMS_STRIPE_PATH', plugin_dir_path( WPFORMS_STRIPE_FILE ) );
define( 'WPFORMS_STRIPE_URL', plugin_dir_url( WPFORMS_STRIPE_FILE ) );
// phpcs:enable WPForms.Comments.PHPDocDefine.MissPHPDoc

/**
 * Load the provider class.
 *
 * @since 2.5.0
 */
function wpforms_stripe_load() {

	// Check requirements.
	if ( ! wpforms_stripe_required() ) {
		return;
	}

	// Load the plugin.
	wpforms_stripe();
}
add_action( 'wpforms_loaded', 'wpforms_stripe_load' );

/**
 * Check addon requirements.
 *
 * @since 2.5.0
 *
 * @return bool
 */
function wpforms_stripe_required() {

	if ( PHP_VERSION_ID < 50600 ) {
		add_action( 'admin_init', 'wpforms_stripe_deactivate' );
		add_action( 'admin_notices', 'wpforms_stripe_fail_php_version' );

		return false;
	}

	if ( ! function_exists( 'wpforms' ) ) {
		return false;
	}

	if ( version_compare( wpforms()->version, '1.8.0.2', '<' ) ) {
		add_action( 'admin_init', 'wpforms_stripe_deactivate' );
		add_action( 'admin_notices', 'wpforms_stripe_fail_wpforms_version' );

		return false;
	}

	if ( ! function_exists( 'wpforms_get_license_type' ) || ! in_array( wpforms_get_license_type(), [ 'pro', 'elite', 'agency', 'ultimate' ], true ) ) {
		return false;
	}

	return true;
}

/**
 * Deactivate the plugin.
 *
 * @since 2.5.0
 */
function wpforms_stripe_deactivate() {

	deactivate_plugins( plugin_basename( WPFORMS_STRIPE_FILE ) );
}

/**
 * Admin notice for a minimum PHP version.
 *
 * @since 2.5.0
 */
function wpforms_stripe_fail_php_version() {

	echo '<div class="notice notice-error"><p>';
	printf(
		wp_kses( /* translators: %s - WPForms.com documentation page URL. */
			__( 'The WPForms Stripe plugin is not accepting payments anymore because your site is running an outdated version of PHP that is no longer supported and is not compatible with the plugin. <a href="%s" target="_blank" rel="noopener noreferrer">Read more</a> for additional information.', 'wpforms-stripe' ),
			[
				'a' => [
					'href'   => [],
					'rel'    => [],
					'target' => [],
				],
			]
		),
		'https://wpforms.com/docs/supported-php-version/'
	);

	echo '</p></div>';

	// phpcs:disable WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}
	// phpcs:enable WordPress.Security.NonceVerification.Recommended
}

/**
 * Admin notice for minimum WPForms version.
 *
 * @since 2.5.0
 */
function wpforms_stripe_fail_wpforms_version() {

	echo '<div class="notice notice-error"><p>';
	esc_html_e( 'The WPForms Stripe plugin has been deactivated, because it requires WPForms v1.8.0.2 or later to work.', 'wpforms-stripe' );
	echo '</p></div>';

	// phpcs:disable WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}
	// phpcs:enable WordPress.Security.NonceVerification.Recommended
}

/**
 * Display notice after deactivation.
 *
 * @since 1.2.0
 * @deprecated 2.5.0
 */
function wpforms_stripe_deactivate_msg() {

	_deprecated_function( __FUNCTION__, '2.5.0 of the WPForms Stripe addon' );

	wpforms_stripe_fail_php_version();
}

/**
 * Get the instance of the plugin main class, which actually loads all the code.
 *
 * @since 2.5.0
 *
 * @return Loader
 */
function wpforms_stripe() {

	return Loader::get_instance();
}

/**
 * Load the plugin updater.
 *
 * @since 2.5.0
 *
 * @param string $key License key.
 */
function wpforms_stripe_updater( $key ) {

	new WPForms_Updater(
		[
			'plugin_name' => 'WPForms Stripe',
			'plugin_slug' => 'wpforms-stripe',
			'plugin_path' => plugin_basename( WPFORMS_STRIPE_FILE ),
			'plugin_url'  => trailingslashit( WPFORMS_STRIPE_URL ),
			'remote_url'  => WPFORMS_UPDATER_API,
			'version'     => WPFORMS_STRIPE_VERSION,
			'key'         => $key,
		]
	);
}
add_action( 'wpforms_updater', 'wpforms_stripe_updater' );

require_once WPFORMS_STRIPE_PATH . 'vendor/autoload.php';

// Load installation things immediately for a reason how activation hook works.
new Install();
