<?php
/**
 * The template for displaying attachment.
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
				<div class="entry-content">
					<div class="attachment-file text-center">
						<?php
							//icon button
							echo wp_get_attachment_link($post->ID, 'thumbnail', false, true,false); ?>
						
						<br>
						<?php
								$attachment_data = wp_prepare_attachment_for_js();
		
								_e('File size: ','wpg_theme');
								echo $attachment_data['filesizeHumanReadable'];
		
						?>
						<br>
						<br>
						<span class="class-h3"><?php _e('Click icon to download','wpg_theme')?></span><br>
					</div>
				</div>
			</div>
		</article>
		<?php endwhile; // End of the loop.	?>
		</main><!-- #main -->
	</div><!-- primary -->
</div><!-- #content -->	
<?php get_footer(); ?>