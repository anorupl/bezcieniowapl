<?php
/**
 * File with setting and control in 'Client' section
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */

 	// ==============================================
	//  = Show 							=
	//  =============================================  
	$wp_customize->add_setting('wpg_client_active', array(
		'default'        => false,
		'capability' => 'edit_theme_options',
	));
	
	$wp_customize->add_control(
		        new WPG_Customize_Control_Switch($wp_customize, 'wpg_client_active', array(

		                'settings' 	=> 'wpg_client_active',
		                'section'  	=> $client_section_id,
		                'label'    	=> __('Show section', 'wpg_theme'),
		                'type'		=> 'switch'
		            )
		        )
		);	
	
	
	
	
	
	// ==============================================
    //  = Section title						=
    //  =============================================
 	$wp_customize->add_setting('wpg_client_title', array(
		'default'        => __('Clients', 'wpg_theme'),
   		'capability' 		=> 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'

	));

	$wp_customize->add_control( 'wpg_client_title', array(
		'settings' => 'wpg_client_title',
		'label'   => __('Title section', 'wpg_theme'),
		'section'  => $client_section_id,
		'type'    => 'text'
	));	
	// ==============================================
    //  =  Section Description						=
    //  =============================================  
	$wp_customize->add_setting('wpg_client_desc', array(
		'default'        => '',
	    'sanitize_callback' => 'sanitize_text_field'
	));
		
	$wp_customize->add_control( 'wpg_client_desc', array(
		'settings' => 'wpg_client_desc',
		'label'   => __('Description', 'wpg_theme'),
		'section'  => $client_section_id,
		'type'    => 'textarea'
	)); 		
 
?>