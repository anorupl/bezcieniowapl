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
	<div id="terms-message" class="clear-both">
		<div>
			<span id="copyright-message">© <?php echo date("Y"); ?> <?php bloginfo('name'); ?>  |</span>

			<?php if (get_theme_mod('wpg_terms_active', false) === true) : ?>
			<span id="cookies-message"><?php _e('The site uses "cookies" ', 'wpg_theme'); ?> <a href="<?php echo (get_theme_mod('wpg_cookies_page', '') !== '') ? get_permalink(get_theme_mod('wpg_cookies_page')) : '#'; ?>"><?php _e('Learn more', 'wpg_theme') ?></a></span>
			<?php endif; ?>
		</div>
	</div>
</footer><!-- .footer  -->
<?php
	get_sidebar('overlay');

	wp_footer();
?>
<a id="scrolltop" href="#" ><?php _e('Go top', 'wpg_theme'); ?></a>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<!-- Your customer chat code -->
<div class="fb-customerchat" page_id="1841019066140479"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>
