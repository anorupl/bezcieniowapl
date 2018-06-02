<?php
/**
* Template part for displaying adress.
*
* @package wpg_bezcieniowa_pl
* @since 1.0.1
*
*/
?>
<div class="contact-item phone-contact">
	<?php wpg_the_phone(); ?>
</div>
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
