<?php
/**
 * Template functionality.
 *
 * @package Eighties Add-on - bbPress
 *
 * This file contains functionality that adds a
 * new template stack for bbPress.
 */

/**
 * Set the template path for the bbPress templates.
 *
 * @since 1.0.0
 */
function etendard_bbp_get_template_path() {
	return ETENDARD_BBPRESS_DIR_PATH . 'template';
}

/**
 * Register the new template stack with bbPress.
 * This is really cool stuff.
 *
 * @since 1.0.0
 */
function etendard_bbp_register_theme_packages() {
	bbp_register_template_stack( 'etendard_bbp_get_template_path', 12 );
}
add_action( 'bbp_register_theme_packages', 'etendard_bbp_register_theme_packages' );