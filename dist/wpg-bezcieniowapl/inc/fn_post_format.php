<?php
 /**
 * The custom functions for wordpress post format that can be used directly in theme file.
 * 
 * - wpg_quote
 * - wpg_embedded_content
 * - catch_that_image
 * - wpg_no_thumbnail
 * - wpg_get_link_url
 * - strip_shortcode_gallery
 * 
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */

/**
 * Get tag <blockquote> from a post content
 *
 * @since 	1.0.0
 *
 * @return string
 */
function wpg_quote() {

	$content = apply_filters( 'the_content', get_the_content() );

	preg_match('/<blockquote.*?<\/blockquote>/is', $content, $matches_blockquote);

	echo $matches_blockquote ? $matches_blockquote[0] : '';

}


/**
 * Get media file embedded in post content
 *
 * @since	1.0.0
 * @param	array $type. List of tags that should be found (iframe,video,embed,audio).
 *
 * @return	string
 */
function wpg_embedded_content($type=array()) {

		if (!empty($type)){

			$content = apply_filters( 'the_content', get_the_content() );
			$media = get_media_embedded_in_content($content, $type);

			echo !empty($media) ? $media[0] : '';

		}
}

/**
 * Get from post content first image.
 *
 * @since  1.0.0
 * @global $post
 *
 * @return string
 */
function catch_that_image() {
  global $post;

  $first_img = get_template_directory_uri() . '/img/svg/one.svg';

  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

	if(isset($matches[1][0])) {
		$first_img = $matches[1][0];
	}

  return $first_img;
}


/**
 * If post not have thumbnail display first image or default svg.
 *
 * @since 1.0.0
 * @global $post
 * @param string $format, (figure,link,image) Default: figure.
 * @param bool $image_content, Default: false.
 *
 *
 * @return string
 */
function wpg_no_thumbnail($format = 'figure', $image_content = false) {

	global $post;

	$class  	= 'img-thumb';
	$first_img 	= get_template_directory_uri() . '/img/default/no_image.jpg';

	if ($image_content == true) {
		preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

		if(isset($matches[1][0])) {
			$class  = 'img-thumb';
			$first_img = $matches[1][0];
		}
	}

		switch ($format) {
			case 'link':
					printf('<a class="link-thumbnail %1$s" href="%2$s" ><img src="%3$s" alt="" /></a>',
					esc_attr($class),
					esc_url(get_permalink()),
					$first_img
				);
				break;
			case 'image':
				printf('<img class="image-thumbnail %1$s" src="%2$s" alt="" />',
					esc_attr($class),
					$first_img
				);
				break;

			default:
				printf('<figure class="post-thumbnail %1$s"><a href="%2$s" aria-hidden="true"><img src="%3$s" alt="" /></a></figure>',
					esc_attr($class),
					esc_url(get_permalink()),
					$first_img
				);
				break;
		}
}

/**
 * Return the post URL.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since 1.0.0
 *
 * @see get_url_in_content()
 * @return string The Link format URL.
 */
function wpg_get_link_url() {

	$has_url = get_url_in_content( get_the_content() );

	return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Strip shortcode gallery form content
 *
 * @since WPG Theme 1.0.0
 *
 * @param string $content.
 * @param string $code. Shortcode pattern form get_shortcode_regex
 *
 * @param string
 *
 */
function strip_shortcode_gallery( $content, $code ) {
	    preg_match_all( '/'. get_shortcode_regex() .'/s', $content, $matches, PREG_SET_ORDER );

	    if ( ! empty( $matches ) ) {
	        foreach ( $matches as $shortcode ) {
	            if ( $code === $shortcode[2] ) {
	                $pos 	= strpos( $content, $shortcode[0] );
	    			$pos2 	= strlen($shortcode[0]);
	                if ($pos !== false) {
	                	$content = substr_replace( $content, '', $pos, $pos2 );
					}
	            }
	        }

			
		
			$content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) );
	    	
	    	echo $content;
		
		} else {
			echo apply_filters( 'the_content', $content );			
		}


}
?>