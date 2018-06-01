<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * Plugin Name:       Erudus One
 * Plugin URI:        https://erudus.com/
 * Description:       Use the Erudus API to display food product data in WordPress.
 * Version:           1.0.0
 * Author:            Tim Hyde
 * Author URI:        https://wholebyte.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       erudus
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

define( 'ERUDUS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_erudus_wp() {

    require_once plugin_dir_path( __FILE__ ) . 'includes/class-erudus-activator.php';
    Erudus_Activator::activate();
}
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_erudus_wp() {
   // to do

}
register_activation_hook( __FILE__, 'activate_erudus_wp' );
register_deactivation_hook( __FILE__, 'deactivate_erudus_wp' );

require plugin_dir_path( __FILE__ ) . 'class-erudus.php';

function Erudus() {
    return Erudus::init();
}

// Global for backwards compatibility.
$GLOBALS['erudus'] = Erudus();
