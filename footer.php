<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Write
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<?php get_sidebar( 'footer' ); ?>

		<div class="site-bottom">
			<div class="site-bottom-table">
				<nav id="footer-social-link" class="footer-social-link social-link">
				<?php if ( has_nav_menu( 'footer-social' ) ) : ?>
					<?php wp_nav_menu( array( 'theme_location' => 'footer-social', 'depth' => 1, 'link_before'  => '<span class="screen-reader-text">', 'link_after'  => '</span>' ) ); ?>
				<?php endif; ?>
				</nav><!-- #footer-social-link -->

				<div class="site-info">
					<div class="site-credit">
						<span>&#169; 2018-19 Moajday.com</span>
					<span class="site-credit-sep"> | </span>
						<span>A. J. Bozdar</span>
					</div><!-- .site-credit -->
				</div><!-- .site-info -->
			</div><!-- .site-bottom-table -->
		</div><!-- .site-bottom -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
