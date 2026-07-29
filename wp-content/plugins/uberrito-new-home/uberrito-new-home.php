<?php
/**
 * Plugin Name: Uberrito New Home Experience
 * Description: Isolated /new-home/ redesign and motion system for staging review.
 * Version: 2.2.2
 * Author: Uberrito
 */

defined( 'ABSPATH' ) || exit;

require_once plugin_dir_path( __FILE__ ) . 'includes/elementor-home-migration.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/elementor-new-home-v142.php';

/**
 * Editable location details used by the isolated /new-home/ experience.
 */
function uberrito_new_home_location_defaults() {
	$uploads = trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/07/';
	return array(
		'atascocita' => array(
			'name'         => 'Atascocita',
			'address_one'  => '7025 Farm to Market 1960 Rd E',
			'address_two'  => 'Humble, TX 77346',
			'open_time'    => '10:45',
			'close_time'   => '21:00',
			'directions'   => 'https://www.google.com/maps/dir/?api=1&destination=7025%20Farm%20to%20Market%201960%20Rd%20E%2C%20Humble%2C%20TX%2077346',
			'image'        => $uploads . 'uberrito-atascocita-exterior.jpeg',
		),
		'sugar_land' => array(
			'name'         => 'Sugar Land',
			'address_one'  => '2735 Town Center Blvd N, Suite C',
			'address_two'  => 'Sugar Land, TX 77479',
			'open_time'    => '10:30',
			'close_time'   => '22:30',
			'directions'   => 'https://www.google.com/maps/dir/?api=1&destination=2735%20Town%20Center%20Blvd%20N%2C%20Sugar%20Land%2C%20TX%2077479',
			'image'        => $uploads . 'uberrito-restaurant-interior.jpeg',
		),
	);
}

function uberrito_new_home_locations() {
	$saved    = get_option( 'uberrito_new_home_locations', array() );
	$defaults = uberrito_new_home_location_defaults();

	foreach ( $defaults as $key => $location ) {
		if ( isset( $saved[ $key ] ) && is_array( $saved[ $key ] ) ) {
			$defaults[ $key ] = wp_parse_args( $saved[ $key ], $location );
		}
	}

	return $defaults;
}

function uberrito_new_home_sanitize_locations( $value ) {
	$clean = uberrito_new_home_location_defaults();
	foreach ( $clean as $key => $location ) {
		$submitted = isset( $value[ $key ] ) && is_array( $value[ $key ] ) ? $value[ $key ] : array();
		$clean[ $key ] = array(
			'name'        => sanitize_text_field( $submitted['name'] ?? $location['name'] ),
			'address_one' => sanitize_text_field( $submitted['address_one'] ?? $location['address_one'] ),
			'address_two' => sanitize_text_field( $submitted['address_two'] ?? $location['address_two'] ),
			'open_time'   => preg_match( '/^\d{2}:\d{2}$/', $submitted['open_time'] ?? '' ) ? $submitted['open_time'] : $location['open_time'],
			'close_time'  => preg_match( '/^\d{2}:\d{2}$/', $submitted['close_time'] ?? '' ) ? $submitted['close_time'] : $location['close_time'],
			'directions'  => esc_url_raw( $submitted['directions'] ?? $location['directions'] ),
			'image'       => esc_url_raw( $submitted['image'] ?? $location['image'] ),
		);
	}
	return $clean;
}

function uberrito_new_home_register_location_settings() {
	register_setting(
		'uberrito_new_home_locations',
		'uberrito_new_home_locations',
		array( 'sanitize_callback' => 'uberrito_new_home_sanitize_locations' )
	);
}
add_action( 'admin_init', 'uberrito_new_home_register_location_settings' );

function uberrito_new_home_location_settings_page() {
	add_options_page(
		'Uberrito New Home Locations',
		'Uberrito Locations',
		'manage_options',
		'uberrito-new-home-locations',
		'uberrito_new_home_render_location_settings'
	);
}
add_action( 'admin_menu', 'uberrito_new_home_location_settings_page' );

