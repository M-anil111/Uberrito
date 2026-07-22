<?php
/**
 * Native Elementor representation of the approved /new-home/ experience.
 * Every editable item remains an Elementor widget; CSS classes and data hooks
 * intentionally mirror page-new-home.php so the approved motion layer is reused.
 */

defined( 'ABSPATH' ) || exit;

function uberrito_v142_widget( $name, $type, $settings, $class = '', $attributes = '' ) {
	if ( $class ) {
		$settings['_css_classes'] = $class;
	}
	if ( $attributes ) {
		$settings['_attributes'] = $attributes;
		$settings['custom_attributes'] = $attributes;
	}
	return uberrito_el_widget( $name, $type, $settings );
}

function uberrito_v142_text( $name, $html, $class = '', $attributes = '' ) {
	return uberrito_v142_widget( $name, 'text-editor', array( 'editor' => $html ), $class, $attributes );
}

function uberrito_v142_heading( $name, $html, $tag = 'h2', $class = '', $attributes = '' ) {
	return uberrito_v142_widget( $name, 'heading', array( 'title' => $html, 'header_size' => $tag ), $class, $attributes );
}

function uberrito_v142_button( $name, $label, $url, $class = '', $attributes = '' ) {
	return uberrito_v142_widget( $name, 'button', array( 'text' => $label, 'link' => array( 'url' => $url ), 'size' => 'md' ), $class, $attributes );
}

function uberrito_v142_image( $name, $url, $alt, $class = '', $attributes = '' ) {
	return uberrito_v142_widget(
		$name,
		'image',
		array( 'image' => array( 'url' => $url, 'id' => attachment_url_to_postid( $url ) ), 'image_size' => 'full', 'alt' => $alt ),
		$class,
		$attributes
	);
}

function uberrito_v142_container( $name, $class, $children = array(), $tag = 'div', $attributes = '' ) {
	$settings = array( 'html_tag' => $tag );
	if ( $attributes ) {
		$settings['custom_attributes'] = $attributes;
	}
	return uberrito_el_container( 'v142-' . $name, $class, $children, $settings );
}

