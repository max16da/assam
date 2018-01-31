<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Assam
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php

			/*
			 * If a regular post or page, and not the front page, show the featured image.
			 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
			 */
			if ( ( is_single() || ( is_page() && ! assam_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
				echo '<div class="single-featured-image-header">';
				echo get_the_post_thumbnail( get_queried_object_id(), 'assam-featured-image' );
				echo '</div><!-- .single-featured-image-header -->';
			endif;

			?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/post/content', get_post_format() );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				the_post_navigation( array(
					'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'assam' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'assam' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . assam_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'assam' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'assam' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . assam_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
				) );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>

<?php get_footer();
