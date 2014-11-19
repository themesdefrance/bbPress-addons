<?php

/* Test if Galopin and bbPress are activated */

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
add_action( 'admin_init', 'galopin_bbpress_admin_init' );

// Admin notices definition
function galopin_bbpress_admin_init_notices() {
	
	// Galopin isn't activated
	if ( get_template() != 'Galopin' ) {
		?>
			<div class="error">
				<p><?php echo sprintf( __( 'Galopin - Module bbPress has been deactivated as it requires %sGalopin theme%s. You must download, install and activate the theme before activating this add-on.', 'galopin-bbpress' ), '<a href="' . esc_url( "https://www.themesdefrance.fr/themes/galopin" ) . '" target="_blank">', '</a>' ) ?></p>
			</div>
		<?php
	// bbPress isn't activated
	} else if ( ! is_plugin_active( 'bbpress/bbpress.php' ) ) {
		?>
			<div class="error">
				<p><?php echo sprintf( __( 'Galopin - Module bbPress has been deactivated as it requires %sbbPress plugin%s. You must download, install and activate the plugin before activating this add-on.', 'galopin-bbpress' ), '<a href="' . esc_url( "http://bbpress.org" ) . '" target="_blank">', '</a>' ) ?></p>
			</div>
		<?php
	}
}