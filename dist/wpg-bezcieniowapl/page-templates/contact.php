<?php
/**
 * Template Name: Contact Template
 *
 * Displays the contact Template.
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
						
				//check post_thumbnail
				if (has_post_thumbnail() == true) {
					$image_thumb = wp_get_attachment_url(get_post_thumbnail_id());
				} else {
					$image_thumb = get_template_directory_uri() . '/img/default/no_image.jpg';
				} 
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="title-full-width" style="background-image:url('<?php echo $image_thumb; ?>');">
					<div class="blend"></div>
					<?php the_title( '<h1>', '</h1>' ); ?>
				</header>
				<div class="col-full">
					<hr>	
					<div class="entry-social text-center">
						<?php wpg_share(); ?>
					</div>
					<hr>
					<div class="entry-content col-5">
						<div class="contact-column">
							<?php the_content(); ?>			
						</div>
						<div class="section-contact">
							<div class="contact-column contact-info">
								<?php if (get_theme_mod('wpg_telephone', '') !== '') : ?>
									<h2><?php _e('Information', 'wpg_theme'); ?></h2>
									<div class="<?php echo $column; ?> phone-contact">
										<i class="item-icon icon-phone_android"></i> <?php _e('Call us ', 'wpg_theme'); printf('<a href="tel:%1s">%1$s</a>', esc_attr(get_theme_mod('wpg_telephone'))); ?>
									</div>
								<?php endif; ?>
								<?php if (get_theme_mod('wpg_address', '') !== '') :?>
									<div class="<?php echo $column; ?> other-contact">
										<i class="item-icon icon-map-marker"></i>
										<!--<span><?php _e('Address', 'wpg_theme'); ?></span> -->
										<?php echo esc_html(get_theme_mod('wpg_address')); ?>
									</div>
								<?php endif; ?>
								<?php if (get_theme_mod('wpg_email', '') !== '') : ?>
									<div class="<?php echo $column; ?> other-contact">
										<i class="item-icon icon-envelope"></i>
										<!-- <span><?php _e('E-mail', 'wpg_theme'); ?></span> -->
										<?php printf('<a href="mailto:%1s">%1$s</a>', antispambot(get_theme_mod('wpg_email'))); ?>
									</div>
								<?php endif; ?>
								</div>
								<?php
									/* =================================
									 * Section contact - social links  *
									 * ================================*/
									social_net_link('<div class="contact-column find-us-on"><h2>%1$s</h2> %2$s </div>');
								?>						
							</div>					
					</div><!-- .entry-content -->
					
					<div class="col-7 contact-form">
						<div class="contact-column">
							<h2><?php _e('Contact form','wpg_theme');?></h2>
						<?php
							$contact_form = get_post_meta( get_the_ID(), 'wpg_contact_form', true ); 
								
							echo do_shortcode( $contact_form);
						?>
						</div>
					</div><!-- .contact-form -->
				</div>
				<hr class="style-two">
				<?php
				/* =================================
				 * Section contact - Google maps   *
				 * ================================*/
				if( true == get_theme_mod('wpg_contact_maps')) { ?>
				<div id="section-directions-map" class="col-full">
					<h2><?php _e('Location', 'wpg_theme'); ?></h2>
					<div id="map-canvas"></div>
						<input id="contact-latlng" type="hidden" value="<?php echo get_theme_mod('wpg_contact_map_latlong','54.248997, 20.804780'); ?>"  />
						<button id="drag" class="btn-white show-small" type="button" ><?php _e('Enable drag', 'wpg_theme'); ?></button>
						<div id="panel" class="text-center">
							<input type="text" id="start" name="start" value="" placeholder="<?php _e('Enter the starting point', 'wpg_theme'); ?>" aria-required="true" aria-invalid="false" title="<?php _e('Enter the starting point', 'wpg_theme'); ?>">
							<button id="show_road" type="button" onclick="showRoute();" ><?php _e('Show route', 'wpg_theme'); ?></button>
							<button id="hide_road" type="button" onclick="hideRoute();" ><?php _e('Hide route', 'wpg_theme'); ?></button>
						</div>
				</div><!-- #section-directions-map -->
				<div id="directions-panel" class="col-full-no color-white bg"></div>
				<br>
				<?php } ?>										
			</article>
			<?php endwhile; // End of the loop. ?>
		<div class="col-full">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>	
		</div>	
		</main><!-- .site-main -->
	</div><!-- .content-area -->
</div><!-- .site-content -->
<?php get_footer(); ?>