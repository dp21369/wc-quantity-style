<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://devendrapali.com.np
 * @since             1.0.0
 * @package           Woocommerce_Quantity_Style
 *
 * @wordpress-plugin
 * Plugin Name:       WC Quantity Style
 * Plugin URI:        https://devendrapali.com.np
 * Description:       WC Quantity Style helps to change the default quantity arrows into separate plus and minus signs. It is customizable and takes the styling of the theme by default.
 * Version:           1.0
 * Author:            Devendra Pali
 * Author URI:        https://devendrapali.com.np/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-quantity-style
 * Domain Path:       /languages
 * Requires at least: 6.0
 * Requires PHP: 7.4
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOOCOMMERCE_QUANTITY_STYLE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-quantity-style-activator.php
 */
function activate_woocommerce_quantity_style() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-quantity-style-activator.php';
	Woocommerce_Quantity_Style_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-quantity-style-deactivator.php
 */
function deactivate_woocommerce_quantity_style() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-quantity-style-deactivator.php';
	Woocommerce_Quantity_Style_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woocommerce_quantity_style' );
register_deactivation_hook( __FILE__, 'deactivate_woocommerce_quantity_style' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc-quantity-style.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woocommerce_quantity_style() {

	$plugin = new Woocommerce_Quantity_Style();
	$plugin->run();

}
run_woocommerce_quantity_style();
