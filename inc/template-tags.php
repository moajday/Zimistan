<?php
/**
 * Custom template tags for this theme.
 *
 * @package Zimistan
 */

if ( ! function_exists( 'write_site_title' ) ) :
/**
 * Display site title.
 */
function write_site_title() {
	if ( get_theme_mod( 'custom_logo' ) && get_theme_mod( 'write_replace_blogname' ) ) {
		return;
	}
	$title_tag = ( is_front_page() ) ? 'h1' : 'div';
	?>
	<<?php echo esc_attr( $title_tag ); ?> class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></<?php echo esc_attr( $title_tag ); ?>>
	<?php
}
endif;

if ( ! function_exists( 'write_featured_post_background' ) ) :
/**
 * Set background of featured posts.
 */
function write_featured_post_background( $image_size = 'write-post-thumbnail-large' ) {
	$featured_url = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_size );
	if ( $featured_url ) {
		 echo ' style="background-image:url(\'' . esc_url( $featured_url[0] ) . '\')"';
	}
}
endif;

if ( ! function_exists( 'write_entry_meta' ) ) :
/**
 * Display post header meta.
 */
function write_entry_meta() {
	// Hide for pages on Search.
	if ( 'post' != get_post_type() ) {
		return;
	}
	?>
	<div class="entry-meta">
		<span class="posted-on">
		<?php printf( '<a href="%1$s" rel="bookmark"><time class="entry-date published updated" datetime="%2$s">%3$s</time></a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		); ?>
		</span>
	</div><!-- .entry-meta -->
	<?php
}
endif;

if ( ! function_exists( 'write_footer_meta' ) ) :
/**
 * Display post footer meta when applicable.
 */
function write_footer_meta() {
	// Don't print empty markup if there's no Categories or Tags.
	$tags_list = get_the_tag_list( '', __( ', ', 'write' ) );
	?>
	<footer class="entry-footer">
		<div class="entry-footer-meta">
			<div class="cat-links">
				<?php the_category( __( ', ', 'write' ) ); ?>
			</div>
			<?php if ( '' != $tags_list ) : ?>
			<div class="tags-links">
				<?php echo $tags_list; ?>
			</div>
			<?php endif; // End if $tags_list ?>
		</div>
	</footer><!-- .entry-footer -->
	<?php
}
endif;

if ( ! function_exists( 'write_author_profile' ) ) :
/**
 * Display author profile when applicable.
 */
function write_author_profile() {
	if ( get_post_format() || get_theme_mod( 'write_hide_author_profile' ) ) {
		return;
	}
	?>
	<div class="author-profile">
		<div class="author-profile-avatar">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 75 ); ?>
		</div><!-- .author-profile-avatar -->
		<div class="author-profile-meta">
			<div class="author-profile-name"><strong><a class="author-profile-description-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php the_author() ?></a></strong></div>
		</div><!-- .author-profile-meta -->
		<div class="author-profile-description">
			<?php the_author_meta( 'description' ); ?>
		</div><!-- .author-profile-description -->
	</div><!-- .author-profile -->
	<?php
}
endif;

if ( ! function_exists( 'write_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function write_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'write' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous"><div class="post-nav-title">' . esc_html__( 'Older post', 'write' ) . '</div>%link</div>', esc_html_x( '%title', 'Previous post link', 'write' ) );
				next_post_link( '<div class="nav-next"><div class="post-nav-title">' . esc_html__( 'Newer post', 'write' ) . '</div>%link</div>', esc_html_x( '%title', 'Next post link', 'write' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .post-navigation -->
	<?php
}
endif;