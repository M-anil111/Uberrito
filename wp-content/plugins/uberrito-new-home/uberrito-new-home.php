<?php
/**
 * Plugin Name: Uberrito New Home Experience
 * Description: Isolated /new-home/ redesign and motion system for staging review.
 * Version: 1.5.3
 * Author: Uberrito
 */

defined( 'ABSPATH' ) || exit;

require_once plugin_dir_path( __FILE__ ) . 'includes/elementor-home-migration.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/elementor-new-home-v142.php';

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
	wp_dequeue_style( 'uberrito-new-home-live' );
	wp_dequeue_script( 'uberrito-new-home-live' );

	wp_enqueue_style(
		'uberrito-new-home-live-v132',
		$base_url . 'new-home-v132.css',
		array(),
		'1.3.5'
	);

	wp_enqueue_script(
		'uberrito-new-home-live-v132',
		$base_url . 'new-home-v132.js',
		array(),
		'1.3.5',
		true
	);

	wp_localize_script(
		'uberrito-new-home-live-v132',
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

/**
 * The production-minded homepage is native Elementor content. These assets
 * supply only the visual system and interactions that Elementor cannot express.
 */
function uberrito_elementor_home_assets() {
	if ( ! is_page( 'uberrito-home' ) ) {
		return;
	}

	$base_path = plugin_dir_path( __FILE__ );
	$base_url  = plugin_dir_url( __FILE__ );

	// Remove the retired template-level animation layer on this page only.
	wp_dequeue_style( 'uberrito-home-redesign' );
	wp_dequeue_script( 'uberrito-home-redesign' );

	wp_enqueue_style( 'uberrito-elementor-reference-v132', $base_url . 'new-home-v132.css', array( 'elementor-frontend' ), '1.3.5' );
	wp_enqueue_style(
		'uberrito-elementor-home-v153',
		$base_url . 'assets/elementor-home-v150.css?release=153',
		array( 'uberrito-elementor-reference-v132' ),
		'1.5.3'
	);

	wp_enqueue_script(
		'uberrito-elementor-home-v153',
		$base_url . 'assets/elementor-home-v150.js?release=153',
		array(),
		'1.5.3',
		true
	);
	wp_localize_script(
		'uberrito-elementor-home-v153',
		'UberritoNewHome',
		array(
			'assetsUrl'    => trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/07/',
			'orderUrl'     => 'https://uberrito.toast.site/',
			'rewardsUrl'   => home_url( '/rewards/' ),
			'locationsUrl' => home_url( '/locations/' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'uberrito_elementor_home_assets', 120 );

function uberrito_elementor_home_body_class( $classes ) {
	if ( is_page( 'uberrito-home' ) ) {
		$classes[] = 'ub-elementor-home-page';
		$classes[] = 'ub-new-home-page';
	}
	return $classes;
}
add_filter( 'body_class', 'uberrito_elementor_home_body_class', 30 );

/**
 * The isolated template does not render Elementor or the child-theme shell.
 * Removing those unused assets avoids several render-blocking requests on mobile.
 */
function uberrito_new_home_remove_unused_assets() {
	if ( ! is_page( 'new-home' ) ) {
		return;
	}

	$styles = array(
		'litespeed-cache-dummy', 'parent-style', 'child-style', 'swiper-css',
		'hello-elementor', 'hello-elementor-theme-style', 'hello-elementor-header-footer',
		'elementor-frontend', 'elementor-post-11', 'widget-image', 'widget-nav-menu',
		'e-animation-fadeInUp', 'widget-social-icons', 'e-apple-webkit', 'widget-heading',
		'widget-icon-list', 'widget-form', 'e-animation-zoomIn', 'e-popup',
		'elementor-post-39', 'elementor-post-40', 'elementor-post-49', 'ubr-effects',
		'hello-child-style', 'elementor-gf-oswald', 'elementor-gf-poppins',
	);

	$scripts = array(
		'jquery', 'jquery-core', 'jquery-migrate', 'swiper-js', 'gsap-js', 'custom-js',
		'hello-theme-frontend', 'elementor-webpack-runtime', 'elementor-frontend-modules',
		'jquery-ui-core', 'elementor-frontend', 'smartmenus', 'ubr-effects',
		'elementor-pro-webpack-runtime', 'wp-hooks', 'wp-i18n', 'elementor-pro-frontend',
		'pro-elements-handlers',
	);

	foreach ( $styles as $handle ) {
		wp_dequeue_style( $handle );
	}

	foreach ( $scripts as $handle ) {
		wp_dequeue_script( $handle );
	}
}
add_action( 'wp_enqueue_scripts', 'uberrito_new_home_remove_unused_assets', 999 );
add_action( 'wp_head', 'uberrito_new_home_remove_unused_assets', 7 );
add_action( 'wp_footer', 'uberrito_new_home_remove_unused_assets', 0 );

function uberrito_new_home_filter_style_tag( $html, $handle ) {
	if ( ! is_page( 'new-home' ) ) {
		return $html;
	}

	$allowed = array( 'uberrito-new-home-live-v132', 'admin-bar', 'dashicons' );
	return in_array( $handle, $allowed, true ) ? $html : '';
}
add_filter( 'style_loader_tag', 'uberrito_new_home_filter_style_tag', 999, 2 );

function uberrito_new_home_filter_script_tag( $tag, $handle ) {
	if ( ! is_page( 'new-home' ) ) {
		return $tag;
	}

	return 'uberrito-new-home-live-v132' === $handle ? $tag : '';
}
add_filter( 'script_loader_tag', 'uberrito_new_home_filter_script_tag', 999, 2 );

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
	if ( ! is_page( array( 'new-home', 'uberrito-home' ) ) ) {
		return;
	}

	if ( ! defined( 'DONOTCACHEPAGE' ) ) {
		define( 'DONOTCACHEPAGE', true );
	}

	if ( ! defined( 'LITESPEED_NO_OPTM' ) ) {
		define( 'LITESPEED_NO_OPTM', true );
	}

	nocache_headers();
}
add_action( 'template_redirect', 'uberrito_new_home_disable_page_cache', 1 );

/** Keep the isolated redesign assets out of LiteSpeed's generated bundles. */
function uberrito_new_home_litespeed_excludes( $excludes ) {
	$excludes[] = 'uberrito-new-home-live';
	$excludes[] = 'new-home.css';
	$excludes[] = 'new-home.js';
	$excludes[] = 'new-home-v130.css';
	$excludes[] = 'new-home-v130.js';
	$excludes[] = 'new-home-v132.css';
	$excludes[] = 'new-home-v132.js';
	$excludes[] = 'elementor-home-v150.css';
	$excludes[] = 'elementor-home-v150.js';
	return array_unique( $excludes );
}
add_filter( 'litespeed_optimize_css_excludes', 'uberrito_new_home_litespeed_excludes' );
add_filter( 'litespeed_optimize_js_excludes', 'uberrito_new_home_litespeed_excludes' );
