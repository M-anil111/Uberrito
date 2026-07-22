<?php
/**
 * One-click migration of the Uberrito homepage into native Elementor widgets.
 *
 * The generated page intentionally contains no HTML widget and no shortcode.
 * Copy, images, links, and section order remain editable in Elementor.
 */

defined( 'ABSPATH' ) || exit;

const UBERRITO_ELEMENTOR_HOME_ID = 115;

function uberrito_el_id( $name ) {
	return substr( md5( 'uberrito-' . $name ), 0, 7 );
}

function uberrito_el_element( $name, $type, $settings = array(), $elements = array() ) {
	$element = array(
		'id'       => uberrito_el_id( $name ),
		'elType'   => $type,
		'settings' => $settings,
		'elements' => $elements,
	);
	if ( 'container' === $type ) {
		$element['isInner'] = false;
	}
	return $element;
}

function uberrito_el_container( $name, $class, $elements = array(), $settings = array() ) {
	return uberrito_el_element(
		$name,
		'container',
		array_merge( array( 'css_classes' => $class, 'content_width' => 'full' ), $settings ),
		$elements
	);
}

function uberrito_el_widget( $name, $widget, $settings, $class = '' ) {
	if ( $class ) {
		$settings['_css_classes'] = $class;
	}
	$element               = uberrito_el_element( $name, 'widget', $settings );
	$element['widgetType'] = $widget;
	return $element;
}

function uberrito_el_heading( $name, $title, $tag = 'h2', $class = '' ) {
	return uberrito_el_widget( $name, 'heading', array( 'title' => $title, 'header_size' => $tag ), $class );
}

function uberrito_el_text( $name, $text, $class = '' ) {
	return uberrito_el_widget( $name, 'text-editor', array( 'editor' => '<p>' . $text . '</p>' ), $class );
}

function uberrito_el_button( $name, $label, $url, $class = '' ) {
	return uberrito_el_widget(
		$name,
		'button',
		array( 'text' => $label, 'link' => array( 'url' => $url ), 'size' => 'md' ),
		$class
	);
}

function uberrito_el_image( $name, $url, $alt, $class = '' ) {
	return uberrito_el_widget(
		$name,
		'image',
		array(
			'image'      => array( 'url' => $url, 'id' => attachment_url_to_postid( $url ) ),
			'image_size' => 'full',
			'caption'    => '',
			'alt'        => $alt,
		),
		$class
	);
}

function uberrito_el_upload( $file ) {
	return trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/07/' . ltrim( $file, '/' );
}

function uberrito_el_plugin_asset( $file ) {
	return plugin_dir_url( dirname( __DIR__ ) . '/uberrito-new-home.php' ) . ltrim( $file, '/' );
}

function uberrito_el_card( $name, $title, $copy, $image, $url, $class = '' ) {
	return uberrito_el_container(
		$name,
		'ub-el-card ' . $class,
		array(
			uberrito_el_image( $name . '-image', $image, $title, 'ub-el-card__image' ),
			uberrito_el_heading( $name . '-title', $title, 'h3', 'ub-el-card__title' ),
			uberrito_el_text( $name . '-copy', $copy, 'ub-el-card__copy' ),
			uberrito_el_button( $name . '-button', 'Explore →', $url, 'ub-el-arrow-button' ),
		)
	);
}