function uberrito_new_home_render_location_settings() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$locations = uberrito_new_home_locations();
	?>
	<div class="wrap">
		<h1>Uberrito New Home Locations</h1>
		<p>These details control the two location cards and their live Open now / Closed status on <code>/new-home/</code>. Times use America/Chicago and apply every day.</p>
		<form method="post" action="options.php">
			<?php settings_fields( 'uberrito_new_home_locations' ); ?>
			<?php foreach ( $locations as $key => $location ) : ?>
				<h2><?php echo esc_html( $location['name'] ); ?></h2>
				<table class="form-table" role="presentation">
					<?php
					$fields = array(
						'name'        => array( 'Location name', 'text' ),
						'address_one' => array( 'Address line 1', 'text' ),
						'address_two' => array( 'Address line 2', 'text' ),
						'open_time'   => array( 'Daily opening time', 'time' ),
						'close_time'  => array( 'Daily closing time', 'time' ),
						'directions'  => array( 'Directions URL', 'url' ),
						'image'       => array( 'Location image URL', 'url' ),
					);
					foreach ( $fields as $field => $meta ) :
						?>
						<tr>
							<th scope="row"><label for="<?php echo esc_attr( $key . '-' . $field ); ?>"><?php echo esc_html( $meta[0] ); ?></label></th>
							<td><input class="regular-text" type="<?php echo esc_attr( $meta[1] ); ?>" id="<?php echo esc_attr( $key . '-' . $field ); ?>" name="uberrito_new_home_locations[<?php echo esc_attr( $key ); ?>][<?php echo esc_attr( $field ); ?>]" value="<?php echo esc_attr( $location[ $field ] ); ?>"></td>
						</tr>
					<?php endforeach; ?>
				</table>
			<?php endforeach; ?>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

function uberrito_new_home_location_status( $location ) {
	try {
		$timezone = new DateTimeZone( 'America/Chicago' );
		$now      = new DateTimeImmutable( 'now', $timezone );
		$open     = DateTimeImmutable::createFromFormat( 'Y-m-d H:i', $now->format( 'Y-m-d' ) . ' ' . $location['open_time'], $timezone );
		$close    = DateTimeImmutable::createFromFormat( 'Y-m-d H:i', $now->format( 'Y-m-d' ) . ' ' . $location['close_time'], $timezone );
		$is_open  = $open && $close && $now >= $open && $now < $close;
	} catch ( Exception $exception ) {
		$is_open = false;
	}

	return array(
		'is_open' => $is_open,
		'label'   => $is_open ? 'Open now' : 'Closed',
	);
}

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
 * Keep every unfinished staging destination inside staging.
 */
function uberrito_new_home_safe_url( $path, $label = '' ) {
	$segments = array_filter( array_map( 'sanitize_title', explode( '/', trim( (string) $path, '/' ) ) ) );
	$path     = implode( '/', $segments );
	$page = $path ? get_page_by_path( $path ) : null;
	if ( $page instanceof WP_Post && 'publish' === $page->post_status ) {
		return get_permalink( $page );
	}

	return add_query_arg(
		'section',
		$label ? $label : ucwords( str_replace( '-', ' ', $path ) ),
		home_url( '/coming-soon/' )
	);
}

function uberrito_new_home_ensure_support_pages() {
	if ( ! get_page_by_path( 'coming-soon' ) ) {
		wp_insert_post(
			array(
				'post_title'   => 'Coming Soon',
				'post_name'    => 'coming-soon',
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => 'This fresh page is still being rolled.',
			)
		);
	}

	add_option( 'uberrito_game_high_score', 120000, '', false );
	add_option( 'uberrito_game_scoreboard', array(), '', false );
	if ( absint( get_option( 'uberrito_game_high_score', 0 ) ) < 120000 ) {
		update_option( 'uberrito_game_high_score', 120000, false );
	}

	if ( '2.2.0' !== get_option( 'uberrito_new_home_location_asset_version' ) ) {
		$locations = get_option( 'uberrito_new_home_locations', array() );
		$locations = is_array( $locations ) ? $locations : array();
		$defaults  = uberrito_new_home_location_defaults();
		foreach ( $defaults as $key => $default ) {
			$current = $locations[ $key ]['image'] ?? '';
			if ( ! $current || str_contains( $current, 'location-atascocita-google' ) || str_contains( $current, 'location-sugar-land-google' ) ) {
				$locations[ $key ]          = wp_parse_args( $locations[ $key ] ?? array(), $default );
				$locations[ $key ]['image'] = $default['image'];
			}
		}
		update_option( 'uberrito_new_home_locations', $locations, false );
		update_option( 'uberrito_new_home_location_asset_version', '2.2.0', false );
	}
}
add_action( 'init', 'uberrito_new_home_ensure_support_pages', 5 );

