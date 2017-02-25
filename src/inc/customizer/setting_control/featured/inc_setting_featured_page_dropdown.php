<?php
/**
 * File with setting and control in 'Page Featured' section
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */
  
  
	// ==============================================
	//  = Show/Hidde 							=
	//  =============================================  
	$wp_customize->add_setting('wpg_pagefeatured_active', array(
		'default'        => false,
		'capability' => 'edit_theme_options',
	));
	
	$wp_customize->add_control(
		        new WPG_Customize_Control_Switch($wp_customize, 'wpg_pagefeatured_active', array(

		                'settings' 	=> 'wpg_pagefeatured_active',
		                'section'  	=> $page_featured_section_id,
		                'label'    	=> __('Show section', 'wpg_theme'),
		                'type'		=> 'switch'
		            )
		        )
	);

    // ======================================
    //  = Chose Slides =
    //  =====================================
	for ( $i = 1; $i <= 2; $i++ ) {
		$wp_customize->add_setting( "wpg_pagefeatured_$i",
			array(
				'default'           => isset( $default[ 'wpg_pagefeatured_' . $i ] ) ? $default[ 'wpg_pagefeatured_' . $i ] : '',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'wpg_intval',
				)
		);
		$wp_customize->add_control( "wpg_pagefeatured_$i", array(
			'label' => __( 'Page', 'wpg_theme' ) . ' #' . $i,
			'section' => $page_featured_section_id,
			'type' => 'dropdown-pages',
			'allow_addition' => true,
		) );	
	}	         	 
?>