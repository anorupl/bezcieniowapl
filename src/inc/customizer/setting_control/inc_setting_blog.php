<?php
 /**
 * File with setting and control in 'Blog' section
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */
	
	// ==============================================
    //  = Section title								=
    //  =============================================
 	$wp_customize->add_setting('wpg_blog_title', array(
		'default'        => __('Last post', 'wpg_theme'),
   		'capability' 		=> 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'

	));

	$wp_customize->add_control( 'wpg_blog_title', array(
		'settings' => 'wpg_blog_title',
		'label'   => __('Title section', 'wpg_theme'),
		'section'  => $blog_section_id,
		'type'    => 'text'
	));	
	// ==============================================
    //  = Number of post						=
    //  =============================================
	$wp_customize->add_setting( 'wpg_post_number',
		array(
			'default'           => 2,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wpg_sanitize_number_range',
			)
	);
	$wp_customize->add_control( 'wpg_post_number',
		array(
			'label'           => __( 'No of items', 'wpg_theme' ),
			'description'     => sprintf(__('Enter number between %1s and %2s .','wpg_theme'),'1','10' ),
			'section'         => $blog_section_id,
			'type'            => 'number',
			'priority'        => 100,
			'input_attrs'     => array( 'min' => 2, 'max' => 8, 'step' => 1, 'style' => 'width: 55px;' ),
			)
	);      
	
	// ==============================================
    //  = Select category					=
    //  =============================================
	$wp_customize->add_setting(
		'wpg_blog_category',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'wpg_intval'
			)
	);
	$wp_customize->add_control( 
		'wpg_blog_category', 
		array(
			'type'	=>	'select',
			'label' => __('Select Category','wpg_theme'),
			'description' => __('Select category to show in Section.','wpg_theme'),
			'section' => $blog_section_id,
			'choices' => wpg_category_lists(),
			)
	);
?>