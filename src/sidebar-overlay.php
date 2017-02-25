<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */

if ( ! is_active_sidebar( 'wpg-sidebar-overlay' ) ) {
	return;
}
?>

<aside id="sidebar-overlay" class="widget-area hidde-tablet">
	<a href="#" class="show-overlay"><i class="item-icon icon-envelope"></i> <?php _e('Show Contact','wpg_theme'); ?></a>
	<a href="#" class="hide-overlay"><i class="item-icon icon-envelope"></i> <?php _e('Hide Contact','wpg_theme'); ?></a>
	<?php dynamic_sidebar( 'wpg-sidebar-overlay' ); ?>
</aside>

