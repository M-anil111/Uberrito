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
	if ( is_page( 'new-home' ) ) {
		return;
	}

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

    // Parent Theme
    wp_enqueue_style(
        'hello-elementor',
        get_template_directory_uri() . '/style.css'
    );

    // Child Theme CSS
    wp_enqueue_style(
        'hello-child-style',
        get_stylesheet_directory_uri() . '/assets/css/style.css',
        array( 'hello-elementor' ),
        filemtime( get_stylesheet_directory() . '/assets/css/style.css' )
    );

}
add_action( 'wp_enqueue_scripts', 'hello_child_enqueue_styles', PHP_INT_MAX );

/**
 * Swiper + GSAP Assets
 */
function uberrito_enqueue_animation_assets() {
	if ( is_page( 'new-home' ) ) {
		return;
	}

    // Swiper CSS
    wp_enqueue_style(
        'swiper-css',
        get_stylesheet_directory_uri() . '/assets/libs/swiper/css/swiper-bundle.min.css',
        array(),
        '11.0.0'
    );

    // Swiper JS
    wp_enqueue_script(
        'swiper-js',
        get_stylesheet_directory_uri() . '/assets/libs/swiper/js/swiper-bundle.min.js',
        array(),
        '11.0.0',
        true
    );

    // GSAP
    wp_enqueue_script(
        'gsap-js',
        get_stylesheet_directory_uri() . '/assets/libs/gsap/gsap.min.js',
        array(),
        '3.13.0',
        true
    );

    // Custom JS
    wp_enqueue_script(
        'custom-js',
        get_stylesheet_directory_uri() . '/assets/js/custom.js',
        array('swiper-js', 'gsap-js'),
        filemtime(get_stylesheet_directory() . '/assets/js/custom.js'),
        true
    );

}
add_action( 'wp_enqueue_scripts', 'uberrito_enqueue_animation_assets' );

/**
 * Homepage redesign assets. Kept separate from the legacy Elementor styles so
 * the new experience can be reviewed and rolled back independently.
 */
function uberrito_enqueue_home_redesign_assets() {
	if ( ! is_page( 'uberrito-home' ) ) {
		return;
	}

	$dir = get_stylesheet_directory();
	$uri = get_stylesheet_directory_uri();
	$css = $dir . '/assets/css/home-redesign.css';
	$js  = $dir . '/assets/js/home-redesign.js';

	wp_enqueue_style(
		'uberrito-home-redesign',
		$uri . '/assets/css/home-redesign.css',
		array( 'child-style' ),
		filemtime( $css )
	);

	wp_enqueue_script(
		'uberrito-home-redesign',
		$uri . '/assets/js/home-redesign.js',
		array( 'custom-js' ),
		filemtime( $js ),
		true
	);

	wp_localize_script(
		'uberrito-home-redesign',
		'UberritoHome',
		array(
			'rewardsUrl' => home_url( '/rewards/' ),
			'orderUrl'   => 'https://uberrito.toast.site/',
			'assetsUrl'  => wp_get_upload_dir()['baseurl'] . '/2026/07/',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'uberrito_enqueue_home_redesign_assets', 30 );

/**
 * Give the redesign a dedicated body hook without changing Elementor data.
 */
function uberrito_home_redesign_body_class( $classes ) {
	if ( is_page( 'uberrito-home' ) ) {
		$classes[] = 'ub-home-redesign';
	}

	return $classes;
}
add_filter( 'body_class', 'uberrito_home_redesign_body_class' );

/**
 * Experimental CRAV-inspired homepage. This is intentionally isolated at
 * /new-home/ so the approved homepage and the rest of the site are untouched.
 */
function uberrito_enqueue_new_home_assets() {
	if ( ! is_page( 'new-home' ) ) {
		return;
	}

	$dir = get_stylesheet_directory();
	$uri = get_stylesheet_directory_uri();

	wp_enqueue_style(
		'uberrito-new-home',
		$uri . '/assets/css/new-home.css',
		array( 'child-style' ),
		filemtime( $dir . '/assets/css/new-home.css' )
	);

	wp_enqueue_script(
		'uberrito-new-home',
		$uri . '/assets/js/new-home.js',
		array(),
		filemtime( $dir . '/assets/js/new-home.js' ),
		true
	);

	wp_localize_script(
		'uberrito-new-home',
		'UberritoNewHome',
		array(
			'assetsUrl'    => trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/07/',
			'orderUrl'     => 'https://uberrito.toast.site/',
			'rewardsUrl'   => home_url( '/rewards/' ),
			'locationsUrl' => home_url( '/locations/' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'uberrito_enqueue_new_home_assets', 35 );

function uberrito_new_home_body_class( $classes ) {
	if ( is_page( 'new-home' ) ) {
		$classes[] = 'ub-new-home-page';
	}

	return $classes;
}
add_filter( 'body_class', 'uberrito_new_home_body_class' );