function uberrito_new_home_support_template( $template ) {
	if ( is_page( 'coming-soon' ) ) {
		return plugin_dir_path( __FILE__ ) . 'page-coming-soon.php';
	}
	return $template;
}
add_filter( 'template_include', 'uberrito_new_home_support_template', 100 );

/**
 * Store the public high score and a compact top-ten scoreboard in WordPress.
 */
function uberrito_new_home_register_game_api() {
	register_rest_route(
		'uberrito/v1',
		'/game-score',
		array(
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => static function () {
					return rest_ensure_response( array( 'highScore' => max( 120000, absint( get_option( 'uberrito_game_high_score', 120000 ) ) ) ) );
				},
				'permission_callback' => '__return_true',
			),
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => static function ( WP_REST_Request $request ) {
					$score = min( 10000000, max( 0, absint( $request->get_param( 'score' ) ) ) );
					$high  = max( 120000, absint( get_option( 'uberrito_game_high_score', 120000 ) ) );
					if ( $score > $high ) {
						$high = $score;
						update_option( 'uberrito_game_high_score', $high, false );
					}

					if ( $score > 0 ) {
						$board   = get_option( 'uberrito_game_scoreboard', array() );
						$board   = is_array( $board ) ? $board : array();
						$board[] = array( 'score' => $score, 'date' => current_time( 'mysql', true ) );
						usort( $board, static fn( $a, $b ) => absint( $b['score'] ?? 0 ) <=> absint( $a['score'] ?? 0 ) );
						update_option( 'uberrito_game_scoreboard', array_slice( $board, 0, 10 ), false );
					}

					return rest_ensure_response( array( 'highScore' => $high ) );
				},
				'permission_callback' => '__return_true',
			),
		)
	);
}
add_action( 'rest_api_init', 'uberrito_new_home_register_game_api' );

function uberrito_new_home_register_signups() {
	register_post_type(
		'uberrito_signup',
		array(
			'labels'       => array( 'name' => 'Newsletter Signups', 'singular_name' => 'Newsletter Signup' ),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => 'tools.php',
			'supports'     => array( 'title' ),
		)
	);
}
add_action( 'init', 'uberrito_new_home_register_signups' );

