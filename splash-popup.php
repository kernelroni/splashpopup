<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://perfectreturn.com
 * @since             1.0.0
 * @package           Splash_Popup
 *
 * @wordpress-plugin
 * Plugin Name:       splashPopup
 * Plugin URI:        https://github.com/kernelroni/splashpopup
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.1
 * Author:            Roni Das
 * Author URI:        https://github.com/kernelroni
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       splash-popup
 * Domain Path:       /languages
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
define( 'SPLASH_POPUP_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-splash-popup-activator.php
 */
function activate_splash_popup() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-splash-popup-activator.php';
	Splash_Popup_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-splash-popup-deactivator.php
 */
function deactivate_splash_popup() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-splash-popup-deactivator.php';
	Splash_Popup_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_splash_popup' );
register_deactivation_hook( __FILE__, 'deactivate_splash_popup' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-splash-popup.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_splash_popup() {

	$plugin = new Splash_Popup();
	$plugin->run();

}
run_splash_popup();
