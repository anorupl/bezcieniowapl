<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */

get_header(); 

/* ===============================
 * Display Only in front page    *
 * ==============================*/
if (is_front_page() && !is_paged()) {


	/* ====================
	 * Section - Slider   *
	 * ===================*/
	if (get_theme_mod('wpg_slider_active', false) === true) {
		get_template_part('components/features/slider/loop', 'dropdown' );
	} else {
	 	get_template_part('components/features/slider/image', 'background' );
	}
	/* ====================
	 * Section - featured page   *
	 * ===================*/
	if (get_theme_mod('wpg_pagefeatured_active', false) === true) {
		get_template_part('components/features/featured_pages/featured', 'content' );
	}
	/* ====================
	 * Section - stage   *
	 * ===================*/
	if (get_theme_mod('wpg_stages_active', false) === true) {
		get_template_part('components/features/stages/stages', 'content' );
	}	
	
	/* ====================
	 * Section - last work   *
	 * ===================*/	
	if (get_theme_mod('wpg_lastwork_active', false) === true) {
		get_template_part('components/features/last_work/loop', 'last_work' );
	}
	/* ====================
	 * Section - Client   *
	 * ===================*/	
	if (get_theme_mod('wpg_client_active', false) === true) {
		get_template_part('components/features/client/loop', 'client' );
	}	
	
	/* =================================
	 * Section contact - social links  *
	 * ================================*/
	social_net_link('<section class="section-social col-full-no color-light bg text-center clear-both"><header class="entry-header-section header-center text-center"><span class="header-span"><h2>%1$s</h2><span class="border"></span></span><p></p></header><div class="wrap-continer">%2$s</div></section>');

}
/* =================================
 * Section - Main loop  		   *
 * ================================*/
?>
<section id="content" class="site-content col-full-no clear-both">
	<div id="primary" class="content-area hentry-multi">
		<main id="main" class="site-main ">	
			<header class="entry-header-section header-center text-center">
				<div class="header-span">
					
						<?php
						if ( is_front_page() && is_home() ) {
							// Default homepage	
							
							echo '<h2>' . get_theme_mod('wpg_blog_title', __('Last post', 'wpg_theme'));	 
			
							if ( $paged > 1 ) {
								_e(' - page: ', 'wpg_theme');
								echo $paged;
							}	

							echo '</h2>';		
						} elseif (is_category()){
							echo '<h1>' . single_cat_title( '', false ) . '</h1>';
						} else { ?>
							<h1><?php the_archive_title(); ?></h1> 
						<?php }	?>					
					
					<span class="border"></span>
				</div>
				<p><?php the_archive_description(); ?></p>
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
</section><!-- #content -->	
<?php get_footer(); ?>