function uberrito_new_home_newsletter_signup() {
	$redirect = home_url( '/new-home/#newsletter' );
	if ( ! isset( $_POST['uberrito_newsletter_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['uberrito_newsletter_nonce'] ) ), 'uberrito_newsletter' ) ) {
		wp_safe_redirect( add_query_arg( 'signup', 'error', $redirect ) );
		exit;
	}

	$first = sanitize_text_field( wp_unslash( $_POST['first_name'] ?? '' ) );
	$last  = sanitize_text_field( wp_unslash( $_POST['last_name'] ?? '' ) );
	$email = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	if ( ! $first || ! $last || ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'signup', 'error', $redirect ) );
		exit;
	}

	$existing = get_posts(
		array(
			'post_type'      => 'uberrito_signup',
			'post_status'    => 'private',
			'posts_per_page' => 1,
			'meta_key'       => 'email',
			'meta_value'     => $email,
			'fields'         => 'ids',
		)
	);
	if ( ! $existing ) {
		$post_id = wp_insert_post(
			array(
				'post_type'   => 'uberrito_signup',
				'post_status' => 'private',
				'post_title'  => $first . ' ' . $last . ' (' . $email . ')',
			)
		);
		if ( $post_id && ! is_wp_error( $post_id ) ) {
			update_post_meta( $post_id, 'first_name', $first );
			update_post_meta( $post_id, 'last_name', $last );
			update_post_meta( $post_id, 'email', $email );
		}
	}

	wp_safe_redirect( add_query_arg( 'signup', 'success', $redirect ) );
	exit;
}
add_action( 'admin_post_nopriv_uberrito_newsletter_signup', 'uberrito_new_home_newsletter_signup' );
add_action( 'admin_post_uberrito_newsletter_signup', 'uberrito_new_home_newsletter_signup' );

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
		'uberrito-new-home-live-v222',
		$base_url . 'new-home-v222.css',
		array(),
		'2.2.2'
	);

	wp_enqueue_script(
		'uberrito-new-home-live-v222',
		$base_url . 'new-home-v222.js',
		array(),
		'2.2.2',
		true
	);

	wp_localize_script(
		'uberrito-new-home-live-v222',
		'UberritoNewHome',
		array(
			'assetsUrl'    => trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/07/',
			'orderUrl'     => uberrito_new_home_safe_url( 'order-online', 'Order Online' ),
			'rewardsUrl'   => uberrito_new_home_safe_url( 'rewards', 'NU Rewards' ),
			'locationsUrl' => uberrito_new_home_safe_url( 'locations', 'Locations' ),
			'gameEndpoint' => rest_url( 'uberrito/v1/game-score' ),
			'highScore'    => max( 120000, absint( get_option( 'uberrito_game_high_score', 120000 ) ) ),
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
		$base_url . 'assets/elementor-home-v153.css',
		array( 'uberrito-elementor-reference-v132' ),
		'1.5.3'
	);
	wp_add_inline_style(
		'uberrito-elementor-home-v153',
		'.ub-elementor-home-page .nv-menu-proof__item>:first-child .elementor-heading-title{color:#fff!important;-webkit-text-fill-color:#fff!important}@media(max-width:767px){.ub-elementor-home-page .nv-nav__order{position:relative!important}.ub-elementor-home-page .nv-nav__order:after{content:"ORDER NOW →";position:absolute;inset:0;z-index:3;display:grid;place-items:center;color:#06120b;font:900 9px/1 var(--nv-font-body);white-space:nowrap;pointer-events:none}}'
	);

	wp_enqueue_script(
		'uberrito-elementor-home-v154',
		$base_url . 'assets/elementor-home-v154.js',
		array(),
		'1.5.3',
		true
	);
	wp_localize_script(
		'uberrito-elementor-home-v154',
		'UberritoNewHome',
		array(
			'assetsUrl'    => trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/07/',
			'orderUrl'     => uberrito_new_home_safe_url( 'order-online', 'Order Online' ),
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

	$allowed = array( 'uberrito-new-home-live-v222', 'admin-bar', 'dashicons' );
	return in_array( $handle, $allowed, true ) ? $html : '';
}
add_filter( 'style_loader_tag', 'uberrito_new_home_filter_style_tag', 999, 2 );

function uberrito_new_home_filter_script_tag( $tag, $handle ) {
	if ( ! is_page( 'new-home' ) ) {
		return $tag;
	}

	return 'uberrito-new-home-live-v222' === $handle ? $tag : '';
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
 * Make the approved brand palette and type hierarchy available to standard
 * WordPress content, HTML blocks and Elementor-authored pages.
 */
function uberrito_brand_system_assets() {
	if ( is_page( 'new-home' ) ) {
		return;
	}

	wp_enqueue_style(
		'uberrito-brand-system',
		plugin_dir_url( __FILE__ ) . 'assets/uberrito-brand-system.css',
		array(),
		'2.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'uberrito_brand_system_assets', 30 );

function uberrito_sync_elementor_brand_kit() {
	if ( '2.2.0' === get_option( 'uberrito_brand_kit_version' ) ) {
		return;
	}

	$kit_id = absint( get_option( 'elementor_active_kit' ) );
	if ( ! $kit_id ) {
		return;
	}

	$settings = get_post_meta( $kit_id, '_elementor_page_settings', true );
	$settings = is_array( $settings ) ? $settings : array();
	$settings['system_colors'] = array(
		array( '_id' => 'primary', 'title' => 'Serrano Green', 'color' => '#006831' ),
		array( '_id' => 'secondary', 'title' => 'Tomatillo Green', 'color' => '#92bf38' ),
		array( '_id' => 'text', 'title' => 'Body Text', 'color' => '#1a1a1a' ),
		array( '_id' => 'accent', 'title' => 'Tomato Red', 'color' => '#e85025' ),
	);
	$settings['custom_colors'] = array(
		array( '_id' => 'cotija', 'title' => 'Cotija White', 'color' => '#ffffff' ),
		array( '_id' => 'crispy', 'title' => 'Crispy Gray', 'color' => '#e6e7e8' ),
		array( '_id' => 'avocado', 'title' => 'Avocado Green', 'color' => '#b9d457' ),
		array( '_id' => 'cilantro', 'title' => 'Cilantro Lime', 'color' => '#e0eed0' ),
		array( '_id' => 'jicama', 'title' => 'Jicama Yellow', 'color' => '#f8f8d4' ),
		array( '_id' => 'corn', 'title' => 'Corn Yellow', 'color' => '#f4c628' ),
		array( '_id' => 'habanero', 'title' => 'Habanero Orange', 'color' => '#f6932a' ),
	);
	$settings['body_typography_typography'] = 'custom';
	$settings['body_typography_font_family'] = 'Grota Sans Regular';
	$settings['body_typography_font_weight'] = '400';
	$settings['h1_typography_typography'] = 'custom';
	$settings['h1_typography_font_family'] = 'Grota Sans Alt Heavy';
	$settings['h1_typography_font_weight'] = '900';
	$settings['h2_typography_typography'] = 'custom';
	$settings['h2_typography_font_family'] = 'Grota Sans Heavy';
	$settings['h2_typography_font_weight'] = '900';
	$settings['h3_typography_typography'] = 'custom';
	$settings['h3_typography_font_family'] = 'Garage Gothic Regular';
	$settings['h3_typography_font_weight'] = '400';
	$settings['h4_typography_typography'] = 'custom';
	$settings['h4_typography_font_family'] = 'Grota Sans Heavy';
	$settings['h4_typography_font_weight'] = '900';
	$settings['h5_typography_typography'] = 'custom';
	$settings['h5_typography_font_family'] = 'Grota Sans Heavy';
	$settings['h5_typography_font_weight'] = '900';
	$settings['h6_typography_typography'] = 'custom';
	$settings['h6_typography_font_family'] = 'Garage Gothic Regular';
	$settings['h6_typography_font_weight'] = '400';

	update_post_meta( $kit_id, '_elementor_page_settings', $settings );
	update_option( 'uberrito_brand_kit_version', '2.2.0', false );
}
add_action( 'init', 'uberrito_sync_elementor_brand_kit', 30 );

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
	$excludes[] = 'new-home-v160.css';
	$excludes[] = 'new-home-v160.js';
	$excludes[] = 'new-home-v162.css';
	$excludes[] = 'new-home-v162.js';
	$excludes[] = 'new-home-v171.css';
	$excludes[] = 'new-home-v171.js';
	$excludes[] = 'new-home-v190.css';
	$excludes[] = 'new-home-v183.js';
	$excludes[] = 'elementor-home-v150.css';
	$excludes[] = 'elementor-home-v150.js';
	$excludes[] = 'elementor-home-v153.css';
	$excludes[] = 'elementor-home-v153.js';
	$excludes[] = 'elementor-home-v154.js';
	return array_unique( $excludes );
}
add_filter( 'litespeed_optimize_css_excludes', 'uberrito_new_home_litespeed_excludes' );
add_filter( 'litespeed_optimize_js_excludes', 'uberrito_new_home_litespeed_excludes' );
