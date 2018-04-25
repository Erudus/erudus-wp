<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://erudus.com
 * @since             1.0.0
 * @package           erudus-wp
 *
 * @wordpress-plugin
 * Plugin Name:       Erudus One
 * Plugin URI:        http://erudus.com/
 * Description:       Use Erudus product data in WordPress.
 * Version:           1.0.0
 * Author:            Tim Hyde
 * Author URI:        http://wholebyte.com/
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
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );
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