function uberrito_build_elementor_home_data() {
	$order     = 'https://uberrito.toast.site/';
	$rewards   = home_url( '/rewards/' );
	$menu      = home_url( '/menu/' );
	$locations = home_url( '/locations/' );
	$catering  = home_url( '/catering/' );
	$upload    = 'uberrito_el_upload';

	$hero_slide_one = uberrito_el_container( 'hero-slide-one', 'ub-el-hero__slide is-active', array(
		uberrito_el_container( 'hero-one-copy', 'ub-el-hero__copy', array(
			uberrito_el_text( 'hero-one-kicker', 'FRESH MEX · MADE YOUR WAY', 'ub-el-kicker' ),
			uberrito_el_heading( 'hero-one-title', 'FRESH.<br>BOLD.<br><span>MADE DAILY.</span>', 'h1', 'ub-el-display' ),
			uberrito_el_text( 'hero-one-copy-text', 'Fresh ingredients, bold flavors and endless combinations. Made your way, every day.', 'ub-el-lede' ),
			uberrito_el_container( 'hero-one-actions', 'ub-el-actions', array(
				uberrito_el_button( 'hero-one-order', 'ORDER NOW →', $order, 'ub-el-button ub-el-button--lime' ),
				uberrito_el_button( 'hero-one-app', 'DOWNLOAD APP ↓', 'https://apps.apple.com/us/app/%C3%BCberrito-fresh-mex/id1569506904', 'ub-el-button ub-el-button--ghost' ),
			) ),
			uberrito_el_text( 'hero-one-locations', '● TWO LOCATIONS&nbsp;&nbsp; ATASCOCITA + SUGAR LAND', 'ub-el-location-line' ),
		) ),
		uberrito_el_image( 'hero-one-image', uberrito_el_plugin_asset( 'hero-fresh-burrito.webp' ), 'Fresh Uberrito burritos', 'ub-el-hero__image' ),
	) );

	$hero_slide_two = uberrito_el_container( 'hero-slide-two', 'ub-el-hero__slide ub-el-hero__slide--rewards', array(
		uberrito_el_container( 'hero-two-copy', 'ub-el-hero__copy', array(
			uberrito_el_text( 'hero-two-kicker', 'NÜ REWARDS · NEW MEMBER BONUS', 'ub-el-kicker' ),
			uberrito_el_heading( 'hero-two-title', 'EAT.<br>EARN.<br><span>EAT FREE.</span>', 'h2', 'ub-el-display' ),
			uberrito_el_text( 'hero-two-copy-text', 'Join today and get enough bonus points for a free side. Then earn one point for every $1 you spend.', 'ub-el-lede' ),
			uberrito_el_container( 'hero-two-actions', 'ub-el-actions', array(
				uberrito_el_button( 'hero-two-join', 'JOIN NÜ REWARDS →', $rewards, 'ub-el-button ub-el-button--lime' ),
				uberrito_el_button( 'hero-two-earn', 'START EARNING →', $order, 'ub-el-button ub-el-button--ghost' ),
			) ),
		) ),
		uberrito_el_image( 'hero-two-image', $upload( 'rewards-burritos.webp' ), 'Uberrito rewards meal', 'ub-el-hero__image' ),
	) );

	$menu_items = array(
		array( 'burritos', 'BURRITOS', 'Wrapped and ready.', 'burrito.webp' ),
		array( 'bowls', 'BOWLS', 'Fork-first flavor.', 'Bowl-1.webp' ),
		array( 'tacos', 'TACOS', 'Small but loud.', 'tacos.webp' ),
		array( 'nachos', 'NACHOS', 'Loaded on purpose.', 'nachos-thumb-1.webp' ),
		array( 'salads', 'SALADS', 'Green, never boring.', 'Salad-1.webp' ),
		array( 'chips', 'CHIPS + GUAC', 'The essential sidekick.', 'uberrito-chips-guacamole.png' ),
	);
	$menu_cards = array();
	foreach ( $menu_items as $item ) {
		$menu_cards[] = uberrito_el_card( 'menu-' . $item[0], $item[1], $item[2], $upload( $item[3] ), $order, 'ub-el-menu-card' );
	}

	$proofs = array(
		array( 'fresh', '✦', 'MADE FRESH DAILY', 'Never pre-cooked. Always fresh.' ),
		array( 'quality', '◉', 'QUALITY INGREDIENTS', 'Real ingredients. Real flavor.' ),
		array( 'way', '✹', 'MADE YOUR WAY', 'Customize every bite.' ),
	);
	$proof_elements = array();
	foreach ( $proofs as $proof ) {
		$proof_elements[] = uberrito_el_container( 'proof-' . $proof[0], 'ub-el-proof', array(
			uberrito_el_heading( 'proof-' . $proof[0] . '-icon', $proof[1], 'span', 'ub-el-proof__icon' ),
			uberrito_el_heading( 'proof-' . $proof[0] . '-title', $proof[2], 'h3' ),
			uberrito_el_text( 'proof-' . $proof[0] . '-copy', $proof[3] ),
		) );
	}

	$bottom_links = array(
		array( 'ORDER NOW', $order ), array( 'VIEW MENU', $menu ), array( 'FOLLOW US', 'https://www.instagram.com/uberrito/' ),
		array( 'REWARDS', $rewards ), array( 'CATERING', $catering ), array( 'LOCATIONS', $locations ),
		array( 'LEAVE A REVIEW', $locations ), array( 'DOWNLOAD APP', 'https://apps.apple.com/us/app/%C3%BCberrito-fresh-mex/id1569506904' ),
	);
	$bottom_elements = array();
	foreach ( $bottom_links as $index => $link ) {
		$bottom_elements[] = uberrito_el_button( 'next-' . $index, str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) . '  ' . $link[0] . ' ↗', $link[1], 'ub-el-next-link' );
	}

	return array(
		uberrito_el_container( 'page', 'ub-el-home', array(
			uberrito_el_container( 'hero', 'ub-el-hero', array(
				$hero_slide_one,
				$hero_slide_two,
				uberrito_el_container( 'hero-controls', 'ub-el-hero__controls', array(
					uberrito_el_button( 'hero-prev', '←', '#', 'ub-el-hero-prev' ),
					uberrito_el_text( 'hero-count', '01 / 02', 'ub-el-hero-count' ),
					uberrito_el_button( 'hero-next', '→', '#', 'ub-el-hero-next' ),
				) ),
			) ),
			uberrito_el_container( 'marquee', 'ub-el-marquee', array(
				uberrito_el_heading( 'marquee-copy', 'FRESH INGREDIENTS ✹ BOLD FLAVOR ✹ MADE YOUR WAY ✹ ZERO BORING BITES ✹', 'p' ),
			) ),
			uberrito_el_container( 'menu-section', 'ub-el-section ub-el-menu', array(
				uberrito_el_container( 'menu-head', 'ub-el-section-head', array(
					uberrito_el_container( 'menu-head-copy', 'ub-el-section-head__copy', array(
						uberrito_el_text( 'menu-kicker', 'PICK YOUR PLAYER', 'ub-el-kicker' ),
						uberrito_el_heading( 'menu-title', 'OUR <span>MENU</span>', 'h2', 'ub-el-section-title' ),
						uberrito_el_text( 'menu-intro', 'Fresh ingredients. Endless combinations. <em>Made your way.</em>' ),
					) ),
					uberrito_el_button( 'menu-full', 'VIEW FULL MENU →', $menu, 'ub-el-outline-button' ),
				) ),
				uberrito_el_container( 'menu-grid', 'ub-el-menu-grid', $menu_cards ),
				uberrito_el_container( 'proof-bar', 'ub-el-proof-bar', $proof_elements ),
			) ),
			uberrito_el_container( 'feels', 'ub-el-section ub-el-feels', array(
				uberrito_el_container( 'feels-copy', 'ub-el-feels__copy', array(
					uberrito_el_text( 'feels-kicker', 'THE GOOD STUFF', 'ub-el-kicker' ),
					uberrito_el_heading( 'feels-title', 'FOOD THAT<br><span>FEELS GOOD.</span>', 'h2', 'ub-el-section-title' ),
					uberrito_el_text( 'feels-copy-text', 'Bright, fresh, filling and completely yours. We prep daily so every bite hits different—in the best way.' ),
				) ),
				uberrito_el_image( 'burrito-pal', $upload( 'wrapped-burrito.png.webp' ), 'Playful standing Uberrito burrito', 'ub-el-burrito-pal' ),
			) ),
			uberrito_el_container( 'locations-section', 'ub-el-section ub-el-locations', array(
				uberrito_el_container( 'locations-head', 'ub-el-locations__head', array(
					uberrito_el_text( 'locations-kicker', 'TEXAS, TWO WAYS', 'ub-el-kicker' ),
					uberrito_el_heading( 'locations-title', 'FRESH FLAVOR<br><span>HAS LANDED.</span>', 'h2', 'ub-el-section-title' ),
				) ),
				uberrito_el_container( 'locations-grid', 'ub-el-location-grid', array(
					uberrito_el_card( 'atascocita', 'ATASCOCITA', '19350 W Lake Houston Pkwy<br>Humble, TX 77346', $upload( 'uberrito-atascocita-exterior.jpeg' ), $locations, 'ub-el-location-card' ),
					uberrito_el_card( 'sugar-land', 'SUGAR LAND', '15445 SW Fwy, Suite 500<br>Sugar Land, TX 77478', $upload( 'uberrito-restaurant-interior.jpeg' ), $locations, 'ub-el-location-card' ),
				) ),
			) ),
			uberrito_el_container( 'catering-section', 'ub-el-section ub-el-catering', array(
				uberrito_el_container( 'catering-copy', 'ub-el-catering__copy', array(
					uberrito_el_text( 'catering-kicker', 'FEED THE WHOLE GROUP CHAT', 'ub-el-kicker' ),
					uberrito_el_heading( 'catering-title', 'CATER WITH<br><span>UBERRITO.</span>', 'h2', 'ub-el-section-title' ),
					uberrito_el_text( 'catering-copy-text', 'Corporate events, parties, game days or just because. We’ve got you.' ),
					uberrito_el_button( 'catering-button', 'CATER NOW →', $catering, 'ub-el-button ub-el-button--green' ),
					uberrito_el_text( 'catering-bubble', 'Need lunch for the whole crew? I got you!', 'ub-el-speech' ),
				) ),
				uberrito_el_image( 'catering-image', uberrito_el_plugin_asset( 'catering-spread.webp' ), 'Uberrito catering spread', 'ub-el-catering__image' ),
			) ),
			uberrito_el_container( 'merch-section', 'ub-el-section ub-el-merch', array(
				uberrito_el_container( 'merch-copy', 'ub-el-merch__copy', array(
					uberrito_el_text( 'merch-kicker', 'OFFICIAL MERCH · LIMITED DROPS', 'ub-el-kicker' ),
					uberrito_el_heading( 'merch-title', 'WEAR THE<br><span>UBERRITO</span><br>LIFESTYLE.', 'h2', 'ub-el-section-title' ),
					uberrito_el_text( 'merch-copy-text', 'Premium apparel, drinkware and everyday essentials designed for true Uberrito fans.' ),
					uberrito_el_button( 'merch-button', 'SHOP MERCH →', '#next-move', 'ub-el-button ub-el-button--lime' ),
				) ),
				uberrito_el_container( 'merch-art', 'ub-el-merch__art', array(
					uberrito_el_image( 'merch-collection', $upload( 'merch-official.webp' ), 'Official Uberrito merchandise', 'ub-el-merch__collection' ),
					uberrito_el_image( 'merch-cup', uberrito_el_plugin_asset( 'uberrito-cup.png' ), 'Uberrito cup', 'ub-el-merch__cup' ),
				) ),
			) ),
			uberrito_el_container( 'rewards-ribbon', 'ub-el-rewards', array(
				uberrito_el_container( 'rewards-copy', 'ub-el-rewards__copy', array(
					uberrito_el_text( 'rewards-kicker', 'NÜ REWARDS · NEW MEMBER BONUS', 'ub-el-kicker' ),
					uberrito_el_heading( 'rewards-title', 'EAT. EARN. <span>EAT FREE.</span>', 'h2', 'ub-el-section-title' ),
					uberrito_el_text( 'rewards-copy-text', 'Join today and get enough bonus points for a FREE side.', 'ub-el-rewards__offer' ),
				) ),
				uberrito_el_button( 'rewards-join', 'JOIN FREE', $rewards, 'ub-el-face-button' ),
			) ),
			uberrito_el_container( 'next-move', 'ub-el-next', array(
				uberrito_el_text( 'next-kicker', 'PICK YOUR NEXT MOVE', 'ub-el-kicker' ),
				uberrito_el_container( 'next-links', 'ub-el-next__links', $bottom_elements ),
			) ),
			uberrito_el_container( 'footer', 'ub-el-footer', array(
				uberrito_el_text( 'footer-promise', 'FRESH INGREDIENTS · BOLD FLAVOR · MADE DAILY', 'ub-el-footer__promise' ),
				uberrito_el_image( 'footer-logo', $upload( 'uberrito-white-logo.png' ), 'Uberrito Fresh Mex', 'ub-el-footer__logo' ),
				uberrito_el_text( 'footer-locations', 'ATASCOCITA · SUGAR LAND', 'ub-el-footer__locations' ),
			) ),
		) ),
	);
}

