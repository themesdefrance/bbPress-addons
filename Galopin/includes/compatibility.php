<?php

/**
 * Test if Galopin and bbPress are activated
 * 
 * @package bbPress Galopin Addon
 * @since 1.0.0
 */

if(!function_exists('galopin_bbpress_admin_init')){
	function galopin_bbpress_admin_init() {
	
		if ( get_template() != 'Galopin' || ! is_plugin_active( 'bbpress/bbpress.php' ) ) {
	
			// Don't show any notice when the plugin was activated
			unset( $_GET['activate'] );
	
			// Display a notice saying that Galopin or bbPress is required
			add_action( 'admin_notices', 'galopin_bbpress_admin_init_notices' );
	
			// Deactivates the plugin, as Galopin or bbPress is not currently active
			deactivate_plugins( GALOPIN_BBPRESS_BASENAME );
		}
	}
}
add_action( 'admin_init', 'galopin_bbpress_admin_init' );

/**
 * Custom admin notices if Galopin or bbPress aren't activated
 * 
 * @package bbPress Galopin Addon
 * @since 1.0.0
 */

if(!function_exists('galopin_bbpress_admin_init_notices')){
	function galopin_bbpress_admin_init_notices() {
		
		// Galopin isn't activated
		if ( get_template() != 'Galopin' ) {
			?>
				<div class="error">
					<p><?php echo sprintf( __( 'Galopin - bbPress Addon has been deactivated as it requires %sGalopin theme%s. You must download, install and activate the theme before activating this add-on.', 'galopin_bbpress' ), '<a href="' . esc_url( "https://www.themesdefrance.fr/themes/galopin?utm_source=ModuleGalopin&utm_medium=lien&utm_content=GalopinAbsent&utm_campaign=GalopinbbPressAdmin" ) . '" target="_blank">', '</a>' ) ?></p>
				</div>
			<?php
		// bbPress isn't activated
		} else if ( ! is_plugin_active( 'bbpress/bbpress.php' ) ) {
			?>
				<div class="error">
					<p><?php echo sprintf( __( 'Galopin - bbPress Addon has been deactivated as it requires %sbbPress plugin%s. You must download, install and activate the plugin before activating this add-on.', 'galopin_bbpress' ), '<a href="' . esc_url( "http://bbpress.org" ) . '" target="_blank">', '</a>' ) ?></p>
				</div>
			<?php
		}
	}
}