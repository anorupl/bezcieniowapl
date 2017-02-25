<?php
/**
 * WPG theme functions and definitions.
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

if ( ! function_exists( 'wpg_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since 1.0.0
 */
function wpg_setup() {

	if ( ! isset( $content_width ) ) {
		$content_width = 1920;
	}
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wpg, use a find and replace
	 * to change 'wpg' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wpg_theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_post_type_support( 'attachment:audio', 'thumbnail' );
	add_post_type_support( 'attachment:video', 'thumbnail' );
	
	/*
	 * Update image size;
	 */	
	update_option( 'thumbnail_size_w', 320 );
	update_option( 'thumbnail_size_h', 480 );
	update_option( 'medium_size_w', 768);
	update_option( 'medium_size_h', 1152 );	
	update_option( 'large_size_w', 1440);
	update_option( 'large_size_h', 2160 );		

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'header' 			=> esc_html__( 'Header Menu', 'wpg_theme' ),
	));


	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'flex-width'  => true,
	) );
	
	// Add custom css to tinymce
	add_editor_style( array( 'css/editor-style.css') );
	

}
add_action( 'after_setup_theme', 'wpg_setup' );
endif; // wpg_setup

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function wpg_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'wpg_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since 	1.0.0
 *
 */
function wpg_enqueue() {

	//css
	wp_enqueue_style( 'wpg-style', get_stylesheet_uri() );
    wp_enqueue_style( 'ie8', get_stylesheet_directory_uri() . "/css/ie8.css");
	wp_style_add_data( 'ie8', 'conditional', 'lt IE 9' );

	//deregister
	wp_deregister_script( 'jquery' );

	//register
	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js');
	wp_register_script( 'mapa-api', add_query_arg( array( 'key' => 'AIzaSyDKtUktvu1K8ZCluHb6FDzqMcQSTEpNwS4' ), 'https://maps.googleapis.com/maps/api/js?'));
	wp_register_script('google-map', 	get_template_directory_uri() . '/js/mapa.min.js', 				array('jquery'), '20120206', true);

	//enqueue
	wp_enqueue_script( 'jquery' );
	
	// lt IE 9
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/assets/html5shiv.min.js', 	array('jquery'), '20120206', false );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'imgGallery', 	get_template_directory_uri() . '/js/assets/imgGallery.min.js', 	array('jquery'), '20120206', true );
	wp_enqueue_script( 'slick', 		get_template_directory_uri() . '/js/assets/slick.min.js', 		array('jquery'), '20120206', true );
	
	wp_enqueue_script( 'wpg-main-js',	get_template_directory_uri() . '/js/main.min.js', 				array('jquery'), '20120206', true );

	$datalang = array(
	  	'enable_drag' 		=> __('Enable drag', 'wpg_theme'),
		'disable_drag' 		=> __('Disable drag', 'wpg_theme'),

		'next' 			=> __('Previous Image (left arrow key)', 'wpg_theme'),
		'prev' 			=> __('Next Image (right arrow key)', 'wpg_theme'),
		'of'			=> __('of','wpg_theme'),
		'close' 		=> __('Close (Escape key)', 'wpg_theme'),
		'load' 			=> __('Loading ...', 'wpg_theme'),
		'image' 		=> __('Image', 'wpg_theme'),
		'error_image' 	=> __('it cannot be loaded.', 'wpg_theme'),
		);
  	wp_localize_script( 'wpg-main-js', 'datalanuge', $datalang );


	// Google map 
	if (get_theme_mod('wpg_contact_maps') == true){
			wp_enqueue_script('mapa-api');
			wp_enqueue_script('google-map');
	}

	// Comment
	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wpg_enqueue' );


/**
 * Register widget area.
 *
 * @since 	1.0.0
 * @link 	https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 */
function wpg_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Overlay', 'wpg_theme' ),
		'id'            => 'wpg-sidebar-overlay',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'wpg_widgets_init' );

/*
 * Include file with customizer.
 */
require get_template_directory() . '/inc/customizer/wpg_customizer.php';

/*
 * Include file with custom functions that act independently of the theme.
 */
require get_template_directory() . '/inc/extras.php';

/*
 * Include file with the custom functions that can be used directly in theme file.
 */
require get_template_directory() . '/inc/template-tags.php';
/*
 * Include file with custom functions for post format.
 */
require get_template_directory() . '/inc/fn_post_format.php';

/*
 * Include file with filter rwmb_meta_boxes.
 */
require get_template_directory() . '/inc/meta_box.php';

/*
 * Include file with functions that add support to  plugins.
 */
require get_template_directory() . '/inc/plugin-support.php';

?>