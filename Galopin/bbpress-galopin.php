<?php
/*
Plugin Name: Galopin - Module bbPress
Plugin URI: https://www.themesdefrance.fr/themes/galopin/
Version: 1.0.0
Description: Ce module permet d'adapter le thème WordPress Galopin pour le plugin bbPress.
Author: Thèmes de France
Author URI: https://www.themesdefrance.fr
Text Domain: galopin_bbpress
License: GPLv2

This plugin is based on Justin Kopepasah' Eighties bbPress addon.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Define some constants.
define( 'GALOPIN_BBPRESS_BASENAME', plugin_basename( __FILE__ ) );
define( 'GALOPIN_BBPRESS_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'GALOPIN_BBPRESS_DIR_URL',  plugin_dir_url( __FILE__ ) );
define( 'GALOPIN_BBPRESS_VERSION',  '1.0.0' );

define( 'GALOPIN_BBPRESS_STORE_URL', 'https://www.themesdefrance.fr' );
define( 'GALOPIN_BBPRESS_ITEM', 'Galopin - Module bbPress' );
define( 'GALOPIN_BBPRESS_ITEM_LICENSE_KEY', 'galopin_bbpress_addon_galopin_license');

// Compatibility check.
require_once( GALOPIN_BBPRESS_DIR_PATH . 'includes/compatibility.php' );

///////////////////////////////////////////////////
// If we've made it this far, the plugin is active.
///////////////////////////////////////////////////

/**
 * Load translation files
 * 
 * @package bbPress Galopin Addon
 * @since 1.0.0
 */
 
function galopin_bbp_load_textdomain() {
	load_plugin_textdomain( 'galopin_bbpress', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}
add_action( 'plugins_loaded', 'galopin_bbp_load_textdomain');

/**
 * Instanciate EDD_SL_Plugin_Updater class
 * 
 * @package bbPress Galopin Addon
 * @since 1.0.0
 */

if(!function_exists('galopin_bbpress_addon_license')){
	function galopin_bbpress_addon_license() {
	
		// retrieve the license from the database
		$license = trim( get_option( GALOPIN_BBPRESS_ITEM_LICENSE_KEY ) );
		
		$edd_updater = new EDD_SL_Plugin_Updater( GALOPIN_BBPRESS_STORE_URL, __FILE__, array( 
			'version' 	=> GALOPIN_BBPRESS_VERSION, 
			'license' 	=> $license,
			'item_name' => GALOPIN_BBPRESS_ITEM,
			'author' 	=> __('Themes de France','galopin_bbpress'),
			'url'       => home_url()
		));
	}
}
add_action('plugins_loaded', 'galopin_bbpress_addon_license', 0);

// Load license stuff
require_once( GALOPIN_BBPRESS_DIR_PATH . 'includes/admin-functions.php' );

// Add new template stack. Yep, this is cool.
require_once( GALOPIN_BBPRESS_DIR_PATH . 'includes/templates.php' );

// Load necessary functions for the new template.
require_once( GALOPIN_BBPRESS_DIR_PATH . 'template/functions.php' );