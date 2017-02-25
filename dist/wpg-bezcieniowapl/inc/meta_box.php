<?php

add_filter( 'rwmb_meta_boxes', 'wpg_register_meta_boxes' );

function wpg_register_meta_boxes( $meta_boxes ) {
	
	$prefix = 'wpg_';
	
    // 1st meta box
    $meta_boxes[] = array(
        'id'         => 'wpg_offer_metabox',
        'title'      => __('Offer page section','wpg_theme'),
        'post_types' => array( 'offer'),
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
						array(
							'name'    => __( 'Category witch gallery offer', 'wpg_theme' ),
							'id'      => $prefix. 'gallery_offer',
							'type'    => 'taxonomy_advanced',
							// Taxonomy name
							'options'=> array(
								'taxonomy' => 'gallery',
								'type'=> 'select'
							),
							'multiple'    => false,
						)
        )
    );
	// 2nd meta box
	$meta_boxes[] = array(
			'id'         => 'wpg_gallery_metabox',
			'title'  => __('Offer page section','wpg_theme'),
			'post_types' => array( 'post_gallery'),
	        'context'    => 'normal',
	        'priority'   => 'high',		
			'fields' => array(
				array(
					'name'        => __( 'Page with offer', 'wpg_theme' ),
					'id'          => $prefix. 'link_offer',
					'type'        => 'post',
					'multiple'    => false,
					'post_type'   => array( 'offer'),
					'field_type'  => 'select',
					'placeholder' => __( 'Select an Offer', 'wpg_theme' ),
					'query_args'  => array(
						'post_status'    => 'publish',
						'posts_per_page' => - 1,
					),
				),
			),
		);
	// 3nd meta box
	$meta_boxes[] = array(
			'id'         => 'wpg_slide_metabox',
			'title'  => __('Slide url','wpg_theme'),
			'post_types' => array( 'slides'),
	        'context'    => 'normal',
	        'priority'   => 'high',		
			'fields' => array(
				array(
					'name'        => __( 'Slide url', 'wpg_theme' ),
					'id'          => $prefix. 'url_slide',
					'type' => 'url'					
				),
				array(
						'name'    => __( 'Select background style', 'wpg_theme' ),
						'id'      => $prefix.'select_bg',
						'type'    => 'select',
						'options' => array(
							'cover' => __( 'Center', 'wpg_theme' ),
							'auto 100%' => __( 'Left', 'wpg_theme' ),
						),
					),	
				array(
						'name'    => __( 'Select color style', 'wpg_theme' ),
						'id'      => $prefix. 'select_color',
						'type'    => 'select',
						'options' => array(
							'slide-bright' => __( 'White', 'wpg_theme' ),
							'slide-dark' => __( 'Dark', 'wpg_theme' ),
						),
					),									
			),
		);		
	// 4nd meta box
	$meta_boxes[] = array(
			'id'         => 'wpg_client_metabox',
			'title'  => __('Client url','wpg_theme'),
			'post_types' => array( 'client'),
	        'context'    => 'normal',
	        'priority'   => 'high',		
			'fields' => array(
				array(
					'name' => __('Client url','wpg_theme'),
					'id'   => $prefix. 'url_client',
					'type' => 'url'					
				)
			),
		);			
    return $meta_boxes;
}
?>