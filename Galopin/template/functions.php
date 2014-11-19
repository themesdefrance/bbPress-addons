<?php

function galopin_bbp_default_styles( $styles ) {
	$styles['bbp-default']['file'] = 'css/bbpress.css';

	return $styles;
}
add_filter( 'bbp_default_styles', 'galopin_bbp_default_styles' );

/* Get Étendard main color */

if(!function_exists('galopin_bbpress_styles')){
	function galopin_bbpress_styles(){
		if (get_option('galopin_color')){
			$color = apply_filters('galopin_color', get_option('galopin_color'));
			
			require_once get_template_directory() . '/admin/color_functions.php';
			$hsl = galopin_RGBToHSL(galopin_HTMLToRGB($color));
			if ($hsl->lightness > 180){
				$contrast = '#333';
			}
			else{
				$contrast = apply_filters('galopin_color_contrast', '#fff');
			}
			
			$hsl->lightness -= 30;
			$complement = apply_filters('galopin_color_complement', galopin_HSLToHTML($hsl->hue, $hsl->saturation, $hsl->lightness));
		}
		else{ // Default color
			$color = '#e54c3c';
			$complement = '#c73829';
			$contrast = '#fff';
		} ?>
		
		<style type="text/css">
			#bbpress-forums a{
				color: <?php echo $color; ?>;
			}
			#bbpress-forums button[type='submit']{
				background: <?php echo $color; ?> !important;
				color: <?php echo $contrast; ?> !important;
			}
			
			button[type='submit']:hover{
				background:<?php echo $complement; ?> !important;
			}
		</style>
		
		<?php
	}
}
add_action('wp_head','galopin_bbpress_styles', 98);

/**
 * Remove the Jetpack Infinite Scroll from the
 * forum archive.
 *
 * @since 1.0.0
 */
function galopin_bbp_jetpack_remove_infinite_scroll() {
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) && ( bbp_is_forum_archive() || bbp_is_topic_archive() || bbp_is_topic_tag() ) ) {
		wp_dequeue_script( 'the-neverending-homepage' );
	}
}
add_action( 'wp_enqueue_scripts', 'galopin_bbp_jetpack_remove_infinite_scroll' );


/**
 * Filter the search results query to show more results.
 *
 * @since 1.0.0
 */
function galopin_bbp_filter_search_results_per_page( $integer ) {

	if ( bbp_is_search() ) {
		$integer = absint( apply_filters( 'galopin_bbp_search_results_per_page', 20 ) );
	}

	return (int) $integer;
}
add_action( 'bbp_get_replies_per_page', 'galopin_bbp_filter_search_results_per_page' );