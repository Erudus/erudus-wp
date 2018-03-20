<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           erudus-wp
 *
 * @wordpress-plugin
 * Plugin Name:       Erudus One
 * Plugin URI:        http://wholebyte.com/
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

require 'vendor/autoload.php';

require plugin_dir_path( __FILE__ ) . 'class-erudus.php';

function Erudus() {
    return Erudus::init();
}

// Global for backwards compatibility.
$GLOBALS['erudus'] = Erudus();