function uberrito_elementor_migration_page() {
	add_management_page(
		'Uberrito Elementor Migration',
		'Uberrito Elementor',
		'manage_options',
		'uberrito-elementor-migration',
		'uberrito_render_elementor_migration_page'
	);
}
add_action( 'admin_menu', 'uberrito_elementor_migration_page' );

function uberrito_render_elementor_migration_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$backup = get_option( 'uberrito_elementor_last_backup', '' );
	?>
	<div class="wrap">
		<h1>Uberrito Elementor Homepage</h1>
		<?php if ( isset( $_GET['migrated'] ) ) : ?><div class="notice notice-success"><p>The native Elementor homepage was created. All previous Elementor data was backed up.</p></div><?php endif; ?>
		<?php if ( isset( $_GET['restored'] ) ) : ?><div class="notice notice-success"><p>The previous Elementor homepage data was restored.</p></div><?php endif; ?>
		<p>This replaces the content of page ID 115 with native Elementor containers and widgets. It does not change the isolated <code>/new-home/</code> reference page.</p>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="uberrito_elementor_migrate">
			<?php wp_nonce_field( 'uberrito_elementor_migrate' ); ?>
			<?php submit_button( 'Build native Elementor homepage', 'primary' ); ?>
		</form>
		<?php if ( $backup ) : ?>
			<hr><p>Latest rollback snapshot: <code><?php echo esc_html( $backup ); ?></code></p>
			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="uberrito_elementor_restore">
				<?php wp_nonce_field( 'uberrito_elementor_restore' ); ?>
				<?php submit_button( 'Restore previous Elementor homepage', 'secondary' ); ?>
			</form>
		<?php endif; ?>
	</div>
	<?php
}

