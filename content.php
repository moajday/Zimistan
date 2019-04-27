<?php
/**
 * @package Zimistan
 */
?>

<div class="post-summary post-full-summary">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<div class="entry-float">
				<?php if ( is_sticky() && is_home() && ! is_paged() ): ?>
				<div class="featured"><?php esc_html_e( 'Featured', 'write' ); ?></div>
				<?php endif; ?>
				<?php write_entry_meta(); ?>
			</div><!-- .entry-float -->
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		</header><!-- .entry-header -->
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	</article><!-- #post-## -->
</div><!-- .post-summary -->