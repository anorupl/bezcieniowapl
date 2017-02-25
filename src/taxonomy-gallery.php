<?php
/**
 * The taxonomy template file
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<div id="content" class="feturad-box col-full-no fixed-margin">
	<div id="primary" class="content-area hentry-single">
		<main id="main" class="site-main ">
		<header class="header-center entry-header-section text-center">
			<span class="header-span">
			<h2><?php echo single_cat_title( '', false ); ?></h2>
				<span class="border"></span>			
			</span>
			<p><?php echo term_description(); ?></p>
		</header>	
		<?php 
		if ( have_posts() ) : 
		
			while ( have_posts() ) : the_post(); ?>
			<div class="col-4">
				<div class="feturad-image">
					<a href="<?php the_permalink(); ?>">
						<?php
	
						if ( has_post_thumbnail() ) :
	
							the_post_thumbnail( 'medium_large', array( 'alt' => get_the_title() ) );
	
						else : 
							
							wpg_no_thumbnail('image');
	
						endif;
						?>
						<div class="text-title-overlay"><h3><?php the_title(); ?></h3></div>
					</a>
				</div>
			</div>
			<?php endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'wpg_theme' ),
				'next_text'          => __( 'Next page', 'wpg_theme' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'wpg_theme' ) . ' </span>',
			) );
		else: 
			get_template_part( 'components/content_multi/content-excerpt', 'none' );

		endif; ?>
		</main><!-- #main -->
	</div><!-- primary -->
</div><!-- #content -->	
<?php get_footer(); ?>