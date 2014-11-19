<?php
/*
Plugin Name: Etendard - Module bbPress
Plugin URI: https://www.themesdefrance.fr/themes/etendard/
Version: 1.0.0
Description: Ce module permet d'adapter le thème WordPress Étendard pour le plugin bbPress.
Author: Thèmes de France
Author URI: https://www.themesdefrance.fr
Text Domain: etendard-bbpress
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
define( 'ETENDARD_BBPRESS_BASENAME', plugin_basename( __FILE__ ) );
define( 'ETENDARD_BBPRESS_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'ETENDARD_BBPRESS_DIR_URL',  plugin_dir_url( __FILE__ ) );
define( 'ETENDARD_BBPRESS_VERSION',  '1.0.0' );

define( 'EDD_SL_TDF_URL', 'https://www.themesdefrance.fr' );
define( 'EDD_SL_ETENDARD_BBPRESS', 'Etendard - Module bbPress' );
define( 'EDD_SL_ETENDARD_BBPRESS_LICENSE_KEY', 'etendard_bbpress_license_edd');

// Compatibility check.
require_once( ETENDARD_BBPRESS_DIR_PATH . 'includes/compatibility.php' );

// If we've made it this far, the plugin is active.

/**
 * Load textdomain.
 *
 * @since 1.0.0
 */
function etendard_bbp_load_textdomain() {
	load_plugin_textdomain( 'etendard-bbpress', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}
add_action( 'plugins_loaded', 'etendard_bbp_load_textdomain' );

// Load EDD Updater Class
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	// load our custom updater
	include( ETENDARD_BBPRESS_DIR_PATH . 'includes/EDD_SL_Plugin_Updater.php' );
}

function edd_sl_sample_plugin_updater() {

	// retrieve our license key from the DB
	$license_key = trim( get_option( EDD_SL_ETENDARD_BBPRESS_LICENSE_KEY ) );

	// setup the updater
	$edd_updater = new EDD_SL_Plugin_Updater( EDD_SL_TDF_URL, __FILE__, array( 
			'version' 	=> ETENDARD_BBPRESS_VERSION, 
			'license' 	=> $license_key,
			'item_name' => EDD_SL_ETENDARD_BBPRESS,
			'author' 	=> __('Themes de France','etendard-bbpress') 
		)
	);

}
add_action( 'admin_init', 'edd_sl_sample_plugin_updater', 0 );

// Add new template stack. Yep, this is cool.
require_once( ETENDARD_BBPRESS_DIR_PATH . 'includes/templates.php' );

// Load necessary functions for the new template.
require_once( ETENDARD_BBPRESS_DIR_PATH . 'template/functions.php' );