<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   ASE_Stories
 * @author    Nick Haskins <nick@aesopinteractive.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Aesopinteractive L.L.C.
 *
 * @wordpress-plugin
 * Plugin Name:       ASE Stories
 * Plugin URI:        http://aesopstoryengine.com/stories
 * Description:       Plugin to create stories template for Aesop Original Story Series
 * Version:           1.0.0
 * Author:            Aesopinteractive L.L.C.
 * Author URI:        http://aesopinteractive.com
 * Text Domain:       ase-stories
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/aesopinteractive/ase-stories
 * WordPress-Plugin-Boilerplate: v2.6.1
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

// Set some constants
define('ASE_STORIES_VERSION', '0.2');
define('ASE_STORIES_DIR', plugin_dir_path( __FILE__ ));
define('ASE_STORIES_URL', plugins_url( '', __FILE__ ));

require_once( plugin_dir_path( __FILE__ ) . 'public/class-ase-stories.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook( __FILE__, array( 'ASE_Stories', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'ASE_Stories', 'deactivate' ) );


add_action( 'plugins_loaded', array( 'ASE_Stories', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-ase-stories-admin.php' );
	add_action( 'plugins_loaded', array( 'ASE_Stories_Admin', 'get_instance' ) );

}
