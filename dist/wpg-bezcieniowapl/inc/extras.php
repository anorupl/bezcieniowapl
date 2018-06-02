<?php
 /**
 * Custom functions that act independently of the theme.
 *
 * Some of the functionality here could be replaced by core features:

 * Base function
 * -	wpg_post_per_page
 *	-	wpg_body_class
 *	-	wpg_post_class
 * -	wpg_widget_nav_menu
 * -	wpg_excerpt_length
 * -	wpg_no_title

 * Add wpg theme function
 * -	wpg_rwd_video_container
 * -	add_video_wmode_transparent
 * -	wpg_breadcrumbs
 * -	wpg_adjacent_post_sort

 * Add Remove
 * -	print_emoji_detection_script
 * -	print_emoji_styles
 * - 	wpg_filter_image_sizes

 * Admin
 * -	wpg_table_plugins_tinymce
 * -	wpg_buttons_tinymce
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.1
 */


function wpg_post_per_page( $query ) {

   if ( $query->is_main_query() ) {

	   $sticky = get_option('sticky_posts') ;
	   $post_to_exclude[] = end($sticky);

	   $query->set('ignore_sticky_posts', 1);
	   $query->set('post__not_in', $post_to_exclude);

	}

	if ( $query->is_main_query() && $query->is_home() && !is_paged()) {

		if (get_theme_mod('wpg_blog_category','0') !== 0)	{
			$query->set( 'cat', get_theme_mod('wpg_blog_category'));
		}
		$query->set('posts_per_page', get_theme_mod('wpg_post_number','2'));

	} elseif ($query->is_main_query() && $query->is_home() ) {

		if (get_theme_mod('wpg_blog_category','0') !== 0)	{
			$query->set( 'cat', get_theme_mod('wpg_blog_category'));
		}
		$query->set( 'offset', get_theme_mod('wpg_post_number','2') );

	} elseif (is_post_type_archive('offer') || is_tax('gallery')) {

		$query->set('posts_per_page', -1);
		$query->set('orderby', 'menu_order');
		$query->set('order', 'ASC');

	}
	elseif (is_post_type_archive() || is_tax()) {
		$query->set('posts_per_page', -1);
	}
	return;
}
add_action( 'pre_get_posts', 'wpg_post_per_page' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since 	1.0.0
 * @see 	Function Reference/body class
 * @link 	https://codex.wordpress.org/Function_Reference/body_class
 *
 * @param 	array $classes Classes for the body element.
 */
function wpg_body_class($class) {

	$class[] = 'hfeed site';

	if (is_singular()){
		$class[] = 'singular';
	}
	return $class;
}
add_filter( 'body_class', 'wpg_body_class' );


/**
 * Adds custom classes to the array of body classes.
 *
 * @since 	1.0.0
 * @see 	Function Reference/body class
 * @link 	https://codex.wordpress.org/Function_Reference/body_class
 *
 * @param 	array $classes Classes for the body element.
 */
function wpg_post_class($class) {

	if( is_front_page() && !is_paged()) {
		$class[] = 'col-6';
	}
	elseif (is_singular() || is_post_type_archive('offer')) {
		$class[] = 'clear-both';
	} else {
		$class[] = 'col-9 offset-3';
	}

	// return the $class array
	return $class;
}
add_filter( 'post_class', 'wpg_post_class' );

/**
 * Filtr set default container for widget menu
 *
 * @since 	1.0.0
 * @see 	Filter the arguments for the Custom Menu widget
 * @link	https://developer.wordpress.org/reference/hooks/widget_nav_menu_args/
 */
function wpg_widget_nav_menu($nav_menu_args, $nav_menu, $args) {
		$args = array(
			'container' => 'nav',
		);
		return $args;
}
add_filter( 'widget_nav_menu_args', 'wpg_widget_nav_menu', 10, 3 );

/**
 * Filtr change length excerpt.
 *
 * Change length in main_query to 19 in other is 55.
 *
 * @since 1.0.0
 *
 * @param int $length
 */
function wpg_excerpt_length( $length ) {
		if (is_main_query())
		return 19;
		else
		return 55;
}
add_filter( 'excerpt_length', 'wpg_excerpt_length', 999 );


/**
 * Filtr mark Posts/Pages as Untiled when no title is used
 *
 * @since 	1.0.0
 * @param 	string $title
 * @return 	string
 */
function wpg_no_title( $title ) {


  return $title == '' ? __('Untitled', 'wpg_theme') : $title;
}
add_filter( 'the_title', 'wpg_no_title' );

/*
 * Add wpg theme function
 *==========================================*/

/**
 * Filtr add responsive container to video embeds.
 *
 * @since 	1.0.0
 * @param 	string $html Code of player
 * @param 	string $url Link to embeds providers.
 * @return 	string
 */
function wpg_rwd_video_container($html, $url='') {

	$wrapped = '<div class="fluid-width-video-wrapper">' . $html . '</div>';

	if ( empty( $url ) && 'video_embed_html' == current_filter() ) { // Jetpack
		$html = $wrapped;
	} elseif ( !empty( $url ) ) {
		$players = array( 'youtube', 'youtu.be', 'vimeo', 'dailymotion', 'hulu', 'blip.tv', 'wordpress.tv', 'viddler', 'revision3' );
		foreach ( $players as $player ) {
			if ( false !== strpos( $url, $player ) ) {
					$html = $wrapped;
				break;
			}
		}
	}
		return $html;
}
add_filter( 'embed_oembed_html', 'wpg_rwd_video_container', 10, 3 );
add_filter( 'video_embed_html', 'wpg_rwd_video_container' ); // Jetpack


/**
 * Filtr add wmode transparent to video embeds.
 *
 * @since 	1.0.0
 * @param 	string $html Code of player.
 * @param 	string $url Link to embeds providers.
 * @param	array $attr.
 *
 * @return 	string
 */
function add_video_wmode_transparent($html, $url, $attr) {

if ( strpos( $html, "<embed src=" ) !== false )
   { return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html); }
elseif ( strpos ( $html, 'feature=oembed' ) !== false )
   { return str_replace( 'feature=oembed', 'feature=oembed&wmode=opaque', $html ); }
else
   { return $html; }
}
add_filter( 'embed_oembed_html', 'add_video_wmode_transparent', 10, 3);

