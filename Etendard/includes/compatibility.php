<?php

/**
 * Test if Etendard and bbPress are activated
 * 
 * @package bbPress Etendard Addon
 * @since 1.0.0
 */

if(!function_exists('etendard_bbpress_admin_init')){
	function etendard_bbpress_admin_init() {
	
		if ( get_template() != 'Etendard' || ! is_plugin_active( 'bbpress/bbpress.php' ) ) {
	
			// Don't show any notice when the plugin was activated
			unset( $_GET['activate'] );
	
			// Display a notice saying that Etendard or bbPress is required
			add_action( 'admin_notices', 'etendard_bbpress_admin_init_notices' );
	
			// Deactivates the plugin, as Etendard or bbPress is not currently active
			deactivate_plugins( ETENDARD_BBPRESS_BASENAME );
		}
	}
}
add_action( 'admin_init', 'etendard_bbpress_admin_init' );

/**
 * Custom admin notices if Etendard or bbPress aren't activated
 * 
 * @package bbPress Etendard Addon
 * @since 1.0.0
 */

if(!function_exists('etendard_bbpress_admin_init_notices')){
	function etendard_bbpress_admin_init_notices() {
		
		// Etendard isn't activated
		if ( get_template() != 'Etendard' ) {
			?>
				<div class="error">
					<p><?php echo sprintf( __( 'Etendard - Module bbPress has been deactivated as it requires %sEtendard theme%s. You must download, install and activate the theme before activating this add-on.', 'etendard_bbpress' ), '<a href="' . esc_url( "https://www.themesdefrance.fr/themes/etendard" ) . '" target="_blank">', '</a>' ) ?></p>
				</div>
			<?php
		// bbPress isn't activated
		} else if ( ! is_plugin_active( 'bbpress/bbpress.php' ) ) {
			?>
				<div class="error">
					<p><?php echo sprintf( __( 'Etendard - Module bbPress has been deactivated as it requires %sbbPress plugin%s. You must download, install and activate the plugin before activating this add-on.', 'etendard_bbpress' ), '<a href="' . esc_url( "http://bbpress.org" ) . '" target="_blank">', '</a>' ) ?></p>
				</div>
			<?php
		}
	}
}