<?php
/*
 * This is the child theme for Hello Elementor theme, generated with Generate Child Theme plugin by catchthemes.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_styles' );
function hello_elementor_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}
/*
 * Your code goes below
 */
/*
 * Uberrito front-end effects (page curtain + staggered menu reveal).
 * Assets live in this child theme's /assets folder — no plugin required.
 */
add_action( 'wp_enqueue_scripts', 'ubr_effects_enqueue', 20 );
function ubr_effects_enqueue() {
	$dir = get_stylesheet_directory();
	$uri = get_stylesheet_directory_uri();
	$css = $dir . '/assets/ubr-effects.css';
	$js  = $dir . '/assets/ubr-effects.js';
	if ( file_exists( $css ) ) {
		wp_enqueue_style( 'ubr-effects', $uri . '/assets/ubr-effects.css', array(), filemtime( $css ) );
	}
	if ( file_exists( $js ) ) {
		wp_enqueue_script( 'ubr-effects', $uri . '/assets/ubr-effects.js', array(), filemtime( $js ), true );
		$logo = wp_get_upload_dir()['baseurl'] . '/2026/07/uberrito-horz-1.png';
		wp_add_inline_script( 'ubr-effects', 'window.UBR_FX_LOGO=' . wp_json_encode( $logo ) . ';', 'before' );
	}
}

/**
 * Enqueue Child Theme Styles
 */
function hello_child_enqueue_styles() {

    wp_enqueue_style(
        'hello-child-style',
        get_stylesheet_directory_uri() . '/assets/css/style.css',
        array(),
        filemtime( get_stylesheet_directory() . '/assets/css/style.css' )
    );

}
add_action( 'wp_enqueue_scripts', 'hello_child_enqueue_styles', 20 );