function uberrito_build_elementor_home_v142_data() {
	$order     = 'https://uberrito.toast.site/';
	$menu      = home_url( '/menu/' );
	$rewards   = home_url( '/rewards/' );
	$locations = home_url( '/locations/' );
	$catering  = home_url( '/catering/' );
	$app       = 'https://apps.apple.com/us/app/%C3%BCberrito-fresh-mex/id1569506904';
	$u         = 'uberrito_el_upload';
	$p         = 'uberrito_el_plugin_asset';

	$loader = uberrito_v142_container( 'loader', 'nv-loader', array(
		uberrito_v142_container( 'loader-orbit', 'nv-loader__orbit', array(
			uberrito_v142_heading( 'loader-bean', '●', 'span', 'nv-food-icon nv-food-icon--bean' ),
			uberrito_v142_heading( 'loader-chip', '▲', 'span', 'nv-food-icon nv-food-icon--chip' ),
			uberrito_v142_heading( 'loader-cheese', '▰', 'span', 'nv-food-icon nv-food-icon--cheese' ),
			uberrito_v142_heading( 'loader-lime', '◉', 'span', 'nv-food-icon nv-food-icon--lime' ),
		) ),
		uberrito_v142_image( 'loader-burrito', $u( 'wrapped-burrito.png.webp' ), '', 'nv-loader__burrito' ),
		uberrito_v142_heading( 'loader-copy', 'ROLLING SOMETHING FRESH...', 'p', 'nv-loader__copy' ),
		uberrito_v142_container( 'loader-bar', 'nv-loader__bar', array( uberrito_v142_container( 'loader-fill', 'nv-loader__bar-fill' ) ) ),
	), 'div', 'role|dialog|aria-modal|true|aria-label|Preparing your Uberrito experience' );

	$offers = uberrito_v142_container( 'offers', 'nv-offers', array(
		uberrito_v142_container( 'offers-shell', 'nv-shell nv-offers__inner', array(
			uberrito_v142_image( 'offers-image', $u( 'rewards-chips.webp' ), 'Chips and guacamole reward', 'nv-offers__image' ),
			uberrito_v142_text( 'offers-copy', '<small>NEW MEMBER OFFER</small><p>New here? Get <strong>FREE Chips &amp; Guacamole</strong></p>', 'nv-offers__copy' ),
			uberrito_v142_button( 'offers-link', 'JOIN NOW →', $rewards, 'nv-offers__link' ),
			uberrito_v142_text( 'offers-count', '<b>1 / 2</b>', 'nv-offers__count' ),
		) ),
	) );

	$nav_links = array();
	foreach ( array( 'MENU' => '#menu', 'CATERING' => '#catering', 'REWARDS' => '#rewards', 'LOCATIONS' => '#locations', 'MERCH' => '#merch' ) as $label => $url ) {
		$nav_links[] = uberrito_v142_button( 'nav-' . strtolower( $label ), $label, $url, 'nv-nav__link' );
	}
	$nav = uberrito_v142_container( 'nav', 'nv-nav', array(
		uberrito_v142_image( 'nav-logo', $u( 'uberrito-white-logo.png' ), 'Uberrito Fresh Mex', 'nv-logo' ),
		uberrito_v142_container( 'nav-links', 'nv-nav__links', $nav_links, 'nav' ),
		uberrito_v142_button( 'nav-order', 'ORDER NOW →', $order, 'nv-pill nv-pill--lime nv-magnetic nv-nav__order' ),
		uberrito_v142_button( 'menu-toggle', '☰', '#', 'nv-menu-toggle', 'aria-label|Open menu' ),
	) );
	$head = uberrito_v142_container( 'head', 'nv-site-head', array( $offers, $nav ), 'header' );

	$hero_one = uberrito_v142_container( 'hero-one', 'nv-hero__slide is-active', array(
		uberrito_v142_image( 'hero-one-image', $p( 'hero-fresh-burrito.webp' ), 'Fresh Uberrito burritos', 'nv-hero__backdrop' ),
		uberrito_v142_container( 'hero-one-shade', 'nv-hero__shade' ),
		uberrito_v142_container( 'hero-one-layout', 'nv-shell nv-hero__layout', array(
			uberrito_v142_container( 'hero-one-copy', 'nv-hero__copy', array(
				uberrito_v142_text( 'hero-one-eyebrow', 'FRESH MEX · MADE YOUR WAY', 'nv-eyebrow' ),
				uberrito_v142_heading( 'hero-one-title', '<span>FRESH.</span><span>BOLD.</span><span class="nv-accent">MADE DAILY.</span>', 'h1' ),
				uberrito_v142_text( 'hero-one-lede', '<p>Fresh ingredients, bold flavors and endless combinations. Made your way, every day.</p>', 'nv-hero__lede' ),
				uberrito_v142_container( 'hero-one-actions', 'nv-hero__actions', array(
					uberrito_v142_button( 'hero-one-order', 'ORDER NOW →', $order, 'nv-pill nv-pill--lime nv-magnetic' ),
					uberrito_v142_button( 'hero-one-app', 'DOWNLOAD APP ↓', $app, 'nv-pill nv-pill--ghost nv-magnetic' ),
				) ),
				uberrito_v142_text( 'hero-one-location', '● TWO LOCATIONS &nbsp; ATASCOCITA + SUGAR LAND', 'nv-hero__location' ),
			) ),
		) ),
	), 'article', 'data-hero-slide|' );
	$hero_two = uberrito_v142_container( 'hero-two', 'nv-hero__slide nv-hero__slide--rewards', array(
		uberrito_v142_image( 'hero-two-image', $u( 'rewards-burritos.webp' ), 'Uberrito rewards meal', 'nv-hero__backdrop' ),
		uberrito_v142_container( 'hero-two-shade', 'nv-hero__shade' ),
		uberrito_v142_container( 'hero-two-layout', 'nv-shell nv-hero__layout', array(
			uberrito_v142_container( 'hero-two-copy', 'nv-hero__copy', array(
				uberrito_v142_text( 'hero-two-eyebrow', 'NÜ REWARDS · NEW MEMBER BONUS', 'nv-eyebrow' ),
				uberrito_v142_heading( 'hero-two-title', '<span>EAT.</span><span>EARN.</span><span class="nv-accent">EAT FREE.</span>', 'h2' ),
				uberrito_v142_text( 'hero-two-lede', '<p>Earn one point for every $1 you spend. Redeem your points for a free side and more.</p>', 'nv-hero__lede' ),
				uberrito_v142_container( 'hero-two-actions', 'nv-hero__actions', array(
					uberrito_v142_button( 'hero-two-join', 'JOIN NÜ REWARDS →', $rewards, 'nv-pill nv-pill--lime nv-magnetic' ),
					uberrito_v142_button( 'hero-two-order', 'START EARNING →', $order, 'nv-pill nv-pill--ghost nv-magnetic' ),
				) ),
			) ),
		) ),
	), 'article', 'data-hero-slide|' );
	$hero = uberrito_v142_container( 'hero', 'nv-hero', array(
		$hero_one, $hero_two,
		uberrito_v142_container( 'hero-controls', 'nv-hero__controls', array(
			uberrito_v142_button( 'hero-prev', '←', '#', 'nv-hero-prev', 'data-hero-prev|' ),
			uberrito_v142_container( 'hero-dots', 'nv-hero__dots', array(
				uberrito_v142_button( 'hero-dot-one', '', '#', 'is-active', 'data-hero-dot|0' ),
				uberrito_v142_button( 'hero-dot-two', '', '#', '', 'data-hero-dot|1' ),
			) ),
			uberrito_v142_button( 'hero-next', '→', '#', 'nv-hero-next', 'data-hero-next|' ),
		) ),
	), 'section' );

	$menu_cards = array();
	foreach ( array(
		array( 'BURRITOS', 'Wrapped and ready.', 'burrito.webp' ), array( 'BOWLS', 'Fork-first flavor.', 'Bowl-1.webp' ),
		array( 'TACOS', 'Small but loud.', 'tacos.webp' ), array( 'NACHOS', 'Loaded on purpose.', 'nachos-thumb-1.webp' ),
		array( 'SALADS', 'Green, never boring.', 'Salad-1.webp' ), array( 'CHIPS + GUAC', 'The essential sidekick.', 'uberrito-chips-guacamole.png' ),
	) as $i => $item ) {
		$menu_cards[] = uberrito_v142_container( 'menu-card-' . $i, 'nv-menu-item', array(
			uberrito_v142_image( 'menu-image-' . $i, $u( $item[2] ), $item[0], 'nv-menu-item__image' ),
			uberrito_v142_container( 'menu-copy-' . $i, 'nv-menu-item__copy', array(
				uberrito_v142_heading( 'menu-title-' . $i, $item[0], 'h3' ),
				uberrito_v142_text( 'menu-desc-' . $i, '<p>' . $item[1] . '</p>' ),
			) ),
			uberrito_v142_button( 'menu-arrow-' . $i, '→', $order, 'nv-menu-item__arrow' ),
		), 'article', 'data-nv-reveal|' );
	}
	$proof = array();
	foreach ( array( array( '◉', 'MADE FRESH DAILY', 'Never pre-cooked. Always fresh.' ), array( '✦', 'QUALITY INGREDIENTS', 'Real ingredients. Real flavor.' ), array( '⌁', 'MADE YOUR WAY', 'Customize every bite.' ) ) as $i => $item ) {
		$proof[] = uberrito_v142_container( 'proof-' . $i, 'nv-menu-proof__item', array(
			uberrito_v142_heading( 'proof-icon-' . $i, $item[0], 'span' ), uberrito_v142_heading( 'proof-title-' . $i, $item[1], 'h3' ), uberrito_v142_text( 'proof-copy-' . $i, '<p>' . $item[2] . '</p>' ),
		) );
	}
	$menu_section = uberrito_v142_container( 'menu-section', 'nv-menu-section', array(
		uberrito_v142_container( 'menu-shell', 'nv-shell', array(
			uberrito_v142_container( 'menu-head', 'nv-section-head', array(
				uberrito_v142_container( 'menu-heading', 'nv-section-head__copy', array( uberrito_v142_text( 'menu-eyebrow', 'PICK YOUR PLAYER', 'nv-eyebrow' ), uberrito_v142_heading( 'menu-title', 'OUR <span>MENU</span>', 'h2' ), uberrito_v142_text( 'menu-intro', '<p>Fresh ingredients. Endless combinations. <em>Made your way.</em></p>' ) ) ),
				uberrito_v142_button( 'menu-full', 'VIEW FULL MENU →', $menu, 'nv-outline-link' ),
			) ),
			uberrito_v142_container( 'menu-grid', 'nv-menu-grid', $menu_cards ),
			uberrito_v142_container( 'menu-proof', 'nv-menu-proof', $proof ),
		) ),
	), 'section', 'id|menu' );

	$feels = uberrito_v142_container( 'feels', 'nv-feels', array(
		uberrito_v142_container( 'feels-wave', 'nv-feels__wave' ),
		uberrito_v142_container( 'feels-stage', 'nv-shell nv-feels__stage', array(
			uberrito_v142_container( 'feels-copy', 'nv-feels__copy', array( uberrito_v142_text( 'feels-eye', 'THE GOOD STUFF', 'nv-eyebrow' ), uberrito_v142_heading( 'feels-title', 'FOOD THAT<br><span>FEELS GOOD.</span>', 'h2' ), uberrito_v142_text( 'feels-text', '<p>Bright, fresh, filling and completely yours. We prep daily so every bite hits different—in the best way.</p>' ) ), 'div', 'data-nv-reveal|' ),
			uberrito_v142_container( 'burrito-pal', 'nv-burrito-pal nv-parallax', array( uberrito_v142_image( 'burrito-pal-image', $u( 'wrapped-burrito.png.webp' ), 'Playful standing Uberrito burrito' ), uberrito_v142_container( 'burrito-eyes', 'nv-burrito-pal__eyes', array( uberrito_v142_heading( 'burrito-eye-one', '', 'i' ), uberrito_v142_heading( 'burrito-eye-two', '', 'i' ) ) ) ), 'div', 'data-depth|18' ),
		) ),
	), 'section' );

	$location_cards = array();
	foreach ( array(
		array( '01', 'ATASCOCITA', '19350 W Lake Houston Pkwy<br>Humble, TX 77346', 'uberrito-atascocita-exterior.jpeg' ),
		array( '02', 'SUGAR LAND', '15445 SW Fwy, Suite 500<br>Sugar Land, TX 77478', 'uberrito-restaurant-interior.jpeg' ),
	) as $i => $item ) {
		$location_cards[] = uberrito_v142_container( 'location-' . $i, 'nv-location-card nv-location-card--' . ( 0 === $i ? 'start' : 'end' ), array(
			uberrito_v142_heading( 'location-number-' . $i, $item[0], 'span', 'nv-location-card__number' ),
			uberrito_v142_image( 'location-image-' . $i, $u( $item[3] ), $item[1] . ' Uberrito' ),
			uberrito_v142_heading( 'location-name-' . $i, $item[1], 'h3' ),
			uberrito_v142_text( 'location-address-' . $i, '<p>' . $item[2] . '</p>' ),
			uberrito_v142_button( 'location-link-' . $i, 'GET DIRECTIONS →', $locations, 'nv-location-card__link' ),
		), 'article' );
	}
	$flight = uberrito_v142_container( 'flight', 'nv-flight', array(
		uberrito_v142_container( 'flight-sticky', 'nv-flight__sticky', array(
			uberrito_v142_container( 'flight-heading', 'nv-shell nv-flight__heading', array( uberrito_v142_text( 'flight-eye', 'TEXAS, TWO WAYS', 'nv-eyebrow' ), uberrito_v142_heading( 'flight-title', 'FRESH FLAVOR<br><span>HAS LANDED.</span>', 'h2' ) ), 'div', 'data-nv-reveal|' ),
			uberrito_v142_container( 'flight-route', 'nv-flight__path' ), uberrito_v142_heading( 'flight-plane', '✈', 'div', 'nv-plane' ),
			uberrito_v142_container( 'flight-cards', 'nv-shell nv-flight__cards', $location_cards ),
		) ),
	), 'section', 'id|locations' );

	$clippy = function( $prefix, $bubble, $extra = '' ) use ( $u ) {
		return uberrito_v142_container( $prefix, 'nv-clippy ' . $extra, array(
			uberrito_v142_text( $prefix . '-bubble', '<span>' . $bubble . '</span>', 'nv-clippy__bubble' ),
			uberrito_v142_image( $prefix . '-image', $u( 'wrapped-burrito.png.webp' ), '' ),
			uberrito_v142_container( $prefix . '-eyes', 'nv-clippy__eyes', array( uberrito_v142_heading( $prefix . '-eye1', '', 'i' ), uberrito_v142_heading( $prefix . '-eye2', '', 'i' ) ) ),
		) );
	};
	$catering_section = uberrito_v142_container( 'catering', 'nv-catering', array(
		uberrito_v142_container( 'catering-copy', 'nv-catering__copy', array( uberrito_v142_text( 'catering-eye', 'FEED THE WHOLE GROUP CHAT', 'nv-eyebrow' ), uberrito_v142_heading( 'catering-title', 'CATER WITH<br><span>UBERRITO.</span>', 'h2' ), uberrito_v142_text( 'catering-text', '<p>Corporate events, parties, game days or just because. We’ve got you.</p>' ), uberrito_v142_button( 'catering-cta', 'CATER NOW →', $catering, 'nv-pill nv-pill--green nv-magnetic' ), $clippy( 'catering-clippy', 'Need lunch for the whole crew? I got you!', 'nv-clippy--catering' ) ), 'div', 'data-nv-reveal|' ),
		uberrito_v142_container( 'catering-visual', 'nv-catering__visual', array( uberrito_v142_image( 'catering-image', $p( 'catering-spread.webp' ), 'Uberrito catering spread' ), uberrito_v142_heading( 'catering-tag-one', 'Office lunch?', 'span' ), uberrito_v142_heading( 'catering-tag-two', 'Game day?', 'span' ), uberrito_v142_heading( 'catering-tag-three', 'We got you.', 'span' ) ), 'div', 'data-nv-reveal|' ),
	), 'section', 'id|catering' );

	$merch = uberrito_v142_container( 'merch', 'nv-merch', array(
		uberrito_v142_container( 'merch-layout', 'nv-shell nv-merch__layout', array(
			uberrito_v142_container( 'merch-copy', 'nv-merch__copy', array( uberrito_v142_text( 'merch-eye', 'OFFICIAL MERCH · LIMITED DROPS', 'nv-eyebrow' ), uberrito_v142_heading( 'merch-title', 'WEAR THE<br><span>UBERRITO</span><br>LIFESTYLE.', 'h2' ), uberrito_v142_text( 'merch-text', '<p>Premium apparel, drinkware and everyday essentials designed for true Uberrito fans.</p>' ), uberrito_v142_button( 'merch-cta', 'SHOP MERCH →', '#bottom-nav', 'nv-pill nv-pill--green nv-magnetic' ) ), 'div', 'data-nv-reveal|' ),
			uberrito_v142_container( 'merch-art', 'nv-merch__art nv-parallax', array( uberrito_v142_image( 'merch-collection', $u( 'merch-official.webp' ), 'Official Uberrito merchandise', 'nv-merch__collection' ), uberrito_v142_image( 'merch-cup', $p( 'uberrito-cup.png' ), 'Uberrito cup', 'nv-merch__cup' ), uberrito_v142_heading( 'merch-drop', 'DROP<br><b>001</b>', 'div', 'nv-merch__drop' ), $clippy( 'merch-clippy', 'Fresh fit. Zero boring merch.', 'nv-clippy--merch' ) ), 'div', 'data-depth|14|data-nv-reveal|' ),
		) ),
	), 'section', 'id|merch' );

	$rewards_section = uberrito_v142_container( 'rewards', 'nv-reward-ribbon', array(
		uberrito_v142_container( 'rewards-shell', 'nv-shell', array(
			uberrito_v142_container( 'rewards-copy', 'nv-reward-ribbon__copy', array( uberrito_v142_text( 'rewards-eye', '<p>NÜ REWARDS · NEW MEMBER BONUS</p>' ), uberrito_v142_heading( 'rewards-heading', 'EAT. EARN. <span>EAT FREE.</span>', 'h2' ), uberrito_v142_text( 'rewards-offer', '<strong>Join today and get enough bonus points for a FREE side.</strong>' ) ) ),
			uberrito_v142_button( 'rewards-face', '◉ ◉<br>JOIN FREE', $rewards, 'nv-face-button nv-face-button--small nv-magnetic' ),
		) ),
	), 'section', 'id|rewards' );

	$bottom = array();
	$bottom_data = array(
		array( 'ORDER NOW', $order, 'burrito.webp' ), array( 'VIEW MENU', $menu, 'Bowl-1.webp' ), array( 'FOLLOW US', 'https://www.instagram.com/uberrito/', 'tacos.webp' ), array( 'REWARDS', $rewards, 'rewards-burritos.webp' ),
		array( 'CATERING', $catering, 'uberrito-loaded-nachos-wide.png' ), array( 'LOCATIONS', $locations, 'uberrito-atascocita-exterior.jpeg' ), array( 'LEAVE A REVIEW', $locations, '' ), array( 'DOWNLOAD APP', $app, '' ),
	);
	foreach ( $bottom_data as $i => $item ) {
		$attrs = $item[2] ? 'data-preview|' . $item[2] : '';
		$bottom[] = uberrito_v142_button( 'bottom-' . $i, '<span>' . str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) . '</span>' . $item[0] . '<b>↗</b>', $item[1], 'nv-bottom-link', $attrs );
	}
	$bottom_nav = uberrito_v142_container( 'bottom-nav', 'nv-bottom-nav', array(
		uberrito_v142_container( 'bottom-preview', 'nv-bottom-preview', array( uberrito_v142_image( 'bottom-preview-image', $u( 'burrito.webp' ), '' ) ) ),
		uberrito_v142_container( 'bottom-shell', 'nv-shell', array( uberrito_v142_text( 'bottom-eye', 'PICK YOUR NEXT MOVE', 'nv-eyebrow' ), uberrito_v142_container( 'bottom-links', 'nv-bottom-links', $bottom, 'nav' ) ) ),
	), 'section', 'id|bottom-nav' );

	$ninja = array();
	foreach ( array( 'wrapped-burrito.png.webp', 'uberrito-chips-guacamole.png', 'Fajita-Steak.webp', 'lime-slices.png.webp', 'nachos.webp' ) as $i => $file ) {
		$ninja[] = uberrito_v142_image( 'ninja-' . $i, $u( $file ), '', 'nv-ninja-item', 'data-ninja-item|' );
	}
	$footer = uberrito_v142_container( 'footer', 'nv-footer', array(
		uberrito_v142_container( 'ninja-stage', 'nv-ninja-stage', $ninja ),
		uberrito_v142_container( 'footer-top', 'nv-shell nv-footer__top', array( uberrito_v142_text( 'footer-promise', '<p>Fresh ingredients · bold flavor · made daily</p>' ), uberrito_v142_text( 'footer-locations', '<p>Atascocita · Sugar Land</p>' ) ) ),
		uberrito_v142_image( 'footer-word', $u( 'uberrito-white-logo.png' ), 'Uberrito Fresh Mex', 'nv-footer__word' ),
		uberrito_v142_container( 'footer-base', 'nv-shell nv-footer__base', array( uberrito_v142_text( 'footer-copy', '<p>© ' . gmdate( 'Y' ) . ' Uberrito</p>' ), uberrito_v142_button( 'footer-contact', 'Contact', home_url( '/contact/' ) ), uberrito_v142_button( 'footer-order', 'Order now ↗', $order ) ) ),
	), 'footer' );

	$home = uberrito_v142_container( 'home', 'nv-home', array(
		$hero,
		uberrito_v142_container( 'marquee', 'nv-marquee', array( uberrito_v142_heading( 'marquee-text', 'FRESH INGREDIENTS ✹ BOLD FLAVOR ✹ MADE YOUR WAY ✹ ZERO BORING BITES ✹ FRESH INGREDIENTS ✹ BOLD FLAVOR ✹', 'p' ) ) ),
		$menu_section, $feels, $flight, $catering_section, $merch, $rewards_section, $bottom_nav, $footer,
	), 'main' );

	return array( $loader, $head, $home );
}