function wpg_breadcrumbs() {

  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '&raquo;'; // delimiter between crumbs
  $home = __('Home','wpg_theme'); // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show

  $homeLink 	= get_bloginfo('url');
  $post_type 	= get_post_type();

  echo '<div id="crumbs" class="col-full"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
      if ( $post_type == 'offer' ) {

        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . get_the_title();

      } elseif($post_type == 'post_gallery' ){

		global $post;

		// Get post type taxonomies
		$taxonomies = get_object_taxonomies( $post->post_type, 'objects' );

		// Empty array for terms
  		$out = array();

		foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

			// get the terms related to post
			$terms = get_the_terms( $post->ID, $taxonomy_slug );

			if ( !empty( $terms ) ) {
				foreach ( $terms as $term ) {
					$out[] = "<a href='".    get_term_link( $term->slug, $taxonomy_slug ) ."'>".$term->name."</a>&nbsp;";
			 	}
			}
		}
		printf('%1$s', implode('', $out ));
      }
      else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo get_the_title();
      }
  echo '</div>';
}

function wpg_adjacent_post_sort( $orderby, $post )
{
    // Make sure we are on our desired post type
    if ( 'post_gallery' !== $post->post_type || 'offer' !== $post->post_type )
        return $orderby;

    // We are on the desired post type, lets alter the SQL
    $orderby = str_replace( 'post_date', 'menu_order', $orderby );

    return $orderby;
}
add_filter( 'get_next_post_sort',     'wpg_adjacent_post_sort', 11, 2 );
add_filter( 'get_previous_post_sort', 'wpg_adjacent_post_sort', 11, 2 );




/*
 * Add Remove function
 *==========================================*/

/**
 * Remove Emoji (emotniki :) )
 *
 * @since 	1.0.0
 *
 */
function disable_emojis() {

			/*
			 * @credits https://wordpress.org/plugins/disable-emojis/
			 */
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); // Front-end browser support detection script
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); // Admin browser support detection script
			remove_action( 'wp_print_styles', 'print_emoji_styles' ); // Emoji styles
			remove_action( 'admin_print_styles', 'print_emoji_styles' ); // Admin emoji styles
			remove_filter( 'the_content_feed', 'wp_staticize_emoji' ); // Remove from feed, this is bad behaviour!
			remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); // Remove from feed, this is bad behaviour!
			remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' ); // Remove from mail
			if ( get_site_option( 'initial_db_version' ) >= 32453 ) {
				remove_action( 'init', 'smilies_init', 5 ); // This removes the ascii to smiley convertion
			}
			//* Remove DNS prefetch s.w.org (used for emojis, since WP 4.7)
			add_filter( 'emoji_svg_url', '__return_false' );


			//* Remove DNS prefetch s.w.org (used for emojis, since WP 4.7)
			add_filter( 'emoji_svg_url', '__return_false' );

}
add_action( 'init', 'disable_emojis', 4 );

/**
 * Disable 'medium_large' Image size
 *
 * @since 	1.0.0
 *
 */
function wpg_filter_image_sizes($sizes) {

	unset( $sizes['medium_large']);
	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'wpg_filter_image_sizes');

/*
 * Add Admin
 *==========================================*/

/**
 * Dodatkowa wtyczka TABELE (link do wtyczki)- Tinymce 4
 *
 * @since 	1.0.0
 *
 */
function wpg_table_plugins_tinymce( $plugins ) {
	$plugins['table'] = get_template_directory_uri() . '/js/tinymce/plugin.min.js';
	return $plugins;
}
add_action( 'mce_external_plugins', 'wpg_table_plugins_tinymce' );
/**
 * Dodatkowa wtyczka TABELE (Rejestracja przycisku)- Tinymce 4
 *
 * @since 	1.0.0
 */
function wpg_buttons_tinymce( $buttons ) {
	array_push( $buttons, 'table' );
	return $buttons;
}
add_filter( 'mce_buttons', 'wpg_buttons_tinymce' );
