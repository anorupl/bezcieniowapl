<?php
/**
* Template Name: Contact Template
*
* Displays the contact Template.
*
* @package wpg_bezcieniowa_pl
* @since 1.0.1
*/
get_header();
?>
<div id="content" class="site-content col-full-no fixed-margin">
	<div id="primary" class="content-area hentry-single">
		<main id="main" class="site-main">
			<?php
			while ( have_posts() ) : the_post();

			//check post_thumbnail
			$image_thumb = (has_post_thumbnail() == true) ? wp_get_attachment_url(get_post_thumbnail_id()) : get_template_directory_uri() . '/img/default/no_image.jpg' ;

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
								<div class="contact-item phone-contact">
									<?php wpg_the_phone(); ?>
								</div>
								<?php if (get_theme_mod('wpg_address', '') !== '') :?>
									<div class="contact-item adress-contact">
										<i class="item-icon icon-map-marker"></i>
										<?php _e('Address', 'wpg_theme'); ?>
										<?php echo esc_html(get_theme_mod('wpg_address')); ?>
									</div>
								<?php endif; ?>
								<?php if (get_theme_mod('wpg_email', '') !== '') : ?>
									<div class="other-contact">
										<i class="item-icon icon-envelope"></i>
										<?php _e('E-mail', 'wpg_theme'); ?>
										<?php printf('<a href="mailto:%1s">%1$s</a>', antispambot(get_theme_mod('wpg_email'))); ?>
									</div>
								<?php endif; ?>
							</div>
							<?php social_net_link('<div class="contact-column find-us-on"><h2>%1$s</h2> %2$s </div>'); ?>
						</div>
					</div><!-- .entry-content -->
					<div class="contact-form col-7">
						<div class="contact-column">
							<h2><?php _e('Contact form','wpg_theme');?></h2>
							<?php echo do_shortcode(get_post_meta(get_the_ID(), 'wpg_contact_form', true)); ?>
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
						<div id="panel" class="text-center">
							<input type="text" id="start" name="start" value="" placeholder="<?php _e('Enter the starting point', 'wpg_theme'); ?>" aria-required="true" aria-invalid="false" title="<?php _e('Enter the starting point', 'wpg_theme'); ?>">
							<button id="show_road" type="button"><?php _e('Show route', 'wpg_theme'); ?></button>
							<button id="hide_road" type="button"><?php _e('Hide route', 'wpg_theme'); ?></button>
						</div>
					</div><!-- #section-directions-map -->
					<div id="directions-panel" class="col-full-no color-white bg"></div>
					<br>
				<?php } ?>
			</article>
		<?php endwhile; // End of the loop. ?>
	</main><!-- .site-main -->
</div><!-- .content-area -->
</div><!-- .site-content -->
<?php get_footer(); ?>
