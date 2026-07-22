<?php
/**
 * Experimental Uberrito homepage at /new-home/.
 *
 * @package HelloElementorChild
 */

defined( 'ABSPATH' ) || exit;

$uploads       = trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/07/';
$asset         = static function ( $file ) use ( $uploads ) {
	return esc_url( $uploads . ltrim( $file, '/' ) );
};
$order_url     = 'https://uberrito.toast.site/';
$rewards_url   = home_url( '/rewards/' );
$locations_url = home_url( '/locations/' );
$catering_url  = home_url( '/catering/' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="nv-loader" role="dialog" aria-modal="true" aria-label="Preparing your Uberrito experience">
	<div class="nv-loader__orbit" aria-hidden="true">
		<span class="nv-food-icon nv-food-icon--bean">●</span>
		<span class="nv-food-icon nv-food-icon--chip">▲</span>
		<span class="nv-food-icon nv-food-icon--cheese">▰</span>
		<span class="nv-food-icon nv-food-icon--lime">◉</span>
	</div>
	<div class="nv-loader__burrito" aria-hidden="true">
		<img src="<?php echo $asset( 'wrapped-burrito.png.webp' ); ?>" alt="" width="900" height="452">
	</div>
	<p>Rolling something fresh...</p>
	<div class="nv-loader__bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><span></span></div>
</div>

<header class="nv-site-head">
	<div class="nv-offers" aria-label="Current offers">
		<div class="nv-offers__inner">
			<img class="nv-offers__image" src="<?php echo $asset( 'rewards-chips.webp' ); ?>" alt="" width="600" height="300">
			<div class="nv-offers__copy" aria-live="polite"><small>NEW MEMBER OFFER</small><p>New here? Get <strong>FREE</strong> small chips &amp; queso.</p></div>
			<a class="nv-offers__link" href="<?php echo esc_url( $rewards_url ); ?>">Join now <span aria-hidden="true">→</span></a>
			<div class="nv-offers__controls">
				<button type="button" data-offer-prev aria-label="Previous offer">←</button>
				<span><b data-offer-current>1</b> / 4</span>
				<button type="button" data-offer-next aria-label="Next offer">→</button>
				<button type="button" data-offer-pause aria-label="Pause offer rotation">Ⅱ</button>
			</div>
		</div>
	</div>

	<nav class="nv-nav" aria-label="Main navigation">
		<a class="nv-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $asset( 'uberrito-white-logo.png' ); ?>" alt="Uberrito Fresh Mex" width="854" height="155"></a>
		<div class="nv-nav__links">
			<a href="#menu">Menu</a><a href="#catering">Catering</a><a href="#rewards">Rewards</a><a href="#locations">Locations</a><a href="#merch">Merch</a>
		</div>
		<a class="nv-pill nv-pill--lime" href="<?php echo esc_url( $order_url ); ?>">Order now <span>→</span></a>
		<button class="nv-menu-toggle" type="button" aria-expanded="false" aria-controls="nv-mobile-menu" aria-label="Open menu"><i></i><i></i></button>
	</nav>
	<div id="nv-mobile-menu" class="nv-mobile-menu" hidden>
		<a href="#menu">Menu</a><a href="#catering">Catering</a><a href="#rewards">Rewards</a><a href="#locations">Locations</a><a href="#merch">Merch</a><a href="<?php echo esc_url( $order_url ); ?>">Order now</a>
	</div>
</header>

<main id="content" class="nv-home">
	<section class="nv-hero" aria-labelledby="nv-hero-title">
		<div class="nv-hero__backdrop" aria-hidden="true"><img src="<?php echo $asset( 'banner-home.webp' ); ?>" alt="" width="1920" height="950" fetchpriority="high"></div>
		<div class="nv-hero__glow" aria-hidden="true"></div>
		<div class="nv-shell nv-hero__layout">
			<div class="nv-hero__copy" data-nv-reveal>
				<p class="nv-eyebrow">FRESH MEX · TEXAS MADE</p>
				<h1 id="nv-hero-title"><span>FRESH.</span><span>BOLD.</span><span class="nv-accent">MADE DAILY.</span></h1>
				<p class="nv-hero__lede">Fresh ingredients, bold flavors and endless combinations. Made your way, every day.</p>
				<div class="nv-actions"><a class="nv-pill nv-pill--lime nv-magnetic" href="<?php echo esc_url( $order_url ); ?>">Order now <span>→</span></a><a class="nv-pill nv-pill--ghost nv-magnetic" href="https://apps.apple.com/us/app/%C3%BCberrito-fresh-mex/id1569506904">Download app <span>↓</span></a></div>
				<p class="nv-location-line">● Two locations <b>Atascocita</b> + <b>Sugar Land</b></p>
			</div>
			<div class="nv-hero__art nv-parallax" data-depth="22" data-nv-reveal>
				<div class="nv-hero__sun" aria-hidden="true">✺</div>
				<img class="nv-hero__bowl" src="<?php echo $asset( 'open-burrito.webp' ); ?>" alt="Fresh Uberrito meal" width="1024" height="1024">
				<img class="nv-hero__lime" src="<?php echo $asset( 'lime-slices.png.webp' ); ?>" alt="" width="383" height="1024">
				<div class="nv-fresh-stamp">Fresh ingredients<br><span>real flavor</span></div>
			</div>
		</div>
		<a class="nv-scroll" href="#menu">Scroll to taste <span>↓</span></a>
	</section>

	<div class="nv-marquee" aria-label="Uberrito brand values"><div>FRESH INGREDIENTS <i>✹</i> BOLD FLAVOR <i>✹</i> MADE YOUR WAY <i>✹</i> ZERO BORING BITES <i>✹</i> FRESH INGREDIENTS <i>✹</i> BOLD FLAVOR <i>✹</i> MADE YOUR WAY <i>✹</i> ZERO BORING BITES <i>✹</i></div></div>

	<section id="menu" class="nv-menu-section">
		<div class="nv-shell">
			<header class="nv-section-head" data-nv-reveal><div><p class="nv-eyebrow">PICK YOUR PLAYER</p><h2>OUR <span>MENU</span></h2></div><p>Fresh ingredients. Endless combinations. <em>Made your way.</em></p><a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>">View full menu →</a></header>
			<div class="nv-menu-grid">
				<a class="nv-menu-item" href="<?php echo esc_url( $order_url ); ?>" data-nv-reveal><img src="<?php echo $asset( 'burrito.webp' ); ?>" alt="Burritos" width="1100" height="763" loading="lazy"><div><span>01</span><h3>Burritos</h3><p>Wrapped and ready.</p></div><b>→</b></a>
				<a class="nv-menu-item" href="<?php echo esc_url( $order_url ); ?>" data-nv-reveal><img src="<?php echo $asset( 'Bowl-1.webp' ); ?>" alt="Bowls" width="1024" height="1024" loading="lazy"><div><span>02</span><h3>Bowls</h3><p>Fork-first flavor.</p></div><b>→</b></a>
				<a class="nv-menu-item" href="<?php echo esc_url( $order_url ); ?>" data-nv-reveal><img src="<?php echo $asset( 'tacos.webp' ); ?>" alt="Tacos" width="1100" height="970" loading="lazy"><div><span>03</span><h3>Tacos</h3><p>Small but loud.</p></div><b>→</b></a>
				<a class="nv-menu-item" href="<?php echo esc_url( $order_url ); ?>" data-nv-reveal><img src="<?php echo $asset( 'nachos-thumb-1.webp' ); ?>" alt="Nachos" width="768" height="768" loading="lazy"><div><span>04</span><h3>Nachos</h3><p>Loaded on purpose.</p></div><b>→</b></a>
				<a class="nv-menu-item" href="<?php echo esc_url( $order_url ); ?>" data-nv-reveal><img src="<?php echo $asset( 'Salad-1.webp' ); ?>" alt="Salads" width="768" height="768" loading="lazy"><div><span>05</span><h3>Salads</h3><p>Green, never boring.</p></div><b>→</b></a>
				<a class="nv-menu-item" href="<?php echo esc_url( $order_url ); ?>" data-nv-reveal><img src="<?php echo $asset( 'uberrito-chips-guacamole.png' ); ?>" alt="Chips and guacamole" width="900" height="900" loading="lazy"><div><span>06</span><h3>Chips + Guac</h3><p>The essential sidekick.</p></div><b>→</b></a>
			</div>
			<div class="nv-menu-proof" data-nv-reveal><span>♨ <b>Made fresh daily</b> Never pre-cooked.</span><span>◉ <b>Quality ingredients</b> Real ingredients. Real flavor.</span><span>✦ <b>Made your way</b> Customize everything.</span></div>
		</div>
	</section>

	<section class="nv-feels" aria-labelledby="nv-feels-title">
		<div class="nv-feels__wave" aria-hidden="true"></div>
		<div class="nv-shell nv-feels__stage">
			<div class="nv-feels__copy" data-nv-reveal><p class="nv-eyebrow">THE GOOD STUFF</p><h2 id="nv-feels-title">FOOD THAT<br><span>FEELS GOOD.</span></h2><p>Bright, fresh, filling and completely yours. We prep daily so every bite hits different—in the best way.</p></div>
		<div class="nv-feels__plate nv-parallax" data-depth="16" data-nv-reveal><img src="<?php echo $asset( 'fresh-chicken-bowl.webp' ); ?>" alt="Fresh chicken bowl" width="1024" height="1024" loading="lazy"><span class="nv-orbit-tag nv-orbit-tag--one">Fresh daily</span><span class="nv-orbit-tag nv-orbit-tag--two">Big flavor</span><span class="nv-orbit-tag nv-orbit-tag--three">Your way</span></div>
			<a class="nv-face-button nv-magnetic" href="<?php echo esc_url( $order_url ); ?>" aria-label="Build your Uberrito order"><span class="nv-eye"><i></i></span><span class="nv-eye"><i></i></span><b>BUILD<br>YOURS</b></a>
		</div>
	</section>

	<section id="locations" class="nv-flight" aria-labelledby="nv-flight-title">
		<div class="nv-flight__sticky">
			<div class="nv-shell nv-flight__heading" data-nv-reveal><p class="nv-eyebrow">TEXAS, TWO WAYS</p><h2 id="nv-flight-title">FRESH FLAVOR<br><span>HAS LANDED.</span></h2></div>
			<svg class="nv-flight__path" viewBox="0 0 1400 620" role="img" aria-label="Route from Atascocita to Sugar Land"><path id="nv-flight-path" d="M80 480 C300 80 540 90 700 310 S1090 610 1320 150" fill="none" stroke="currentColor" stroke-width="6" stroke-linecap="round" stroke-dasharray="18 22"/></svg>
			<div class="nv-plane" aria-hidden="true">✈</div>
			<article class="nv-location-card nv-location-card--one" data-nv-reveal><span>01</span><img src="<?php echo $asset( 'uberrito-atascocita-exterior.jpeg' ); ?>" alt="Uberrito Atascocita exterior" width="1200" height="1063" loading="lazy"><div><h3>Atascocita</h3><p>19350 W Lake Houston Pkwy<br>Humble, TX 77346</p><a href="<?php echo esc_url( $locations_url ); ?>">Get directions →</a></div></article>
			<article class="nv-location-card nv-location-card--two" data-nv-reveal><span>02</span><img src="<?php echo $asset( 'uberrito-restaurant-interior.jpeg' ); ?>" alt="Inside Uberrito Sugar Land" width="1536" height="1022" loading="lazy"><div><h3>Sugar Land</h3><p>15445 SW Fwy, Suite 500<br>Sugar Land, TX 77478</p><a href="<?php echo esc_url( $locations_url ); ?>">Get directions →</a></div></article>
		</div>
	</section>

	<section id="catering" class="nv-catering" aria-labelledby="nv-catering-title">
		<div class="nv-catering__copy" data-nv-reveal><p class="nv-eyebrow">FEED THE WHOLE GROUP CHAT</p><h2 id="nv-catering-title">CATER WITH<br><span>UBERRITO.</span></h2><p>Corporate events, parties, game days or just because. Big spreads, bold flavors and easy serving.</p><a class="nv-pill nv-pill--lime nv-magnetic" href="<?php echo esc_url( $catering_url ); ?>">Cater now <span>→</span></a></div>
		<div class="nv-catering__visual" data-nv-reveal><img src="<?php echo $asset( 'uberrito-loaded-nachos-wide.png' ); ?>" alt="Uberrito catering spread" width="1600" height="800" loading="lazy"><span>Office lunch?</span><span>Game day?</span><span>We got you.</span></div>
	</section>

	<section id="merch" class="nv-merch" aria-labelledby="nv-merch-title">
		<div class="nv-shell nv-merch__layout">
			<div class="nv-merch__copy" data-nv-reveal><p class="nv-eyebrow">OFFICIAL MERCH · LIMITED DROPS</p><h2 id="nv-merch-title">WEAR THE<br><span>UBERRITO</span><br>LIFESTYLE.</h2><p>Bold gear for people who never order boring.</p><a class="nv-pill nv-pill--dark nv-magnetic" href="#bottom-nav">See the drop <span>↓</span></a></div>
			<div class="nv-merch__art nv-parallax" data-depth="14" data-nv-reveal><img src="<?php echo $asset( 'merch-official.webp' ); ?>" alt="Official Uberrito merchandise" width="1024" height="1024" loading="lazy"><div>DROP<br><b>001</b></div></div>
		</div>
	</section>

	<section id="rewards" class="nv-reward-ribbon" aria-label="Uberrito rewards">
		<div class="nv-shell"><div><p>NÜ REWARDS</p><h2>EAT. EARN. <span>EAT FREE.</span></h2></div><a class="nv-face-button nv-face-button--small nv-magnetic" href="<?php echo esc_url( $rewards_url ); ?>"><span class="nv-eye"><i></i></span><span class="nv-eye"><i></i></span><b>JOIN<br>FREE</b></a></div>
	</section>

	<section id="bottom-nav" class="nv-bottom-nav" aria-labelledby="nv-bottom-title">
		<div class="nv-bottom-preview" aria-hidden="true"><img src="<?php echo $asset( 'burrito.webp' ); ?>" alt=""></div>
		<div class="nv-shell"><p class="nv-eyebrow">PICK YOUR NEXT MOVE</p><h2 id="nv-bottom-title" class="screen-reader-text">Explore Uberrito</h2><nav aria-label="Explore Uberrito"><a href="<?php echo esc_url( $order_url ); ?>" data-preview="burrito.webp"><span>01</span>Burritos <b>↗</b></a><a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" data-preview="Bowl-1.webp"><span>02</span>Menu <b>↗</b></a><a href="<?php echo esc_url( $rewards_url ); ?>" data-preview="rewards-burritos.webp"><span>03</span>Rewards <b>↗</b></a><a href="<?php echo esc_url( $catering_url ); ?>" data-preview="uberrito-loaded-nachos-wide.png"><span>04</span>Catering <b>↗</b></a><a href="<?php echo esc_url( $locations_url ); ?>" data-preview="uberrito-atascocita-exterior.jpeg"><span>05</span>Locations <b>↗</b></a></nav></div>
	</section>

	<footer class="nv-footer">
		<div class="nv-food-launch" aria-hidden="true"><img src="<?php echo $asset( 'wrapped-burrito.png.webp' ); ?>" alt=""><img src="<?php echo $asset( 'uberrito-chips-guacamole.png' ); ?>" alt=""><img src="<?php echo $asset( 'Fajita-Steak.webp' ); ?>" alt=""><img src="<?php echo $asset( 'lime-slices.png.webp' ); ?>" alt=""><img src="<?php echo $asset( 'nachos.webp' ); ?>" alt=""></div>
		<div class="nv-shell nv-footer__top"><p>Fresh ingredients · bold flavor · made daily</p><p>Atascocita · Sugar Land</p></div>
		<div class="nv-footer__word" aria-label="Uberrito"><span>U</span><span>B</span><span>E</span><span>R</span><span>R</span><span>I</span><span>T</span><span>O</span></div>
		<div class="nv-shell nv-footer__base"><p>© <?php echo esc_html( gmdate( 'Y' ) ); ?> Uberrito</p><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a><a href="<?php echo esc_url( $order_url ); ?>">Order now ↗</a></div>
	</footer>
</main>
<?php wp_footer(); ?>
</body>
</html>
