<?php

function etendard_bbp_default_styles( $styles ) {
	$styles['bbp-default']['file'] = 'css/bbpress.css';

	return $styles;
}
add_filter( 'bbp_default_styles', 'etendard_bbp_default_styles' );

/**
 * Remove the Jetpack Infinite Scroll from the
 * forum archive.
 *
 * @since 1.0.0
 */
function etendard_bbp_jetpack_remove_infinite_scroll() {
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) && ( bbp_is_forum_archive() || bbp_is_topic_archive() || bbp_is_topic_tag() ) ) {
		wp_dequeue_script( 'the-neverending-homepage' );
	}
}
add_action( 'wp_enqueue_scripts', 'etendard_bbp_jetpack_remove_infinite_scroll' );


/**
 * Filter the search results query to show more results.
 *
 * @since 1.0.0
 */
function etendard_bbp_filter_search_results_per_page( $integer ) {

	if ( bbp_is_search() ) {
		$integer = absint( apply_filters( 'etendard_bbp_search_results_per_page', 20 ) );
	}

	return (int) $integer;
}
add_action( 'bbp_get_replies_per_page', 'etendard_bbp_filter_search_results_per_page' );