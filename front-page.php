<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Assam
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php // Show the selected frontpage content.
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/page/content', 'front-page' );
			endwhile;
		else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
			get_template_part( 'template-parts/post/content', 'none' );
		endif; ?>

		<?php
		// Get each of our panels and show the post data.
		if ( 0 !== assam_panel_count() || is_customize_preview() ) : // If we have pages to show.

			/**
			 * Filter number of front page sections in Twenty Seventeen.
			 *
			 * @since Twenty Seventeen 1.0
			 *
			 * @param int $num_sections Number of front page sections.
			 */
			$num_sections = apply_filters( 'assam_front_page_sections', 4 );
			global $assamcounter;

			// Create a setting and control for each of the sections available in the theme.
			for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
				$assamcounter = $i;
				assam_front_page_section( null, $i );
			}

	endif; // The if ( 0 !== assam_panel_count() ) ends here. ?>

	<h2>Derniers articles</h2>
	<div class="posts">


	<?php
	global $post;
	$args = array( 'posts_per_page' => 5, 'order'=> 'DESC');
	$postslist = get_posts( $args );
	foreach ( $postslist as $post ) :
	setup_postdata( $post ); ?>

	<article>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php the_post_thumbnail('medium', array('class' => 'img-responsive aligncenter')); ?>
		<section>
			<span><?php the_date(); ?></span>
			<p><?php the_excerpt(); ?></p>
		</section>
	</article>

	<?php
endforeach;
wp_reset_postdata();
?>
  <article class="blog_page">
    <?php echo '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '" title="See all posts"><img src="' . get_template_directory_uri() . '/assets/images/plus.png"/></a>'; ?>
  </article>
</div>
  

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