function uberrito_run_elementor_migration() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Insufficient permissions.' );
	}
	check_admin_referer( 'uberrito_elementor_migrate' );

	$post_id = UBERRITO_ELEMENTOR_HOME_ID;
	$old     = get_post_meta( $post_id, '_elementor_data', true );
	$key     = '_uberrito_elementor_backup_' . gmdate( 'Ymd_His' );
	$original = get_option( 'uberrito_elementor_original_backup', '' );
	if ( ! $original ) {
		$original = get_option( 'uberrito_elementor_last_backup', $key );
		update_option( 'uberrito_elementor_original_backup', $original, false );
	}
	update_post_meta( $post_id, $key, $old );
	update_option( 'uberrito_elementor_last_backup', $key, false );

	$builder = function_exists( 'uberrito_build_elementor_home_v142_data' ) ? 'uberrito_build_elementor_home_v142_data' : 'uberrito_build_elementor_home_data';
	update_post_meta( $post_id, '_elementor_data', wp_slash( wp_json_encode( call_user_func( $builder ) ) ) );
	update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
	update_post_meta( $post_id, '_elementor_template_type', 'wp-page' );
	update_post_meta( $post_id, '_wp_page_template', 'elementor_full_width' );
	update_post_meta( $post_id, '_elementor_version', defined( 'ELEMENTOR_VERSION' ) ? ELEMENTOR_VERSION : '3.0.0' );

	uberrito_clear_elementor_home_cache( $post_id );
	wp_safe_redirect( admin_url( 'tools.php?page=uberrito-elementor-migration&migrated=1' ) );
	exit;
}
add_action( 'admin_post_uberrito_elementor_migrate', 'uberrito_run_elementor_migration' );

