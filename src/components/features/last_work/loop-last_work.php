<section class="feturad-box last-work gray-style clear-both">
	<header class="header-center entry-header-section text-center">
		<span class="header-span">
			<h2><?php echo esc_html(get_theme_mod('wpg_lastwork_title',__('Last work', 'wpg_theme'))); ?></h2>
			<span class="border"></span>			
		</span>
		<p><?php echo esc_html(get_theme_mod('wpg_lastwork_desc','')); ?></p>
	</header>
	<div class="wrap-continer clear-both">
	<?php
		
	$column = get_theme_mod('wpg_lastwork_number', 3) > 6 ? '3' : '4';
	
	$lastwork_term = get_theme_mod('wpg_lastwork_terms','0');



	if ($lastwork_term == 0) {
		$query_arg = array (
			'post_type'		=> array( 'post_gallery' ),
			'post_status'	=> array( 'Publish' ),
			'posts_per_page' => get_theme_mod('wpg_lastwork_number',3),
			'update_post_term_cache' => false,
		);
	} else {
		$query_arg = array (
			'post_type'		=> array( 'post_gallery' ),
			'post_status'	=> array( 'Publish' ),
			'posts_per_page' => get_theme_mod('wpg_lastwork_number',3),
			'tax_query' => array(
							array(
								'taxonomy' => 'gallery',
								'field'    => 'term_id',
								'terms'    => $lastwork_term,
							),
		));		
	}
	
	// The Query
	$last_work_query = new WP_Query($query_arg);

	// The Loop
	if ( $last_work_query->have_posts() ) :
		while($last_work_query ->have_posts()) : $last_work_query ->the_post(); ?>

		<div class="col-<?php echo $column; ?>">
			<div class="feturad-image">
				<a href="<?php the_permalink(); ?>">
					<?php

					if ( has_post_thumbnail() ) :

						the_post_thumbnail( 'medium_large', array( 'alt' => get_the_title() ) );

						else : wpg_no_thumbnail('image');

					endif;
					?>
					<div class="text-title-overlay"><h3><?php the_title(); ?></h3></div>
				</a>
			</div>
		</div>
	<?php endwhile; endif;
	// Restore original Post Data
	wp_reset_postdata();
?>
	</div>
</section>