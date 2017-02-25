<?php
/**
 * Template part for displaying none content.
 * 
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 *
 */  
 
 ?>
<article <?php post_class(); ?>>
	<div class="post-content-none col-full text-center">
			<div class="entry-header">
				<h3  class="entry-title"><?php _e( 'Nothing Found', 'wpg_theme' ); ?></h3>
			</div>		
			<div class="entry-excerpt">				
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p>
					<?php 
					//printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wpg_theme' ), esc_url( admin_url( 'post-new.php' ) ) ); 
					?>
				</p>

			<?php elseif ( is_search() ) : ?>

				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wpg_theme' ); ?></p>
				<?php get_search_form(); ?>

			<?php else : ?>

				<p><?php _e( 'The materials are not yet published. We invite you later.', 'wpg_theme' ); ?></p>

			<?php endif; ?>			
			</div>
	</div><!-- .post-content-none -->
</article>