<?php

/**
 * Test if Balzac and bbPress are activated
 * 
 * @package bbPress Balzac Addon
 * @since 1.0.0
 */

if(!function_exists('balzac_bbpress_admin_init')){
	function balzac_bbpress_admin_init() {
	
		if ( get_template() != 'Balzac' || ! is_plugin_active( 'bbpress/bbpress.php' ) ) {
	
			// Don't show any notice when the plugin was activated
			unset( $_GET['activate'] );
	
			// Display a notice saying that Balzac or bbPress is required
			add_action( 'admin_notices', 'balzac_bbpress_admin_init_notices' );
	
			// Deactivates the plugin, as Balzac or bbPress is not currently active
			deactivate_plugins( BALZAC_BBPRESS_BASENAME );
		}
	}
}
add_action( 'admin_init', 'balzac_bbpress_admin_init' );

/**
 * Custom admin notices if Balzac or bbPress aren't activated
 * 
 * @package bbPress Balzac Addon
 * @since 1.0.0
 */

if(!function_exists('balzac_bbpress_admin_init_notices')){
	function balzac_bbpress_admin_init_notices() {
		
		// Balzac isn't activated
		if ( get_template() != 'Balzac' ) {
			?>
				<div class="error">
					<p><?php echo sprintf( __( 'Balzac - Module bbPress has been deactivated as it requires %sBalzac theme%s. You must download, install and activate the theme before activating this add-on.', 'balzac_bbpress' ), '<a href="' . esc_url( "https://www.themesdefrance.fr/themes/balzac" ) . '" target="_blank">', '</a>' ) ?></p>
				</div>
			<?php
		// bbPress isn't activated
		} else if ( ! is_plugin_active( 'bbpress/bbpress.php' ) ) {
			?>
				<div class="error">
					<p><?php echo sprintf( __( 'Balzac - Module bbPress has been deactivated as it requires %sbbPress plugin%s. You must download, install and activate the plugin before activating this add-on.', 'balzac_bbpress' ), '<a href="' . esc_url( "http://bbpress.org" ) . '" target="_blank">', '</a>' ) ?></p>
				</div>
			<?php
		}
	}
}