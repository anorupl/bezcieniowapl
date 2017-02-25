<?php
 /**
 * The custom functions that can be used directly in theme file.
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */

/**
 * Prints HTML with time information for the current post.
 *
 * @since 	1.0.0
 * @return 	string
 */
function wpg_time() {
		printf( '<time class="entry-date published updated" datetime="%1$s">%2$s</time>',
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
	}

/**
 * Prints HTML with share link for the current post.
 *
 * @since 	1.0.0
 * @return 	string
 */
function wpg_share() {

	printf('
	<a title="%1$s" class="social-share" target="_blank" href="http://twitter.com/home?status=Reading:%4$s"><i class="icon-twitter"></i></a>
	<a title="%2$s" class="social-share" target="_blank" href="https://plus.google.com/share?url=%4$s"><i class="icon-google"></i></a>
	<a title="%3$s" class="social-share" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=%4$s"><i class="icon-facebook"></i></a>',
			__('Share on Twitter!','wpg_theme'),
			__('Share on Google+','wpg_theme'),
			__('Share on Facebook','wpg_theme'),
			get_the_permalink());
}



/**
 * Prints HTML with post meta information (category, data, author, comments) for the current post.
 *
 * @since 	1.0.0
 *
 * @param 	bool $author. Default is true
 * @param 	bool $time. Default is true
 * @param 	bool $comments. Default is tru
 * @param 	bool $category. Default is true.
 *
 * @return 	string
 */

function wpg_meta( $author=false, $time=true, $comments=true, $category=true) {


		// print meta - author
		if ($author == true)	{
			printf('<div class="meta-item hidde-small">
				<span class="meta-left"><i class="icon-user2"></i></span>
				<span class="meta-right"><span class="screen-reader-text">%1$s</span><span class="author vcard"><span class="fn">%2$s</span></span></span>
			</div>',
				__('Author', 'wpg_theme'),
				get_the_author());
		}

		// print meta - data
		if ($time == true) {
			printf('
				<div class="meta-item">
					<span class="meta-left"><i class="icon-clock-full"></i></span>
					<span class="meta-right"><span class="screen-reader-text">%1$s</span><time class="entry-date published updated" datetime="%2$s">%3$s</time></span>
				</div>',
				__('Data', 'wpg_theme'),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ));
		}

		// print meta - comments
		if ( $comments == true && ! post_password_required() && ( comments_open() || get_comments_number() ))	{

			echo '<div class="meta-item hidde-small"><span class="meta-left"><i class="icon-bubbles"></i></span><span class="meta-right">';
					comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'wpg_theme' ), get_the_title() ) );
			echo '</span></div>';
		}

		// print meta - category/taxonomy
		if ($category == true) {
			if ('post' === get_post_type()) {
					
				//Get category
				$category_list = get_the_category_list( ',', '', false );
				
				printf('<div class="meta-item"><span class="meta-left"><i class="icon-folder-open"></i></span><span class="meta-right"><span class="screen-reader-text">%1$s</span>%2$s</span></div>',
						__('Category', 'wpg_theme'),
						$category_list
						);
			
			} else {
					
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
							$out[] = '<a href="'.    get_term_link( $term->slug, $taxonomy_slug ) .'">'.$term->name."</a>";
				   		}
					}
				}
				printf('
				<div class="meta-item">
					<span class="meta-left"><i class="icon-folder-open"></i></span>
					<span class="meta-right"><span class="screen-reader-text">%1$s</span>%2$s</span>
				</div>',
					__('Category', 'wpg_theme'),
					implode('', $out ));
			}
		}
}


/**
 * Get the category list - Can set limit item.
 *
 * @since 	1.0.0
 *
 * @param string $separator Optional, default is empty string. Separator for between the categories.
 * @param string $limit Optional, Default is 3.
 * @param string $parents Optional. How to display the parents.
 * @param int $post_id Optional. Post ID to retrieve categories.
 * @return string
 */
