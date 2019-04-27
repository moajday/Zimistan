<?php
/**
 * Zimistan Theme Customizer
 *
 * @package Zimistan
 */

/**
 * Set the Customizer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function write_customize_register( $wp_customize ) {


	// Site Identity
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Fonts
	global $write_home_text_font;
	$write_home_text_font = array(
			''                         => esc_html__( 'Default', 'write' ),
			'Safe Serif'               => 'Georgia, serif',
			'Safe Sans'                => 'Helvetica, Arial, sans-serif',
			'Selected Fonts'           => esc_html__( '----- Selected Fonts -----', 'write' ),
			'Slabo 27px:400'           => 'Slabo 27px',
			'PT Serif:400'             => 'PT Serif',
			'Alegreya:400'             => 'Alegreya',
			'Vollkorn:400'             => 'Vollkorn',
			'Crimson Text:400'         => 'Crimson Text',
			'Vesper Libre:400'         => 'Vesper Libre',
			'Halant:400'               => 'Halant',
			'Josefin Slab:400'         => 'Josefin Slab',
			'Source Sans Pro:400'      => 'Source Sans Pro',
			'Source Sans Pro:300'      => 'Source Sans Pro Light',
			'PT Sans:400'              => 'PT Sans',
			'Roboto:400'               => 'Roboto',
			'Roboto:300'               => 'Roboto Light',
			'Fira Sans:400'            => 'Fira Sans',
			'Fira Sans:300'            => 'Fira Sans Light',
			'Josefin Sans:400'         => 'Josefin Sans',
			'Fredericka the Great:400' => 'Fredericka the Great',
	);
	require get_template_directory() . '/inc/google-fonts.php';
	$write_all_fonts = write_all_google_fonts();
	$write_home_text_font = $write_home_text_font + $write_all_fonts;
	if ('ja' == get_bloginfo( 'language' ) ) {
		$write_home_text_font = array( 'Japanese Sans' => esc_html__( 'Japanese Sans', 'write' ) ) + $write_home_text_font;
	}

	// Colors
	$wp_customize->get_section( 'colors' )->priority     = 35;
	$wp_customize->add_setting( 'write_link_color' , array(
		'default'   => '#03a9f4',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'write_link_color', array(
		'label'    => esc_html__( 'Link Color', 'write' ),
		'section'  => 'colors',
		'priority' => 13,
	) ) );
	$wp_customize->add_setting( 'write_link_hover_color' , array(
		'default'           => '#03a9f4',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'write_link_hover_color', array(
		'label'    => esc_html__( 'Link Hover Color', 'write' ),
		'section'  => 'colors',
		'priority' => 14,
	) ) );

	// Header Image
	$wp_customize->add_setting( 'write_header_display', array(
		'default'           => '',
		'sanitize_callback' => 'write_sanitize_header_display'
	) );
	$wp_customize->add_control( 'write_header_display', array(
		'label'   => esc_html__( 'Header Image Display', 'write' ),
		'section' => 'header_image',
		'type'    => 'radio',
		'choices' => array(
			''         => esc_html__( 'Display on the blog posts index page', 'write' ),
			'page'     => esc_html__( 'Display on all static pages', 'write' ),
			'site'     => esc_html__( 'Display on the whole site', 'write' ),
		),
		'priority' => 20,
	) );

	// Home
	$wp_customize->add_section( 'write_home', array(
		'title'       => __( 'Home', 'write' ),
		'description' => __( 'HTML tags are allowed in the home text.', 'write' ),
		'priority'    => 75,
	) );
	$wp_customize->add_setting( 'write_home_text', array(
		'default'           => '',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'write_home_text', array(
		'label'    => __( 'Home Text', 'write' ),
		'section'  => 'write_home',
		'type'     => 'textarea',
		'priority' => 11,
	) );
	$wp_customize->add_setting( 'write_home_text_font', array(
		'default'           => '',
		'sanitize_callback' => 'write_sanitize_home_text_font',
	) );
	$wp_customize->add_control( 'write_home_text_font', array(
		'label'   => __( 'Font', 'write' ),
		'section' => 'write_home',
		'type'    => 'select',
		'choices' => $write_home_text_font,
		'priority' => 12,
	) );
	$wp_customize->add_setting( 'write_home_text_font_size', array(
		'default'           => ( 'ja' == get_bloginfo( 'language' ) ) ? '27' : '32',
		'sanitize_callback' => 'write_sanitize_home_text_font_size',
	) );
	$wp_customize->add_control( 'write_home_text_font_size', array(
		'label'    => __( 'Font Size (px)', 'write' ),
		'section'  => 'write_home',
		'type'     => 'text',
		'priority' => 13,
	));
	$wp_customize->add_setting( 'write_home_text_display', array(
		'default'           => '',
		'sanitize_callback' => 'write_sanitize_home_display'
	) );
	$wp_customize->add_control( 'write_home_text_display', array(
		'label'   => esc_html__( 'Home Text Display', 'write' ),
		'section' => 'write_home',
		'type'    => 'radio',
		'choices' => array(
			''          => esc_html__( 'Display on the blog posts index page', 'write' ),
			'front'     => esc_html__( 'Display on the static front page', 'write' ),
			'site'      => esc_html__( 'Display on the whole site', 'write' ),
		),
		'priority' => 14,
	) );

	// Menus
	$wp_customize->add_setting( 'write_hide_navigation', array(
		'default'           => '',
		'sanitize_callback' => 'write_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'write_hide_navigation', array(
		'label'    => esc_html__( 'Hide Main Navigation', 'write' ),
		'section'  => 'menu_locations',
		'type'     => 'checkbox',
		'priority' => 1,
	) );
	$wp_customize->add_setting( 'write_hide_search', array(
		'default'           => '',
		'sanitize_callback' => 'write_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'write_hide_search', array(
		'label'    => esc_html__( 'Hide Search on Main Navigation', 'write' ),
		'section'  => 'menu_locations',
		'type'     => 'checkbox',
		'priority' => 2,
	) );
}
add_action( 'customize_register', 'write_customize_register' );

/**
 * Sanitize user inputs.
 */
