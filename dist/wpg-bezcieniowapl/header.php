<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!--[if IE]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>	
	<div id="header-adress" class="header hidde-tablet col-9">
		<?php get_template_part( 'components/site/site', 'adress' ); ?>
	</div>
	<div id="header-social-link" class="header hidde-tablet col-3 text-right">
		<?php social_net_link('<span class="screen-reader-text">%1$s</span>%2$s'); ?>
	</div>		
	<header id="site-header" class="col-full-no">
			<?php if ( is_front_page() ) : ?>
				<div class="title-area">
					<h1 class="site-title">
						<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
						<?php 
						 if (has_custom_logo()) {
							the_custom_logo();
						} else { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						<?php } ?>
					</h1>	
				</div>
			<?php else : ?>
				<div class="title-area">
					<?php if (has_custom_logo()) {
						the_custom_logo();
					} else { ?>
						<span class="site-title class-h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				  <?php } ?>
				</div>
			<?php endif;
	
				if ( has_nav_menu( 'header' ) ) { ?>
					<button class="icon-button-small-menu right-button" aria-expanded="false" aria-controls="header-menu"><?php _e('Menu', 'wpg_theme'); ?></button>
				
				<?
				
					
					wp_nav_menu(
							array(
							'container'       	=> false,
							'theme_location' 	=> 'header',
							'menu_id' 			=> 'header-menu',
							'items_wrap'      	=> '<nav id="%1$s" class="horizontal arrow rtl hidde wp-nav" data-class="horizontal arrow rtl hidde wp-nav"><ul class="%2$s">%3$s</ul></nav>'
							));
	
				} ?>
	</header>