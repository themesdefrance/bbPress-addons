<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Set the template path for the custom bbPress template.
 *
 * @package bbPress Balzac Addon
 * @since 1.0.0
 */
function balzac_bbp_get_template_path() {
	return BALZAC_BBPRESS_DIR_PATH . 'template';
}

/**
 * Register the new template stack with bbPress.
 * This is really cool stuff.
 *
 * @package bbPress Balzac Addon
 * @since 1.0.0
 */
function balzac_bbp_register_theme_packages() {
	bbp_register_template_stack( 'balzac_bbp_get_template_path', 12 );
}
add_action( 'bbp_register_theme_packages', 'balzac_bbp_register_theme_packages' );