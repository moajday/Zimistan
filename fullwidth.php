<?php
/**
 * Template Name: Full Width
 * Description: A full width page template.
 *
 * @package Zimistan
 */

get_header(); ?>

<?php if ( has_post_thumbnail( $post->ID ) ): ?>
<div class="post-thumbnail-large""><?php echo get_the_post_thumbnail( $post->ID, 'write-post-thumbnail-large' ); ?></div>
<?php endif; ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'page' ); ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>

	<?php endwhile; // End of the loop. ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