function uberrito_restore_elementor_home() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Insufficient permissions.' );
	}
	check_admin_referer( 'uberrito_elementor_restore' );
	$key = get_option( 'uberrito_elementor_original_backup', get_option( 'uberrito_elementor_last_backup', '' ) );
	if ( ! $key || ! metadata_exists( 'post', UBERRITO_ELEMENTOR_HOME_ID, $key ) ) {
		wp_die( 'No Elementor backup is available.' );
	}
	update_post_meta( UBERRITO_ELEMENTOR_HOME_ID, '_elementor_data', get_post_meta( UBERRITO_ELEMENTOR_HOME_ID, $key, true ) );
	uberrito_clear_elementor_home_cache( UBERRITO_ELEMENTOR_HOME_ID );
	wp_safe_redirect( admin_url( 'tools.php?page=uberrito-elementor-migration&restored=1' ) );
	exit;
}
add_action( 'admin_post_uberrito_elementor_restore', 'uberrito_restore_elementor_home' );

function uberrito_clear_elementor_home_cache( $post_id ) {
	delete_post_meta( $post_id, '_elementor_css' );
	if ( did_action( 'elementor/loaded' ) && isset( \Elementor\Plugin::$instance->files_manager ) ) {
		\Elementor\Plugin::$instance->files_manager->clear_cache();
	}
	if ( function_exists( 'litespeed_purge_post' ) ) {
		litespeed_purge_post( $post_id );
	}
}
