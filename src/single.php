<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

			switch (get_post_type(get_the_ID())) {
				 case 'post_gallery':
					 		get_template_part( 'components/content_single/content', 'work_gallery' );
					  		?>
							<div class="col-full">
							<?php
							// Previous/next post gallery.
							the_post_navigation( array(
								'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next gallery', 'wpg_theme' ) . '</span> ' .
									'<span class="screen-reader-text">' . __( 'Next gallery', 'wpg_theme' ) . ':</span> ' .
									'<span class="post-title">%title</span>',
								'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous gallery', 'wpg_theme' ) . '</span> ' .
									'<span class="screen-reader-text">' . __( 'Previous gallery', 'wpg_theme' ) . ':</span> ' .
									'<span class="post-title">%title</span>',
								'in_same_term' => true,	
								'taxonomy' => 'gallery'									
							) );
					 break;
				 case 'offer':
							get_template_part( 'components/content_single/content', 'offer' );
					 		?>
					 		<div class="col-full">
							<?php
								// Previous/next post offer.
								the_post_navigation( array(
									'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next offer', 'wpg_theme' ) . '</span> ' .
										'<span class="screen-reader-text">' . __( 'Next offer', 'wpg_theme' ) . ':</span> ' .
										'<span class="post-title">%title</span>',
									'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous offer', 'wpg_theme' ) . '</span> ' .
										'<span class="screen-reader-text">' . __( 'Previous offer', 'wpg_theme' ) . ':</span> ' .
										'<span class="post-title">%title</span>',
								) );
					 break;					 			 
				 default:
							get_template_part( 'components/content_single/content', get_post_format()  );
					 		?>
					 		<div class="col-full">
							<?php
								// Previous/next post navigation.
								the_post_navigation( array(
									'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'wpg_theme' ) . '</span> ' .
										'<span class="screen-reader-text">' . __( 'Next post:', 'wpg_theme' ) . '</span> ' .
										'<span class="post-title">%title</span>',
									'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'wpg_theme' ) . '</span> ' .
										'<span class="screen-reader-text">' . __( 'Previous post:', 'wpg_theme' ) . '</span> ' .
										'<span class="post-title">%title</span>',
								) );								
					 break;
			 }//switch
			 
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		?>	
		</div><!-- .col-full -->	
		<?php endwhile; // End of the loop.	?>
		</main><!-- #main -->
	</div><!-- primary -->
</div><!-- #content -->	
<?php get_footer(); ?>