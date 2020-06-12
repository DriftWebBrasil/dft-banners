<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       matheusdaros.com
 * @since      1.0.0
 *
 * @package    Dft_Banners
 * @subpackage Dft_Banners/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Dft_Banners
 * @subpackage Dft_Banners/includes
 * @author     Matheus Darós <contato@matheusdaros.com>
 */
class Dft_Banners_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'dft-banners',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
