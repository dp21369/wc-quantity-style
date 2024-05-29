<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://devendrapali.com.np
 * @since      1.0.0
 *
 * @package    Woocommerce_Quantity_Style
 * @subpackage Woocommerce_Quantity_Style/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woocommerce_Quantity_Style
 * @subpackage Woocommerce_Quantity_Style/includes
 * @author     Devendra Pali <dev.devendrapali@gmail.com>
 */
class Woocommerce_Quantity_Style_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'woocommerce-quantity-style',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
