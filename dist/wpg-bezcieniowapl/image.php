<?php
/**
 * The template for displaying attachment image.
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */

get_header(); ?>
<div id="content" class="site-content col-full-no fixed-margin">
	<div id="primary" class="content-area hentry-single">
		<main id="main" class="site-main ">
		<?php
		while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="title-full-width">
				<?php the_title( '<h1>', '</h1>' ); ?>
			</header>
			<div class="col-9 offset-3">
				<hr>
				<div class="attachment-image">
					<?php
						echo wp_get_attachment_image( get_the_ID(), 'large' );
					?>
				</div>	
				<hr>	
				<div class="attachments-info">
				<?php
				
				$metadata = wp_get_attachment_metadata();
				printf( __( 'Published in size <a href="%1$s" title="Link to file">%2$spx <span class="screen-reader-text">(Image width)</span> to %3$spx <span class="screen-reader-text">(Image Height)</span></a> in post <a href="%4$s" title="Back to %5$s">%6$s</a>', 'wpg_theme' ),
					esc_url( wp_get_attachment_url() ),
					$metadata['width'],
					$metadata['height'],
					esc_url( get_permalink( $post->post_parent ) ),
					esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
					get_the_title( $post->post_parent )
				
				 );
				
				
				?>
				</div>
				<nav id="attachment-navigation" class="attachment-navigation text-center">
					<div class="nav-links">
						<h2 class="screen-reader-text"><?php _e('Navigation images','wpg_theme')?></h2>
						<?php previous_image_link( false, __( 'Previous Image', 'wpg_theme' ) ); ?>
						<?php next_image_link( false, __( 'Next Image', 'wpg_theme' ) ); ?>
					</div><!-- .nav-links -->
				</nav><!-- .attachment-navigation -->				
				<div class="entry-content">
					<?php the_content(); ?>		
				</div>							
			</div>
		</article>
		<?php endwhile; // End of the loop.	?>
		</main><!-- #main -->
	</div><!-- primary -->
</div><!-- #content -->	
<?php get_footer(); ?>