<?php

/**
 * Test if Toutatis and bbPress are activated
 * 
 * @package bbPress Toutatis Addon
 * @since 1.0.0
 */

if(!function_exists('toutatis_bbpress_admin_init')){
	function toutatis_bbpress_admin_init() {
	
		if ( get_template() != 'Toutatis' || ! is_plugin_active( 'bbpress/bbpress.php' ) ) {
	
			// Don't show any notice when the plugin was activated
			unset( $_GET['activate'] );
	
			// Display a notice saying that Toutatis or bbPress is required
			add_action( 'admin_notices', 'toutatis_bbpress_admin_init_notices' );
	
			// Deactivates the plugin, as Toutatis or bbPress is not currently active
			deactivate_plugins( TOUTATIS_BBPRESS_BASENAME );
		}
	}
}
add_action( 'admin_init', 'toutatis_bbpress_admin_init' );

/**
 * Custom admin notices if Toutatis or bbPress aren't activated
 * 
 * @package bbPress Toutatis Addon
 * @since 1.0.0
 */

if(!function_exists('toutatis_bbpress_admin_init_notices')){
	function toutatis_bbpress_admin_init_notices() {
		
		// Toutatis isn't activated
		if ( get_template() != 'Toutatis' ) {
			?>
				<div class="error">
					<p><?php echo sprintf( __( 'Toutatis - Module bbPress has been deactivated as it requires %sToutatis theme%s. You must download, install and activate the theme before activating this add-on.', 'toutatis_bbpress' ), '<a href="' . esc_url( "https://www.themesdefrance.fr/themes/toutatis" ) . '" target="_blank">', '</a>' ) ?></p>
				</div>
			<?php
		// bbPress isn't activated
		} else if ( ! is_plugin_active( 'bbpress/bbpress.php' ) ) {
			?>
				<div class="error">
					<p><?php echo sprintf( __( 'Toutatis - Module bbPress has been deactivated as it requires %sbbPress plugin%s. You must download, install and activate the plugin before activating this add-on.', 'toutatis_bbpress' ), '<a href="' . esc_url( "http://bbpress.org" ) . '" target="_blank">', '</a>' ) ?></p>
				</div>
			<?php
		}
	}
}