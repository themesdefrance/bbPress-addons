<?php

function balzac_bbp_default_styles( $styles ) {
	$styles['bbp-default']['file'] = 'css/bbpress.css';

	return $styles;
}
add_filter( 'bbp_default_styles', 'balzac_bbp_default_styles' );

/* Get Balzac main color */

if(!function_exists('balzac_bbpress_styles')){
	function balzac_bbpress_styles(){
		if (get_option('balzac_color')){
			$color = apply_filters('balzac_color', get_option('balzac_color'));

			require_once get_template_directory() . '/admin/functions/color-functions.php';
			$hsl = balzac_RGBToHSL(balzac_HTMLToRGB($color));
			if ($hsl->lightness > 180){
				$contrast = '#333';
			}
			else{
				$contrast = apply_filters('balzac_color_contrast', '#fff');
			}

			$hsl->lightness -= 30;
			$complement = apply_filters('balzac_color_complement', balzac_HSLToHTML($hsl->hue, $hsl->saturation, $hsl->lightness));
		}
		else{ // Default color
			$color = '#3ab2a0';
			$complement = '#2B8577';
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

			#bbpress-forums button[type='submit']:hover{
				background:<?php echo $complement; ?> !important;
			}
			textarea.wp-editor-area:focus{
		      -webkit-box-shadow: 0 0 5px <?php echo $color; ?> !important;
			  box-shadow: 0 0 5px <?php echo $color; ?> !important;
	      }
			
		</style>

		<?php
	}
}
add_action('wp_head','balzac_bbpress_styles', 98);

if(!function_exists('balzac_custom_header_archive_title')){
	function balzac_custom_header_archive_title(){
		if(is_archive()){
			return get_the_title();
		}
	}
}
add_filter('balzac_header_archive_title','balzac_custom_header_archive_title');

/**
 * Remove the Jetpack Infinite Scroll from the
 * forum archive.
 *
 * @since 1.0.0
 */
function balzac_bbp_jetpack_remove_infinite_scroll() {
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) && ( bbp_is_forum_archive() || bbp_is_topic_archive() || bbp_is_topic_tag() ) ) {
		wp_dequeue_script( 'the-neverending-homepage' );
	}
}
add_action( 'wp_enqueue_scripts', 'balzac_bbp_jetpack_remove_infinite_scroll' );


/**
 * Filter the search results query to show more results.
 *
 * @since 1.0.0
 */
function balzac_bbp_filter_search_results_per_page( $integer ) {

	if ( bbp_is_search() ) {
		$integer = absint( apply_filters( 'balzac_bbp_search_results_per_page', 20 ) );
	}

	return (int) $integer;
}
add_action( 'bbp_get_replies_per_page', 'balzac_bbp_filter_search_results_per_page' );