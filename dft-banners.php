<?php

/**
 * The Drift - Banners plugin bootstrap file
 *
 *
 * @link              matheusdaros.com
 * @since             1.0.0
 * @package           Gforms_Draft_Viewer
 *
 * @wordpress-plugin
 * Plugin Name:       Drift - Banners
 * Description:       Adiciona um slider com banners
 * Version:           1.0.0
 * Author:            <a href='https://www.driftweb.com.br' target='_blank'>Drift Web Team</a> | <a href='https://www.matheusdaros.com' target='_blank'>Matheus Darós</a>
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dft-banners
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'DFT_BANNERS_VERSION', '1.0.0' );
define( 'DFT_BANNERS_URL', plugin_dir_url(__FILE__) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dft-banners-activator.php
 */
function activate_dft_banners() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dft-banners-activator.php';
	Dft_Banners_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dft-banners-deactivator.php
 */
function deactivate_dft_banners_rascunhos() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dft-banners-deactivator.php';
	Dft_Banners_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dft_banners' );
register_deactivation_hook( __FILE__, 'deactivate_dft_banners_rascunhos' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dft-banners.php';

/**
 * Begins execution of the plugin.
 *
 *
 * @since    1.0.0
 */
function run_dft_banners() {

	$plugin = new Dft_Banners();
	$plugin->run();

}

/**
 * Gets the absolute path to this plugin directory
 *
 * @since    1.0.0
 */
function dft_banners_plugin_path() {

	return untrailingslashit( plugin_dir_path( __FILE__ ) );
	
}
  

run_dft_banners();
	


