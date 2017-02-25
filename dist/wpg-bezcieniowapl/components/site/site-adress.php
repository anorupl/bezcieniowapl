<?php if (get_theme_mod('wpg_telephone', '') !== '') : ?>
	<div class="contact-item phone-contact">
		<i class="item-icon icon-phone_android"></i><?php _e('Call us ', 'wpg_theme'); 
		printf('<a href="tel:%1s">%2$s</a>', 
			str_replace(' ','', get_theme_mod('wpg_telephone')),
			esc_html(get_theme_mod('wpg_telephone'))
		); ?>
	</div>
<?php endif; ?>

<?php if (get_theme_mod('wpg_address', '') !== '') :?>
	<div class="contact-item adress-contact">
		<i class="item-icon icon-map-marker"></i><?php echo esc_html(get_theme_mod('wpg_address')); ?>
	</div>
<?php endif; ?>
<?php if (get_theme_mod('wpg_email', '') !== '') : ?>
	<div class="contact-item email-contact">
		<i class="item-icon icon-envelope"></i>
		<?php printf('<a href="mailto:%1s">%1$s</a>', antispambot(get_theme_mod('wpg_email'))); ?>
	</div>
<?php endif; ?>	