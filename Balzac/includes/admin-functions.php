<?php
	
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
	
// Load EDD Updater Class
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	// load our custom updater
	include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Activate license
 * 
 * @package bbPress Balzac Addon
 * @since 1.0.0
 */

if(!function_exists('balzac_bbpress_addon_activate_license')){
	function balzac_bbpress_addon_activate_license() {
		
		// retrieve the license from the database
		$license = trim( get_option( BALZAC_BBPRESS_ITEM_LICENSE_KEY ) );
		$status = get_option(BALZAC_BBPRESS_ITEM_LICENSE_KEY . '_status');
			
		if(!$status || $status == "invalid"){

			// data to send in our API request
			$api_params = array( 
				'edd_action'=> 'activate_license', 
				'license' 	=> $license, 
				'item_name' => urlencode( BALZAC_BBPRESS_ITEM ), // the name of our product in EDD
				'url'       => home_url()
			);
			
			// Call the custom API.
			$response = wp_remote_get( add_query_arg( $api_params, BALZAC_BBPRESS_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );
	
			// make sure the response came back okay
			if ( is_wp_error( $response ) )
				return false;
	
			// decode the license data
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );
			
			// $license_data->license will be either "valid" or "invalid"
			
			update_option( BALZAC_BBPRESS_ITEM_LICENSE_KEY . '_status', $license_data->license );
			
		}
	}
}
add_action('plugins_loaded', 'balzac_bbpress_addon_activate_license');

/**
 * Check whether the license key is valid
 * 
 * @package bbPress Balzac Addon
 * @since 1.0.0
 */
 
if(!function_exists('is_balzac_bbpress_addon_license_valid')){
	function is_balzac_bbpress_addon_license_valid() {
		
		global $wp_version;
		//delete_option(BALZAC_BBPRESS_ITEM_LICENSE_KEY . '_status');
		$status = get_option(BALZAC_BBPRESS_ITEM_LICENSE_KEY . '_status');

		if(!$status || $status == "invalid"){
			return false;
		}
		else{
			return true;
		}
			
	}
}

/**
 * Add license input in the Balzac Settings (Addons tab)
 * 
 * @package bbPress Balzac Addon
 * @since 1.0.0
 */

if(!function_exists('balzac_bbpress_addon_license_admin')){
	function balzac_bbpress_addon_license_admin($form){

		if(function_exists('balzac_bbpress_styles')):
			
			$form->startWrapper('form-table');
			
				$form->startWrapper('td');
			
					if(is_balzac_bbpress_addon_license_valid())
						$description = __("Congratulations ! Your licence is activated, you'll receive updates.", 'balzac_bbpress');
					else
						$description = __("Enter your licence key in order to receive Balzac bbPress Addon updates. You'll find it in the confirmation email we sent you after your purchase.", 'balzac_bbpress');
					 
					$form->setting(array('type'=>'text',
										 'name'=>substr(BALZAC_BBPRESS_ITEM_LICENSE_KEY, strlen(BALZAC_COCORICO_PREFIX)),
										 'label'=>__("License", 'balzac_bbpress'),
										 'description'=> $description));
			
				$form->endWrapper('td');
				
			$form->endWrapper('form-table');
			
		endif;
	}
}
add_action('balzac_addons_tab', 'balzac_bbpress_addon_license_admin', 11, 1);

/**
 * Display notice if the license isn't active
 * 
 * @package bbPress Balzac Addon
 * @since 1.0.0
 */

if(!function_exists('balzac_bbpress_addon_admin_notice')){
	function balzac_bbpress_addon_admin_notice(){
	
		global $current_user;
        $user_id = $current_user->ID;
			
		if(!is_balzac_bbpress_addon_license_valid()){
			echo '<div class="error"><p>';
			_e("In order to get updates for the Balzac bbPress Addon, please enter the licence key that you received by email.", 'balzac_bbpress');
			echo '</p></div>';
		}
	}
}
add_action('admin_notices', 'balzac_bbpress_addon_admin_notice');
