<?php
	
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
	
// Load EDD Updater Class
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	// load our custom updater
	include( GALOPIN_BBPRESS_DIR_PATH . 'includes/EDD_SL_Plugin_Updater.php' );
}

/**
 * Activate license and instanciate EDD_SL_Plugin_Updater class
 * 
 * @package bbPress Galopin Addon
 * @since 1.0.0
 */

if(!function_exists('galopin_bbpress_addon_license')){
	function galopin_bbpress_addon_license() {
	
			// retrieve the license from the database
			$license = trim( get_option( EDD_SL_GALOPIN_BBPRESS_LICENSE_KEY ) );
			$status = get_option('galopin_bbpress_addon_license_status');
			
			if(!$status || $status == "invalid"){
	
				// data to send in our API request
				$api_params = array( 
					'edd_action'=> 'activate_license', 
					'license' 	=> $license, 
					'item_name' => urlencode( EDD_SL_GALOPIN_BBPRESS ), // the name of our product in EDD
					'url'       => home_url()
				);
				
				// Call the custom API.
				$response = wp_remote_get( add_query_arg( $api_params, EDD_SL_TDF_URL ), array( 'timeout' => 15, 'sslverify' => false ) );
		
				// make sure the response came back okay
				if ( is_wp_error( $response ) )
					return false;
		
				// decode the license data
				$license_data = json_decode( wp_remote_retrieve_body( $response ) );
				
				// $license_data->license will be either "valid" or "invalid"
		
				update_option( 'galopin_bbpress_addon_license_status', $license_data->license );
				
			}
			
			$edd_updater = new EDD_SL_Plugin_Updater( EDD_SL_TDF_URL, __FILE__, array( 
				'version' 	=> GALOPIN_BBPRESS_VERSION, 
				'license' 	=> $license,
				'item_name' => EDD_SL_GALOPIN_BBPRESS,
				'author' 	=> __('Themes de France','galopin-bbpress') 
			)
		);
	}
}
add_action('admin_init', 'galopin_bbpress_addon_license');

/**
 * Check whether the license key is valid
 * 
 * @package bbPress Galopin Addon
 * @since 1.0.0
 */
 
if(!function_exists('is_galopin_bbpress_addon_license_valid')){
	function is_galopin_bbpress_addon_license_valid() {
		
		global $wp_version;
		//delete_option('galopin_bbpress_addon_license_status');
		$status = get_option('galopin_bbpress_addon_license_status');

		if(!$status || $status == "invalid"){
		
			$license = trim( get_option( EDD_SL_GALOPIN_BBPRESS_LICENSE_KEY ) );
			
			$api_params = array( 
				'edd_action' => 'check_license', 
				'license' => $license, 
				'item_name' => urlencode( EDD_SL_GALOPIN_BBPRESS ),
				'url'       => home_url()
			);
		
			// Call the custom API.
			$response = wp_remote_get( add_query_arg( $api_params, EDD_SL_TDF_URL ), array( 'timeout' => 15, 'sslverify' => false ) );
		
			if ( is_wp_error( $response ) )
				return false;
		
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );
			
			if( $license_data->license == 'valid' ) {
				return true;
				// this license is still valid
			} else {
				return false;
				// this license is no longer valid
			}
		}
		else{
			return true;
		}
			
	}
}

/**
 * Add license input in the Galopin Settings (Addons tab)
 * 
 * @package bbPress Galopin Addon
 * @since 1.0.0
 */

if(!function_exists('galopin_bbpress_addon_license_admin')){
	function galopin_bbpress_addon_license_admin($form){

		if(function_exists('galopin_bbpress_styles')):
			
			if(is_galopin_bbpress_addon_license_valid())
				$description = __("Congratulations ! Your licence is activated, you'll receive updates.", 'galopin-bbpress');
			else
				$description = __("Enter your licence key in order to receive Galopin bbPress Addon updates. You'll find it in the confirmation email we sent you after your purchase.", 'galopin-bbpress');
			 
			$form->setting(array('type'=>'text',
								 'name'=>substr(EDD_SL_GALOPIN_BBPRESS_LICENSE_KEY, strlen(GALOPIN_COCORICO_PREFIX)),
								 'label'=>__("License", 'galopin-bbpress'),
								 'description'=> $description));

			$form->startWrapper('form-table');
			
				$form->startWrapper('td');
				
					$form->component('raw', '<hr>');
					
				$form->endWrapper('td');
				
			$form->endWrapper('form-table');
			
		endif;
	}
}
add_action('galopin_addons_tab', 'galopin_bbpress_addon_license_admin', 11, 1);

/**
 * Display notice if the license isn't active
 * 
 * @package bbPress Galopin Addon
 * @since 1.0.0
 */

if(!function_exists('galopin_bbpress_addon_admin_notice')){
	function galopin_bbpress_addon_admin_notice(){
	
		global $current_user;
        $user_id = $current_user->ID;
			
		if(!is_galopin_bbpress_addon_license_valid()){
			echo '<div class="error"><p>';
			_e("In order to get updates for the Galopin bbPress Addon, please enter the licence key that you received by email.", 'etendard');
			echo '</p></div>';
		}
	}
}
add_action('admin_notices', 'galopin_bbpress_addon_admin_notice');
