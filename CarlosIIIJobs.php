<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://cifpcarlos3.es
 * @since             1.0.0
 * @package           CarlosIIIJobs
 *
 * @wordpress-plugin
 * Plugin Name:       CIFP Carlos III Jobs
 * Plugin URI:        https://cifpcarlos3.es/CarlosIIIJobs-uri/
 * Description:       Gestión de ofertas de trabajo para los alumnos del C.I.F.P. Carlos III
 * Version:           1.0.0
 * Author:            C.I.F.P. Carlos III
 * Author URI:        https://cifpcarlos3.es/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       CarlosIIIJobs
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
define( 'CarlosIIIJobs_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-CarlosIIIJobs-activator.php
 */
function activate_CarlosIIIJobs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-CarlosIIIJobs-activator.php';
	CarlosIIIJobs_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-CarlosIIIJobs-deactivator.php
 */
function deactivate_CarlosIIIJobs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-CarlosIIIJobs-deactivator.php';
	CarlosIIIJobs_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_CarlosIIIJobs' );
register_deactivation_hook( __FILE__, 'deactivate_CarlosIIIJobs' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-CarlosIIIJobs.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_CarlosIIIJobs() {

	$plugin = new CarlosIIIJobs();
	$plugin->run();

}
run_CarlosIIIJobs();
