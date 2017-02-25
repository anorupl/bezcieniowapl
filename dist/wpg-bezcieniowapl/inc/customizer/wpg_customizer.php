<?php
/**
 * Theme Customizer
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 *
 * @global object $wp_customize WP_Customize instance.
 *
 */

global $wp_customize;

/* Load necessary files with additional elements
 ************************************************/
require get_template_directory() . '/inc/customizer/helpers/inc_front_css.php';
require get_template_directory() . '/inc/customizer/helpers/inc_helpers.php';
require get_template_directory() . '/inc/customizer/helpers/inc_scripts_and_style.php';


if(isset($wp_customize)) {
	
	
	/* Load necessary files with additional elements only if custumizer on
	 ************************************************/
	require get_template_directory() . '/inc/customizer/helpers/inc_context.php';
	require get_template_directory() . '/inc/customizer/helpers/inc_sanitization.php';


	/* Load extends class WP_Customize_Control
	 ************************************************/

	// Class "Fonts_Dropdown_Google" - Custom control fonts field.
	require get_template_directory() . '/inc/customizer/custom_control_field/inc_field_fonts.php';

	// Class "WPG_Customize_Control_Checkbox_Multiple" - Custom control with mutli checbox.
	// niezbędne dla pola 
	require get_template_directory() . '/inc/customizer/custom_control_field/inc_multi_checbox.php';
	
	// Class "WPG_Customize_Control_Checkbox_Multiple_Sort"
	require get_template_directory() . '/inc/customizer/custom_control_field/inc_multisort_checbox.php';
	
	// Class "WPG_Customize_Control_Custom_Dropdown" - Custom control with custom dropdown.
	require get_template_directory() . '/inc/customizer/custom_control_field/inc_custom_dropdown.php';
	// Class "WPG_Customize_Control_Google_MAP".
	require get_template_directory() . '/inc/customizer/custom_control_field/inc_google_map.php';
	// Class "WPG_Customize_Control_Google_MAP".
	require get_template_directory() . '/inc/customizer/custom_control_field/inc_switch.php';
		
}

/**
 * Add customizations for this theme
 *
 * @since 1.0.0
 *
 * @param object $wp_customize WP_Customize instance
 * @return void
 */
