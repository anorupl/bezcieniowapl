<section class="section-client clear-both text-center">
		<header class="header-center entry-header-section text-center">
			<span class="header-span">
			<h2><?php echo esc_html(get_theme_mod('wpg_client_title',__('Clients', 'wpg_theme'))); ?></h2>
				<span class="border"></span>			
			</span>
			<p><?php echo esc_html(get_theme_mod('wpg_client_desc','')); ?></p>
		</header>
	<?php
	
	// The Query
	$client_query = new WP_Query(array (
							'post_type'		=> array( 'client' ),
							'post_status'	=> array( 'Publish' ),
							'posts_per_page'=>-1,
						));

	
	if ( $client_query->have_posts() ) : ?>
	<div id="client-slider" class="client-slider">
		<?php
		// The Loop
		while($client_query ->have_posts()) : $client_query ->the_post(); ?>
		<div>
			<a href="<?php echo (get_post_meta( get_the_ID(), 'wpg_url_client', true ) ? esc_url(get_post_meta( get_the_ID(), 'wpg_url_client', true )) : '#'); ?>" target="_blank">
				<figure>
				<?php
					if ( has_post_thumbnail() ) :
						the_post_thumbnail( 'medium_large', array( 'alt' => get_the_title() ) );
					endif;
				?>
				</figure>	
			</a>				
		</div>
	<?php endwhile; ?>
	</div>
	<?php endif; 
	// Restore original Post Data
	wp_reset_postdata();
	?>
	<div class="clear"></div>
</section>