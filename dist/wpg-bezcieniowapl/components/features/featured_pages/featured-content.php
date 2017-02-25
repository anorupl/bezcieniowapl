<?php
/**
 * Template part for displaying multi posts standard.
 * 
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 *
 */  
 
for ( $i = 1; $i <= 2; $i++ ) {
	$id = get_theme_mod( 'wpg_pagefeatured_' . $i );
	if ( ! empty( $id ) ) {
		$pages_ids[] = absint( $id );
	}
}				

if ( !empty( $pages_ids ) ) : ?>
<section class="feturad-page gray-style clear-both">
	<?php
		$query_pages = new WP_Query(
							array(
							'posts_per_page' => 2,
							'no_found_rows'  => true,
							'orderby'        => 'post__in',
							'post_type'      => 'page',
							'post__in'       => $pages_ids
							));
		
		$page_cunt = (count($pages_ids) < 2) ? 'col-full-margin' : 'col-6';
		
		if(isset($query_pages) && $query_pages->have_posts()) :
			while($query_pages ->have_posts()) : $query_pages ->the_post(); ?>
				 <div id="post-<?php the_ID(); ?>" <?php post_class( array('post-content-warp', $page_cunt)); ?>>
					<div class="entry-header text-center">
								<h2  class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php wpg_title_shorten(); ?></a></h2>
					</div>	
					<div class="entry-content">				
							<?php the_content(); ?>
					</div>
				</div><!-- .post-content-warp --> 						
				<?php	
				
				endwhile;
		endif; 
		/* Restore original Post Data */ 
		wp_reset_postdata(); ?>
</section>
<?php endif; ?>