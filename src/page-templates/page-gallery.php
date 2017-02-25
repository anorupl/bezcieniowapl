<?php
/**
 * Template Name: Kategorie Galerii
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
            /*
            'meta_key' => 'wpg_order',
            'orderby' => 'meta_value_num',
            'hide_empty' => false,
        	'meta_query' => array( 
 		               		 array( 
 		                    	'key' => 'wpg_order', 
 	                    		'compare' => 'EXISTS', 
 	                ), 
 		     ) 
			 */));	
			$i = 1;		
	
			
			foreach ( $categories as $category ) { 	?>
			<div class="col-4">
				<div class="feturad-image">
					<a href="<?php echo esc_url(get_term_link($category)); ?>">
						<?php echo the_term_thumbnail($category->term_id, 'full'); ?>
						<div class="text-title-overlay"><h3><?php echo $category->name; ?></h3></div>
					</a>
				</div>
			</div>
			<?php 
			if (  3 > 0 && ++$i % 3 == 0 ) {
				echo '<br class="clear" />';
			}	
			++$i;	
			?>	
		<?php } ?>	
		</main><!-- #main -->
	</div><!-- primary -->
</div><!-- #content -->								
<?php get_footer(); ?>