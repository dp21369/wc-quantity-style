<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://devendrapali.com.np
 * @since      1.0.0
 *
 * @package    Woocommerce_Quantity_Style
 * @subpackage Woocommerce_Quantity_Style/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woocommerce_Quantity_Style
 * @subpackage Woocommerce_Quantity_Style/public
 * @author     Devendra Pali <dev.devendrapali@gmail.com>
 */
class Woocommerce_Quantity_Style_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-quantity-style-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-quantity-style-public.js', array( 'jquery' ), $this->version, false );

	}

}


defined( 'ABSPATH' ) || exit(); // Exit if accessed directly.

if ( ! class_exists( 'WQS_Plus_Minus' ) ) {

    /**
     * Main Class.
     */
    class WQS_Plus_Minus {

        /**
         * The instance variable of the class.
         *
         * @var $instance.
         */
        protected static $instance = null;

        /**
         * Constructor of this class.
         */
        public function __construct() {
            add_action( 'woocommerce_after_quantity_input_field', array( $this, 'wqs_display_quantity_plus' ) );
            add_action( 'woocommerce_before_quantity_input_field', array( $this, 'wqs_display_quantity_minus' ) );
            add_action( 'wp_footer', array( $this, 'wqs_add_cart_quantity_plus_minus' ) );
        }

        /**
         * Display plus button after Add to Cart button.
         */
        public function wqs_display_quantity_plus() {
            echo '<button type="button" class="plus">+</button>';
        }

        /**
         * Display minus button before Add to Cart button.
         */
        public function wqs_display_quantity_minus() {
            echo '<button type="button" class="minus">-</button>';
        }

        /**
         * Enqueue script.
         */
        public function wqs_add_cart_quantity_plus_minus() {

            if ( ! is_product() && ! is_cart() ) {
                return;
            }

            wc_enqueue_js(
                "$(document).on( 'click', 'button.plus, button.minus', function() {

                    var qty = $( this ).parent( '.quantity' ).find( '.qty' );
                    var val = parseFloat(qty.val());
                    var max = parseFloat(qty.attr( 'max' ));
                    var min = parseFloat(qty.attr( 'min' ));
                    var step = parseFloat(qty.attr( 'step' ));

                    if ( $( this ).is( '.plus' ) ) {
                        if ( max && ( max <= val ) ) {
                        qty.val( max ).change();
                        } else {
                        qty.val( val + step ).change();
                        }
                    } else {
                        if ( min && ( min >= val ) ) {
                        qty.val( min ).change();
                        } else if ( val > 1 ) {
                        qty.val( val - step ).change();
                        }
                    }

                });"
            );
        }

        /**
         * Instance of this class.
         *
         * @return object.
         */
        public static function get_instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }

            return self::$instance;
        }
    }
}

WQS_Plus_Minus::get_instance();