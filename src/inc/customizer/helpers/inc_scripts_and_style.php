<?php
/**
* File with functions to registration scripts and css in Customizer
*
* @package wpg_bezcieniowa_pl
* @since 1.0.1
*/


/**
* Register scripts for custom control in Theme Customizer [left sidebar]
*
* Add customizer.css, theme-customize.js and set variables for script
*
* @since 1.0.1
* @link https://codex.wordpress.org/Plugin_API/Action_Reference/customize_controls_enqueue_scripts
*
*/
function custom_customize_enqueue() {

	// Register google map api
	wp_enqueue_script( 'google_map_api', add_query_arg( 'key', get_theme_mod('wpg_map_apikey', ''), 'https://maps.googleapis.com/maps/api/js?'));

	// Register the script
	wp_enqueue_script( 'wpg_customizer_js', get_template_directory_uri() . '/inc/customizer/assets/js/theme-customize.js', '','', true);

	// Set variables for script
	wp_localize_script( 'wpg_customizer_js', 'wpgCustomizerFontsL10n', set_font_list(false, true));

	// Register the css style
	wp_enqueue_style( 'wpg_css_control', get_template_directory_uri() . '/inc//customizer/assets/css/customizer.css');

}
add_action( 'customize_controls_enqueue_scripts', 'custom_customize_enqueue' );



/**
* Register in head section stylesheet URL with google font families
*
* @since 1.0.1
*/
function google_font_url() {

	$fonts = array();

	if (get_theme_mod('wpg_body_font') == 'google') {

		$fonts[] = get_theme_mod('wpg_body_google_font','Open Sans') .':' . str_replace( 'regular', '400',get_theme_mod( 'wpg_body_google_variants', 'regular'));
	}
	if (get_theme_mod('wpg_heading_font') == 'google') {

		$fonts[] = get_theme_mod('wpg_heading_google_font','Oswald') .':' . str_replace( 'regular', '400',get_theme_mod( 'wpg_heading_google_variants', 'regular'));
	}

	if ( !empty( $fonts )) {
		$query_args = array(
			'family' => str_replace( " ", "+", implode( '|', array_values( $fonts ) ) ),
			'subset' => implode( ',', get_theme_mod( 'google_subsets', array('latin-ext')))
		);

		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'google-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
	}
}
add_action('wp_enqueue_scripts', 'google_font_url');
?>
