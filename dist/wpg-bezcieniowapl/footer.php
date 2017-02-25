<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */

?>
<footer class="col-footer clear-both color-light bg">
	<div class="entry-header-section header-center text-center">
		<h2 class="entry-title"><?php _e('Contact', 'wpg_theme'); ?></h2>
		<span class="border"></span>
	</div>
	<?php 
	/* ===========================================
	* Section contact - Google maps  *
	* ==========================================*/
	if (!is_page_template( 'page-templates/contact.php' )) {
		get_template_part( 'components/footer/site', 'googlemaps' ); 
	}?>
	<div class="section-contact text-center">
		<div class="contact-info clear-both">
		<?php 
		/* ===========================================
	 	* Section contact - telephone/addres/email  *
	 	* ==========================================*/
		get_template_part( 'components/site/site', 'adress' ); ?>
		</div>
	</div>
</footer><!-- .footer  -->
<?php 
	get_sidebar('overlay');
	
	wp_footer(); 
?>
</body>
</html>