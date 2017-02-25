<?php
/**
 * File with setting and control in 'Slider' section
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */

	// ==============================================
	//  = Show/Hidde 							=
	//  =============================================  
	$wp_customize->add_setting('wpg_slider_active', array(
		'default'        => false,
		'capability' => 'edit_theme_options',
	));
	
	$wp_customize->add_control(
		        new WPG_Customize_Control_Switch($wp_customize, 'wpg_slider_active', array(

		                'settings' 	=> 'wpg_slider_active',
		                'section'  	=> $slider_section_id,
		                'label'    	=> __('Show section', 'wpg_theme'),
		                'type'		=> 'switch'
		            )
		        )
	);	
 	// ==============================================
    //  = Number Slides							=
    //  =============================================
	$wp_customize->add_setting( 'wpg_slider_number',
		array(
			'default'           => 1,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wpg_sanitize_number_range',
			)
	);
	$wp_customize->add_control( 'wpg_slider_number',
		array(
			'label'           	=> __( 'No of items', 'wpg_theme' ),
			'description'     	=> sprintf(__('Enter number between %1s and %2s .Save and refresh the page if No of Blocks is changed.','wpg_theme'),'1','10' ),
			'section'         	=> $slider_section_id,
			'type'            	=> 'number',
			'priority'        	=> 100,
			'input_attrs'     	=> array( 'min' => 1, 'max' => 10, 'step' => 1, 'style' => 'width: 55px;' )
			)
	);


    // ======================================
    //  = Chose Slides =
    //  =====================================
    
    
	$slides_number = absint( get_theme_mod( 'wpg_slider_number', '1') );
	
	if ( $slides_number > 0 ) {
		for ( $i = 1; $i <= $slides_number; $i++ ) {
			$wp_customize->add_setting( "wpg_slide_$i",
				array(
					'default'           => 0,
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => 'wpg_intval',
					)
			);
		$wp_customize->add_control(
				new WPG_Custom_Dropdown( $wp_customize, "wpg_slide_$i", array(
					'label'           	=> __( 'Slide', 'wpg_theme' ) . ' #' . $i,
					'section'         	=> $slider_section_id,
					'type'            	=> 'wpg_custom_dropdown',
					'post_type'			=>	'slides',
					'priority'        	=> 100
					)
				)
			);		
		}
	}
	          	 
?>