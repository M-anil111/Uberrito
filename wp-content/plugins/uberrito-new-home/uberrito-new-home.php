<?php
/**
 * Plugin Name: Uberrito New Home Experience
 * Description: Isolated /new-home/ redesign and motion system for staging review.
 * Version: 1.2.0
 * Author: Uberrito
 */

defined( 'ABSPATH' ) || exit;

/**
 * Use the bundled page template only for the New Home experiment.
 */
function uberrito_new_home_plugin_template( $template ) {
	if ( is_page( 'new-home' ) ) {
		return plugin_dir_path( __FILE__ ) . 'page-new-home.php';
	}

	return $template;
}
add_filter( 'template_include', 'uberrito_new_home_plugin_template', 99 );

/**
 * Load only the assets required by /new-home/.
 */
function uberrito_new_home_plugin_assets() {
	if ( ! is_page( 'new-home' ) ) {
		return;
	}

	$base_path = plugin_dir_path( __FILE__ );
	$base_url  = plugin_dir_url( __FILE__ );

	// Prevent duplicate copies if the branch is later deployed into the child theme.
	wp_dequeue_style( 'uberrito-new-home' );
	wp_dequeue_script( 'uberrito-new-home' );

	wp_enqueue_style(
		'uberrito-new-home-live',
		$base_url . 'new-home.css',
		array(),
		filemtime( $base_path . 'new-home.css' )
	);

	wp_enqueue_script(
		'uberrito-new-home-live',
		$base_url . 'new-home.js',
		array(),
		filemtime( $base_path . 'new-home.js' ),
		true
	);

	wp_localize_script(
		'uberrito-new-home-live',
		'UberritoNewHome',
		array(
			'assetsUrl'    => trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/07/',
			'orderUrl'     => 'https://uberrito.toast.site/',
			'rewardsUrl'   => home_url( '/rewards/' ),
			'locationsUrl' => home_url( '/locations/' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'uberrito_new_home_plugin_assets', 100 );

function uberrito_new_home_plugin_body_class( $classes ) {
	if ( is_page( 'new-home' ) ) {
		$classes[] = 'ub-new-home-page';
	}

	return $classes;
}
add_filter( 'body_class', 'uberrito_new_home_plugin_body_class' );

/**
 * The staging review page must always show the newest design build.
 */
function uberrito_new_home_disable_page_cache() {
	if ( ! is_page( 'new-home' ) ) {
		return;
	}

	if ( ! defined( 'DONOTCACHEPAGE' ) ) {
		define( 'DONOTCACHEPAGE', true );
	}

	nocache_headers();
}
add_action( 'template_redirect', 'uberrito_new_home_disable_page_cache', 1 );
