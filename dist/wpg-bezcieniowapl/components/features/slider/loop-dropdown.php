<div id="header-slider" class="col-full-no" >
	<div id="slider" class="slick-full header-resize">
	<?php

	$slider_number = absint( get_theme_mod('wpg_slider_number', 1 ) );

	for ( $i = 1; $i <= $slider_number; $i++ ) {
		$id = get_theme_mod( 'wpg_slide_' . $i );

		if ( ! empty( $id ) ) {
			$ids[] = absint( $id );
		}
	}

	if ( !empty( $ids ) ) {

		$query_slajd = new WP_Query(array(
			'posts_per_page' => $slider_number,
			'no_found_rows'  => true,
			'orderby'        => 'post__in',
			'post_type'      => 'slides',
			'post__in'       => $ids,
		));

		if(isset($query_slajd) && $query_slajd->have_posts()) :
			while($query_slajd ->have_posts()) : $query_slajd ->the_post();

			//check post_thumbnail
			$image_thumb = (has_post_thumbnail() == true) ? wp_get_attachment_url(get_post_thumbnail_id()) : get_template_directory_uri() . '/img/default/no_image.jpg';

			$color_class = (get_post_meta(get_the_ID(), 'wpg_select_color', true)) ? get_post_meta(get_the_ID(), 'wpg_select_color', true) : 'slide-bright';
			$bg_size     = (get_post_meta(get_the_ID(), 'wpg_select_bg', true)) ? get_post_meta(get_the_ID(), 'wpg_select_bg', true) : 'cover';

			?>

			<div class="slides" style="background-image:url('<?php echo $image_thumb; ?>'); background-size:<?php echo $bg_size; ?>;">
				<img src="<?php echo $image_thumb; ?>" style="display: none;" />
				<div class="slides-caption <?php echo $color_class; ?>">
					<h2><?php the_title(); ?></h2>
					<?php the_excerpt(); ?>
					<?php if( get_post_meta(get_the_ID(), 'wpg_url_slide', true) ) : ?>
						<a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'wpg_url_slide', true)); ?>" class="btn-slider"><?php _e('See more', 'wpg_theme'); ?></a>
					<?php endif; ?>
				</div>
			</div>
		<?php
			endwhile;
			/* Restore original Post Data */
			wp_reset_postdata();
			else :
		?>
			<li style="background-image:url('<?php echo get_template_directory_uri() . '/img/default/no_image.jpg'; ?>');"></li>
		<?php endif;
	}
	?>
	</div>
</div>