function write_sanitize_checkbox( $value ) {
	if ( $value == 1 ) {
		return 1;
	} else {
		return '';
	}
}
function write_sanitize_margin( $value ) {
	if ( preg_match("/^-?[0-9]+$/", $value) ) {
		return $value;
	} else {
		return '0';
	}
}
function write_sanitize_header_display( $value ) {
	$valid = array(
		''         => esc_html__( 'Display on the blog posts index page', 'write' ),
		'page'     => esc_html__( 'Display on all static pages', 'write' ),
		'site'     => esc_html__( 'Display on the whole site', 'write' ),
	);

	if ( array_key_exists( $value, $valid ) ) {
		return $value;
	} else {
		return '';
	}
}
function write_sanitize_home_display( $value ) {
	$valid = array(
		''          => esc_html__( 'Display on the blog posts index page', 'write' ),
		'front'     => esc_html__( 'Display on the static front page', 'write' ),
		'site'      => esc_html__( 'Display on the whole site', 'write' ),
	);

	if ( array_key_exists( $value, $valid ) ) {
		return $value;
	} else {
		return '';
	}
}
function write_sanitize_home_text_font( $value ) {
	global $write_home_text_font;
	unset ( $write_home_text_font['Selected Fonts'] );
	unset ( $write_home_text_font['All Fonts'] );
	$valid = $write_home_text_font;

	if ( array_key_exists( $value, $valid ) ) {
		return $value;
	} else {
		return '';
	}
}
function write_sanitize_home_text_font_size( $value ) {
	if ( preg_match("/^[1-9][0-9]*$/", $value) ) {
		return $value;
	} else {
		return ( 'ja' == get_bloginfo( 'language' ) ) ? '27' : '32';
	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function write_customize_preview_js() {
	wp_enqueue_script( 'write_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20180907', true );
}
add_action( 'customize_preview_init', 'write_customize_preview_js' );


/**
 * Enqueue Customizer CSS
 */
function write_customizer_style() {
	wp_enqueue_style( 'write-customizer-style', get_template_directory_uri() . '/css/customizer.css', array() );
}
add_action( 'customize_controls_print_styles', 'write_customizer_style');
