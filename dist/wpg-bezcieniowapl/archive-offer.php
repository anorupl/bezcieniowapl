<?php
/**
  * The taxonomy template file
  *
  * @package wpg_bezcieniowa_pl
  * @since 1.0.0
  *
  * @link https://codex.wordpress.org/Template_Hierarchy
  */
?>

<?php get_header(); ?>
<div id="content" class="site-content col-full-no">
	<div id="primary" class="content-area">
		<main id="main" class="site-main ">		
			<header class="entry-header-section header-center text-center">
				<span class="header-span">	
					<h1><?php post_type_archive_title(); ?></h1>
					<span class="border"></span>
				</span>
			</header><!-- entry-header-section -->	
			<?php
				if ( have_posts() ) :
		
					/* Start the Loop */
					while ( have_posts() ) : the_post();
		
						get_template_part( 'components/content_single/content', 'offer' );
		
					endwhile;
				endif; 
			?>			
		</main><!-- #main -->
	</div><!-- primary -->
</div><!-- #content -->					
<?php get_footer(); ?>