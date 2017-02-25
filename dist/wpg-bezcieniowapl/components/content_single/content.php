<?php
/**
 * Template part for displaying single posts.
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 *
 */
?>

<?php 
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
	<div class="col-9 offset-3">
		<hr>	
		<div class="entry-meta col-9-no hidde-tablet">
			<?php wpg_meta(false,true,false,true); ?>
		</div>
		<div class="entry-social text-right col-3">
			<?php wpg_share(); ?>
		</div>
		<hr>
		<div class="entry-content">
			<?php
					the_content();
	
					wp_link_pages( array(
						'before'      => '<nav class="page-links pagination-inside" role="navigation"><span class="page-links-title">' . __( 'Pages:', 'wpg_theme' ) . '</span>',
						'after'       => '</nav>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'wpg_theme' ) . ' </span>',
						'separator'   => '<span class="screen-reader-text">, </span>',
					) );
			?>			
		</div>
	</div>
</article>