function the_limit_category_list( $separator = '',$limit = 3, $parents='', $post_id = false  ) {
	if ( ! is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) ) {
			return false;
	}

	$categories = get_the_category( $post_id );


	if ( empty( $categories)) {
			return false;
	}

	$rel = 'rel="category tag"';

	$thelist = '';

	$i = 0;

		foreach ( $categories as $category ) {
				if ( $limit > $i) {
					if (0 < $i )
					$thelist .= $separator;
					switch ( strtolower( $parents ) ) {
						case 'multiple':
							if ( $category->parent )
								$thelist .= get_category_parents( $category->parent, true, $separator );
							$thelist .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>' . $category->name.'</a><div class="clear"></div>';
							break;
						case 'single':
							$thelist .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>';
							if ( $category->parent )
								$thelist .= get_category_parents( $category->parent, false, $separator );
							$thelist .= "$category->name</a><div class='clear'></div>";
							break;
						case '':
						default:
							$thelist .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>' . $category->name.'</a><div class="clear"></div>';
					}
				++$i;
				}
			}
		 echo $thelist;
}


/**
 * Prints short title.
 *
 * @since 	1.0.0
 *
 * @param 	int $length Optional. Default is 200.
 * @param 	string $after Optional. Default is '...'
 *
 * @return 	string
 */
function wpg_title_shorten($length=200,$after='...') {
  	
  $mytitle = get_the_title();
  
  if (strlen($mytitle) > $length) {
    	
    $mytitle 	= substr($mytitle, 0, $length);
    $i 			= strrpos($mytitle, " ");
    $mytitle 	= substr($mytitle, 0, $i);

    echo $mytitle . $after;
  } else {
    echo $mytitle;
  }
}



/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since 1.0.0
 *
 */
function wpg_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'wpg_theme' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'wpg_theme' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'wpg_theme' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}

/**
 * Display last gallery in post.
 *
 * @since	1.0.0
 * @param	int	$post_id
 * @param	bool $html / true
 * 
 * @return	string with html
 */
function get_last_post_gallery(  $post_id, $html = true ) {
        	
        if ( $post_id ) {
 		  
		    $gallery = end( get_post_galleries( $post_id, $html ));
		
			return $gallery;
        }
}



/**
 * Display image attachment in post.
 *
 * @since	1.0.0
 * @param	string	$size
 * @param	int	$limit
 * @param	int	$offset
 * 
 * @return	string with html
 */
function wpg_the_image_attachment($size = 'large', $limit = 0, $offset = 0) {

	global $post;
	
	$thumb_id 	= get_post_thumbnail_id($post->ID); // gets the post thumbnail ID
	$images 	= get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'exclude' => $thumb_id ) );

	if ($images) {
		
		$num_of_images = count($images);

		if ($offset > 0) : $start = $offset--; else : $start = 0; endif;
		if ($limit > 0) : $stop = $limit+$start; else : $stop = $num_of_images; endif;
	
		$i = 0;
		echo '<div id="gallery-'. $post->ID .'" class="gallery gallery-columns-4">';
		
		foreach ($images as $image) {
			if ($start <= $i and $i < $stop) {
				/*
				$image->post_title;   // title.
				$image->post_content; // description.
				$image->post_excerpt; // caption.
				wp_get_attachment_url($image->ID); // url of the full size image.
				image_downsize( $image->ID, $size );
				$preview_array[0]; // thumbnail or medium image to use for preview.
				*/
			   $image_attributes   = wp_get_attachment_image_src( $image->ID, $size );

				printf('<figure class="gallery-item"><div class="gallery-icon"><a  href="%1$s" target="_blank"><img src="%2$s" alt="%3$s" /></a></div></figure>',
						$image->guid,
						$image_attributes[0],
						$image->post_excerpt
					
				);
			} 
			$i++; 
		}
		echo '</div>';
	} else {
		 echo '<div class="gallery"></div>';
	}
} 
?>