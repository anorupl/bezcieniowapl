<?php
/**
 * File with setting and control for stages section
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */
 
	// ==============================================
	//  = Show/Hidde 							=
	//  =============================================  
	$wp_customize->add_setting('wpg_stages_active', array(
		'default'        => false,
		'capability' => 'edit_theme_options',
	));
	
	$wp_customize->add_control(
		        new WPG_Customize_Control_Switch($wp_customize, 'wpg_stages_active', array(

		                'settings' 	=> 'wpg_stages_active',
		                'section'  	=> $stages_section_id,
		                'label'    	=> __('Show section', 'wpg_theme'),
		                'type'		=> 'switch'
		            )
		        )
	);		

	
	
	// ==============================================
    //  = Section title						=
    //  =============================================
 	$wp_customize->add_setting('wpg_stages_title', array(
		'default'        => __('Realization Stages', 'wpg_theme'),
   		'capability' 		=> 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'

	));

	$wp_customize->add_control( 'wpg_stages_title', array(
		'settings' => 'wpg_stages_title',
		'label'   => __('Title section', 'wpg_theme'),
		'section'  => $stages_section_id,
		'type'    => 'text'
	));	
	// ==============================================
    //  =  Section Description						=
    //  =============================================  
	$wp_customize->add_setting('wpg_stages_desc', array(
		'default'        => '',
	    'sanitize_callback' => 'sanitize_text_field'
	));
		
	$wp_customize->add_control( 'wpg_stages_desc', array(
		'settings' => 'wpg_stages_desc',
		'label'   => __('Description', 'wpg_theme'),
		'section'  => $stages_section_id,
		'type'    => 'textarea'
	)); 		
		
 	// ==============================================
    //  = Number of items						=
    //  =============================================
	$wp_customize->add_setting( 'wpg_stages_number',
		array(
			'default'           => 2,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wpg_sanitize_number_range',
			)
	);
	$wp_customize->add_control( 'wpg_stages_number',
		array(
			'label'           => __( 'No of items', 'wpg_theme' ),
			'description'     => sprintf(__('Enter number between %1s and %2s .Save and refresh the page if No of Blocks is changed.','wpg_theme'),'1','10' ),
			'section'         => $stages_section_id,
			'type'            => 'number',
			'input_attrs'     => array( 'min' => 2, 'max' => 10, 'step' => 2, 'style' => 'width: 55px;' ),
			)
	);
	
	
    // ======================================
    //  = Stages =
    //  =====================================
	$stages_number = absint( get_theme_mod( 'wpg_stages_number', '2') );
	
	if ( $stages_number > 1 ) {
		for ( $i = 1; $i <= $stages_number; $i++ ) {
		  
		    // ======================================
		    //  = Stage title =
		    //  =====================================
		 	$wp_customize->add_setting("wpg_stages_title_$i", array(
				'default'        	=> '',
		        'sanitize_callback' => 'sanitize_text_field'
			));
		
			$wp_customize->add_control( "wpg_stages_title_$i", array(
				'settings' 	=> "wpg_stages_title_$i",
				'label'   	=> __('Stage title', 'wpg_theme') . ' #' . $i,
				'section'  	=> $stages_section_id,
				'type'    	=>'text'
			)); 
			
   			// ======================================
		    //  = Stages Description =
		    //  =====================================	
		 	$wp_customize->add_setting("wpg_stages_desc_$i", array(
				'default'        => '',
		        'sanitize_callback' => 'sanitize_text_field'
			));
		
			$wp_customize->add_control( "wpg_stages_desc_$i", array(
				'settings' => "wpg_stages_desc_$i",
				'label'   => __('Description', 'wpg_theme') . ' #' . $i,
				'section'  => $stages_section_id,
				'type'    => 'textarea'
			)); 	
		}
	}	    
?>