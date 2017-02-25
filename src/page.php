<?php
/**
 * The template for displaying all single page.
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */

get_header(); ?>
<div id="content" class="site-content col-full-no fixed-margin">
	<div id="primary" class="content-area hentry-single">
		<main id="main" class="site-main ">
		<?php
		while ( have_posts() ) : the_post();

				get_template_part( 'components/content_single/content', 'page');
			
		?>
		<div class="col-full">
		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		?>	
		</div>	
		<?php endwhile; // End of the loop.	?>
		</main><!-- #main -->
	</div><!-- primary -->
</div><!-- #content -->	
<?php get_footer(); ?>