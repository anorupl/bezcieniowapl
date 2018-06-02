<?php
/**
* File with setting and control in 'Terms message"
*
* @package wpg_bezcieniowa_pl
* @since 1.0.1
*/

// ==============================================
//  = Show/Hidde =
//  =============================================
$wp_customize->add_setting('wpg_terms_active', array(
	'default'    => false,
	'capability' => 'edit_theme_options',
));

$wp_customize->add_control(
	new WPG_Customize_Control_Switch($wp_customize, 'wpg_terms_active', array(

		'settings' => 'wpg_terms_active',
		'section'  => $terms_section_id,
		'label'    => __('Show section', 'wpg_theme'),
		'type'=> 'switch'
	))
);

// ======================================
//  = Chose cookies page =
//  =====================================
$wp_customize->add_setting( "wpg_cookies_page",array(
	'default'           => '',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'wpg_intval',
));
$wp_customize->add_control( "wpg_cookies_page",
array(
	'label'   => __( 'Page', 'wpg_theme' ),
	'section' => $terms_section_id,
	'type'    => 'dropdown-pages',
	'allow_addition' => true,
));
?>
