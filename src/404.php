<?php
/**
 * The template for displaying 404 page.
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */

get_header(); ?>
<div id="content" class="site-content col-full-no fixed-margin">
	<div id="primary" class="content-area hentry-single">
		<main id="main" class="site-main ">
			<article <?php post_class(); ?>>
				<header class="title-full-width">
					<h1><?php _e( 'Oops! That page can&rsquo;t be found.', 'wpg_theme' ); ?></h1>
				</header>
				<div class="col-9 offset-3">
					<hr>	
					<div class="entry-content text-center" style="min-height: 200px">
						<h2><?php _e( 'It looks like nothing was found at this location.', 'wpg_theme' ); ?></h2>		
					</div>
				</div>
			</article>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #content -->
<?php get_footer(); ?>