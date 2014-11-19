<?php

/**
 * Set the template path for the bbPress templates.
 *
 * @since 1.0.0
 */
function galopin_bbp_get_template_path() {
	return GALOPIN_BBPRESS_DIR_PATH . 'template';
}

/**
 * Register the new template stack with bbPress.
 * This is really cool stuff.
 *
 * @since 1.0.0
 */
function galopin_bbp_register_theme_packages() {
	bbp_register_template_stack( 'galopin_bbp_get_template_path', 12 );
}
add_action( 'bbp_register_theme_packages', 'galopin_bbp_register_theme_packages' );