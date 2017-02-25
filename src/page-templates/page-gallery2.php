<?php
/**
 * Template Name: Kategorie Galerii 2
 *
 * Displays the contact Template.
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */
get_header(); 
?>
<div id="content" class="feturad-box col-full-no fixed-margin">
	<div id="primary" class="content-area hentry-single">
		<main id="main" class="site-main ">
		<header class="entry-header-section header-center text-center">
			<?php the_title( '<h1>', '</h1>' ); ?>
			<span class="border"></span>
		</header>
		
		
		<?php
			$categories = get_terms( array(
			    'taxonomy' => 'gallery',
			    'hide_empty' => false,

			) );	

			foreach ( $categories as $category ) { 

				$args = array(
				    'posts_per_page' => '2',
					'tax_query' => array(
						array(
							'taxonomy' => 'gallery',
							'field'    => 'term_id',
							'terms'    => $category->term_id,
						),
					),				    
				);
				
 				$query = new WP_Query( $args );
    		
				if ( $query->have_posts() ) { ?>
					<section class="clear-both" style="margin-bottom: 30px;">
						<header class="tab-header text-center">
							<h2><?php _e('Recent work in: ','theme_wpg'); echo $category->name; ?></h2>		
							<span class="border"></span>
						</header>
					<?php while ( $query->have_posts() ) {$query->the_post();?>
    					<div class="col-4">
							<div class="feturad-image">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'medium' ); ?>
									<div class="text-title-overlay"><h3><?php the_title(); ?></h3></div>
								</a>
							</div>
						</div>		
    				
    				<?php } // end while ?>
    				 <div class="col-4">
							<div class="feturad-image show-feturad">
								<a href="<?php echo esc_url(get_term_link($category)); ?>">
									<?php echo the_term_thumbnail($category->term_id, 'full'); ?>
									<div class="text-title-overlay"><h3>Pokaż Wszystkie </h3></div>
								</a>
							</div>
						</div>	
    				</section>
    				<br class="clear" />
				<?php } // end if
				// Use reset to restore original query.
				wp_reset_postdata();
			}
		?>		
		</main><!-- #main -->
	</div><!-- primary -->
</div><!-- #content -->								
<?php get_footer(); ?>