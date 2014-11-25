<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Set the template path for the custom bbPress template.
 *
 * @package bbPress Galopin Addon
 * @since 1.0.0
 */
function galopin_bbp_get_template_path() {
	return GALOPIN_BBPRESS_DIR_PATH . 'template';
}

/**
 * Register the new template stack with bbPress.
 * This is really cool stuff.
 *
 * @package bbPress Galopin Addon
 * @since 1.0.0
 */
function galopin_bbp_register_theme_packages() {
	bbp_register_template_stack( 'galopin_bbp_get_template_path', 12 );
}
add_action( 'bbp_register_theme_packages', 'galopin_bbp_register_theme_packages' );