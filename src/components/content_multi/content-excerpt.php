<?php
/**
 * Template part for displaying multi posts standard.
 * 
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 *
 */  
 
 ?>
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 	
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="entry-image post-thumbnail">
			<a href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?>
			</a>
		</div><!-- .entry-image -->
	<?php }	else {
		wpg_no_thumbnail();
	}
	?>
	<div class="entry-meta text-right hidde-tablet col-3">
				<div class="posted-on">
					<span class="screen-reader-text"><?php _e('Posted on', 'wpg_theme'); ?></span>
					<?php wpg_time() ?>
				</div><!-- .posted-on -->
				<div class="cat-links">
					<span class="screen-reader-text"><?php _e('categories', 'wpg_theme'); ?></span>
					<?php the_limit_category_list(''); ?>
				</div><!-- .cat-links -->		
				<div  class="author vcard screen-reader-text">
					<?php _e('by', 'wpg_theme'); ?>
					<span class="fn"><?php the_author(); ?></span>
				</div ><!-- .author -->										
	</div><!-- .entry-meta -->		
	<div class="post-content-warp col-9">
		
		
			<div class="entry-header">
				<h3  class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php wpg_title_shorten(); ?></a></h3>
			</div>		
			<div class="entry-excerpt">				
				<?php the_excerpt(); ?>
			</div>
	</div><!-- .post-content-warp -->
</article>