function wpg_customizer_general($wp_customize) {


	// Modify existing controls and settings
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport = 'postMessage';

	// Add panel - Theme Settings
	$theme_panel_id = 'wpg_general';

	$wp_customize->add_panel( $theme_panel_id, array(
	   	'priority' 			=> '10',
	    'capability' 		=> 'edit_theme_options',
	    'theme_supports' 	=> '',
	    'title' 			=> __( 'Theme Settings', 'wpg_theme' )
	) );

	/* Add Section - to panel [Theme Settings]
	 * 1.Typography 	
	 * 2.Featured page	
	 * 3.Last work
	 * 4.Blog
	 * 5.Contact
	 * 6.Social networks link
	 * 7.Image header
	 * 8.stage
	 * 
	 ************************************************/
    // 1. Typography
    $font_section_id = 'wpg_typography_stc';

    $wp_customize->add_section( $font_section_id, array(
		'priority'   		=> '1',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Typography', 'wpg_theme' ),
	    'panel' 			=> $theme_panel_id,
	));	 
	// 2.Featured page	
	$page_featured_section_id = 'wpg_pagefeatured_stc';
	
    $wp_customize->add_section(  $page_featured_section_id, array(
		'priority'   		=> '4',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Page featured', 'wpg_theme' ),
	    'panel' 			=> $theme_panel_id,
	));				
	// 3.Last work
    $lastwork_section_id = 'wpg_lastwork_stc';

    $wp_customize->add_section( $lastwork_section_id, array(
		'priority'   		=> '6',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Last work', 'wpg_theme' ),
	    'panel' 			=> $theme_panel_id,
	));	
	// 4.Blog
    $blog_section_id = 'wpg_blog_stc';

    $wp_customize->add_section( $blog_section_id, array(
		'priority'   		=> '9',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __('Last post', 'wpg_theme'),
	    'panel' 			=> $theme_panel_id,
	));		
	// 5.Contact	
    $contact_section_id = 'wpg_contact_stc';

    $wp_customize->add_section( $contact_section_id, array(
		'priority'   		=> '10',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Contact', 'wpg_theme' ),
	    'panel' 			=> $theme_panel_id,
	));	
    // 6. Social networks link
    $social_network_id = 'wpg_social_stc';

    $wp_customize->add_section(  $social_network_id, array(
		'priority'   		=> '8',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Social networks', 'wpg_theme' ),
	    'panel' 			=> $theme_panel_id,
	));	
    // 7. Image header
    $image_header_id = 'wpg_image_header';

    $wp_customize->add_section(  $image_header_id, array(
		'priority'   		=> '3',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Background in header', 'wpg_theme' ),
	    'panel' 			=> $theme_panel_id,
	));		
	// 8.Realization Stages
	$stages_section_id = 'wpg_stages_stc';
	
	$wp_customize->add_section(  $stages_section_id, array(
		'priority'   		=> '4',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Realization Stages', 'wpg_theme' ),
		   'panel' 			=> $theme_panel_id,
	));	
	
	/* Add setting and control - Typography Section
	 * 1.Typography 	
	 * 2.Featured page	
	 * 3.Last work
	 * 4.Blog
	 * 5.Contact
	 * 6.Social networks link
	 * 7.Image header
	 * 8.Realization Stages
	 ************************************************/

	// 1. Typography
		require get_template_directory() . '/inc/customizer/setting_control/inc_setting_fonts.php';
	// 2. Featured page	(v.Dropdown select)
			//(v.Dropdown select)
			require get_template_directory() . '/inc/customizer/setting_control/featured/inc_setting_featured_page_dropdown.php';
						
	// 3. Last work	
		require get_template_directory() . '/inc/customizer/setting_control/inc_setting_lastwork.php';
	// 4. Blog
		require get_template_directory() . '/inc/customizer/setting_control/inc_setting_blog.php';
	// 5. Contact
		require get_template_directory() . '/inc/customizer/setting_control/inc_setting_contact.php';
	// 6.Social networks link	
		require get_template_directory() . '/inc/customizer/setting_control/inc_setting_social_net.php';
	// 7.Image header
		require get_template_directory() . '/inc/customizer/setting_control/slider/inc_setting_image_header.php';
	// 8.Realization Stages	
		require get_template_directory() . '/inc/customizer/setting_control/inc_setting_stages.php';
	

	/* Only if plugin on
	 * 
	 * Add Section - to panel [Theme Settings]
	 * 8.Slider			
	 * 9.Client
	 * 10.Testimonials
	 * 11.Offer
	 * -----------------------------
	 * 
	 * Add setting and control
	 * 8.Slider			
	 * 9.Client
	 * 10.Testimonials
	 * 11.Offer
	 ************************************************/	 	
	 if ( class_exists('helper')) {
	
		/* Add Section - to panel [Theme Settings]
		************************************************/
	   	
	   	// 8.Slider
	    $slider_section_id = 'wpg_slider_stc';
	
	    $wp_customize->add_section(  $slider_section_id, array(
			'priority'   		=> '2',
			'capability' 		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title'      		=> __( 'Slider', 'wpg_theme' ),
		    'panel' 			=> $theme_panel_id,
		));			
		// 9.Client
	    $client_section_id = 'wpg_client_stc';
		
	    $wp_customize->add_section( $client_section_id, array(
			'priority'   		=> '6',
			'capability' 		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title'      		=> __( 'Clients', 'wpg_theme' ),
		    'panel' 			=> $theme_panel_id,
		));		

		
		/* Add setting and control
		************************************************/
		
		// 8. Slider (v.Dropdown select)
			require get_template_directory() . '/inc/customizer/setting_control/slider/inc_setting_slider_dropdown.php';
			//require get_template_directory() . '/inc/customizer/setting_control/slider/inc_setting_slider.php';
		// 9.Client
			require get_template_directory() . '/inc/customizer/setting_control/inc_setting_client.php';
	}			   
} 								
	

add_action( 'customize_register', 'wpg_customizer_general' );



/* Simple function to delete transient 
 * if custumizer save query in transient.  
 */
function customizer_delete_transient() {
     delete_transient( 'name_transient' );
}
//add_action('publish_post', 'customizer_delete_transient');
//add_action( 'transition_post_status', 'customizer_delete_transient', 10, 3 );
//add_action( 'customize_save_after','customizer_delete_transient');
?>