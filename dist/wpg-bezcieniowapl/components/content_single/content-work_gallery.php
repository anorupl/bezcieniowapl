<?php
/**
 * Template part for displaying single posts.
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="offer-header text-center">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header>		
		<div class="entry-social-offer">
			<?php wpg_share(); ?>
		</div>
	</div>
	<?php if (function_exists('wpg_breadcrumbs')) wpg_breadcrumbs(); ?>	
	<div class="entry-content col-7" style="float:right;">
		<?php 
			
				$content = get_the_content();

				strip_shortcode_gallery($content, 'gallery');

				wp_link_pages( array(
					'before'      => '<nav class="page-links pagination-inside" role="navigation"><span class="page-links-title">' . __( 'Pages:', 'wpg_theme' ) . '</span>',
					'after'       => '</nav>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'wpg_theme' ) . ' </span>',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );
		?>	
			
		<div class="col-6">
			<a href="<?php echo (get_post_meta( get_the_ID(), 'wpg_link_offer', true ) !== '') ? get_permalink(intval(get_post_meta( get_the_ID(), 'wpg_link_offer', true ))) : '#' ?>" class="relation-link"><?php _e('Show Offer','wpg_theme'); ?></a>							
		</div>			
		<?php if (get_theme_mod('wpg_telephone', '') !== '') : ?>
				<div class="col-6">
					<?php printf('<a href="tel:%2$s" class="phone-box"><i class="item-icon icon-phone_android"></i> %1$s %3$s</a>',
									__('Call us ', 'wpg_theme'), 
									str_replace(' ','', get_theme_mod('wpg_telephone')),
									esc_html(get_theme_mod('wpg_telephone')));
					?>
				</div>
		<? endif; ?>		
	</div>
	<?php if ( has_post_thumbnail() ) { ?>
		<figure class="entry-image post-thumbnail col-5 hidde-tablet" style="float: left;">
				<?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?>
		</figure><!-- .entry-image -->
	<?php }	?>	
	<span class="clear"><br></span>
		<?php if (is_single()) : ?>
		<div class="entry-gallery col-full-no">
 			<?php
 					$galleries = get_post_galleries( $post );

					if ( ! empty( $galleries ) ) {
						foreach ( $galleries as $gallery ) {
							echo $gallery;
						}
					}
			 ?>
		</div><!-- .entry-gallery -->	
		<?php endif;//is_single() ?>
</article>