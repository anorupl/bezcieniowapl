<?php
/**
 * The template for displaying search results pages
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */

get_header(); 
/* =================================
 * Section - Main loop  		   *
 * ================================*/
?>
<div id="content" class="site-content col-full-no clear-both">
	<div id="primary" class="content-area hentry-multi">
		<main id="main" class="site-main ">	
		<header class="entry-header-section header-center text-center">
				<span class="header-span">
					<h1><?php printf( __( 'Search Results for: %s', 'wpg_theme' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
					<span class="border"></span>
				</span>
				<span class="border"></span>
		</header>
		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'components/content_multi/content-excerpt', get_post_format() );

			endwhile;
			
		
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'wpg_theme' ),
				'next_text'          => __( 'Next page', 'wpg_theme' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'wpg_theme' ) . ' </span>',
			));				
			
		else :
			get_template_part( 'components/content_multi/content-excerpt', 'none' );
		endif; ?>		
		</main><!-- #main -->
	</div><!-- primary -->
</div><!-- #content -->				
<?php get_footer(); ?>