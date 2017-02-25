<?php
/**
 * File with context functions
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */


 /**
  * Context functions
  *
  * Context functions for wpg_body_google_font. Checks if option 'google' is selected
  *
  * @since 1.0.0
  *
  * @param object $control
  * @return bool
  */
function wpg_body_font_field($control) {

	$option = $control->manager->get_setting('wpg_body_font');
	return $option->value() == 'google';
}


/**
 * Context functions
 *
 * Context functions for wpg_heading_google_font. Checks if option 'google' is selected
 *
 * @since 1.0.0
 *
 * @param object $control
 * @return bool
 */
function wpg_heading_font_field($control) {
	$option = $control->manager->get_setting('wpg_heading_font');
	return $option->value() == 'google';
}

/**
 * Context functions
 *
 * Context functions for 'google_subsets'. Checks if option 'google' is selected
 *
 * @since 1.0.0
 *
 * @param object $control
 * @return bool
 */
function wpg_subset_field($control) {

	$option 	= $control->manager->get_setting('wpg_heading_font');
	$option_two = $control->manager->get_setting('wpg_body_font');

	return ($option->value() == 'google' || $option_two->value() == 'google') ? true : false;


}





/**
 * Context functions
 *
 * Context functions for on/off section
 *
 * @since 1.0.0
 *
 * @param object $control
 * @return bool
 */
function wpg_featured_term_active($control) {

	$option = $control->manager->get_setting('wpg_featured_term');
	
	
	return $option->value() !== 0;
}

/**
 * Context functions
 *
 * Context functions for how many slides in slider show
 *
 * @since 1.0.0
 *
 * @param object $control
 * @return bool
 */
function wpg_slider_active($control) {

	$option = $control->manager->get_setting('wpg_slider');
	return $option->value() !== 0;
}

/**
 * Context functions
 *
 * Context functions for show slider
 *
 * @since 1.0.0
 *
 * @param object $control
 * @return bool
 */
function wpg_show_slider($control) {

	$option = $control->manager->get_setting('wpg_slider_active');
	return $option->value() == true;
}
/**
 * Context functions
 *
 * Context functions for hide slider
 *
 * @since 1.0.0
 *
 * @param object $control
 * @return bool
 */
function wpg_hide_slider($control) {

	$option = $control->manager->get_setting('wpg_slider_active');
	return $option->value() == false;
}






?>