<?php
/**
 * Uberrito homepage redesign.
 *
 * @package HelloElementorChild
 */

defined( 'ABSPATH' ) || exit;

get_header();

$uploads       = trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/07/';
$asset         = static function ( $file ) use ( $uploads ) {
	return esc_url( $uploads . ltrim( $file, '/' ) );
};
$order_url     = 'https://uberrito.toast.site/';
$rewards_url   = home_url( '/rewards/' );
$locations_url = home_url( '/locations/' );
$catering_url  = home_url( '/catering/' );
?>

<main id="content" class="ub-home">
	<section class="ub-home-hero" aria-labelledby="ub-home-title">
		<div class="ub-home-hero__media" aria-hidden="true">
			<img src="<?php echo $asset( 'banner-home.webp' ); ?>" alt="" width="1920" height="950" fetchpriority="high">
			<video class="ub-home-hero__video" muted loop playsinline preload="none" poster="<?php echo $asset( 'banner-home.webp' ); ?>" data-src="<?php echo $asset( 'Uberrito-Shrimp-On-Line-bowl-order.mp4' ); ?>"></video>
		</div>
		<div class="ub-home-hero__wash"></div>
		<div class="ub-home-shell ub-home-hero__layout">
			<div class="ub-home-hero__copy" data-reveal>
				<p class="ub-kicker">NÜ REWARDS · FIRST BITE'S ON US</p>
				<h1 id="ub-home-title">JOIN NÜ.<br><span>GET THE QUESO.</span></h1>
				<p class="ub-home-hero__lede">New members get free small chips &amp; queso. Sign up, choose your Uberrito, and start earning with every order.</p>
				<div class="ub-actions">
					<a class="ub-button ub-button--lime ub-magnetic" href="<?php echo esc_url( $rewards_url ); ?>">Get my free chips &amp; queso <span aria-hidden="true">↗</span></a>
					<a class="ub-button ub-button--glass ub-magnetic" href="https://apps.apple.com/us/app/%C3%BCberrito-fresh-mex/id1569506904">Download the app <span aria-hidden="true">↓</span></a>
				</div>
				<p class="ub-home-hero__locations"><span></span> Atascocita, TX <b>·</b> Sugar Land, TX</p>
			</div>
			<figure class="ub-home-hero__food ub-pointer-depth" data-depth="16" data-reveal>
				<img src="<?php echo $asset( 'chips-dips.webp' ); ?>" alt="Uberrito chips with fresh dips" width="1200" height="804">
				<figcaption>Fresh flavor.<br>Zero boring bites.</figcaption>
			</figure>
		</div>
		<a class="ub-scroll-cue" href="#fresh-picks">Keep scrolling <span aria-hidden="true">↓</span></a>
	</section>

	<div class="ub-word-river" aria-label="Uberrito brand promise">
		<div><span>FRESH INGREDIENTS</span><i>✹</i><span>BIG FLAVOR</span><i>✹</i><span>MADE YOUR WAY</span><i>✹</i><span>FRESH INGREDIENTS</span><i>✹</i><span>BIG FLAVOR</span><i>✹</i><span>MADE YOUR WAY</span></div>
	</div>

	<section id="fresh-picks" class="ub-story ub-story--picks">
		<div class="ub-home-shell">
			<header class="ub-section-head" data-reveal>
				<p class="ub-kicker">FRESH PICKS · CHANGED OFTEN</p>
				<h2>WHAT ARE WE<br><span>CRAVING?</span></h2>
				<p>Two current favorites, full-screen flavor. The products can change in WordPress without redesigning the section for every season.</p>
			</header>
			<div class="ub-picks">
				<article class="ub-pick ub-tilt" data-reveal>
					<div class="ub-pick__number">01</div>
					<img src="<?php echo $asset( 'ultimate-steak-burrito.webp' ); ?>" alt="Ultimate steak burrito" width="1024" height="1024" loading="lazy">
					<div class="ub-pick__copy"><p>Flame-grilled favorite</p><h3>Ultimate Steak Burrito</h3><a href="<?php echo esc_url( $order_url ); ?>">Build yours <span>↗</span></a></div>
				</article>
				<article class="ub-pick ub-pick--lime ub-tilt" data-reveal>
					<div class="ub-pick__number">02</div>
					<img src="<?php echo $asset( 'fresh-chicken-bowl.webp' ); ?>" alt="Fresh chicken bowl" width="1024" height="1024" loading="lazy">
					<div class="ub-pick__copy"><p>Fresh, stacked, satisfying</p><h3>Fresh Chicken Bowl</h3><a href="<?php echo esc_url( $order_url ); ?>">Make it yours <span>↗</span></a></div>
				</article>
			</div>
		</div>
	</section>

	<section class="ub-menu-journey" aria-labelledby="ub-menu-title">
		<div class="ub-home-shell">
			<header class="ub-section-head ub-section-head--center" data-reveal>
				<p class="ub-kicker">PICK A LANE. THEN BREAK THE RULES.</p>
				<h2 id="ub-menu-title">FIND YOUR <span>FLAVOR</span></h2>
			</header>
			<div class="ub-menu-grid">
				<a class="ub-menu-card ub-menu-card--wide ub-tilt" href="<?php echo esc_url( $order_url ); ?>" data-reveal><span>01</span><h3>Burritos</h3><p>Wrapped, loaded, ready to roll.</p><img src="<?php echo $asset( 'burrito.webp' ); ?>" alt="Uberrito burrito" width="1100" height="763" loading="lazy"><b>Order ↗</b></a>
				<a class="ub-menu-card ub-menu-card--orange ub-tilt" href="<?php echo esc_url( $order_url ); ?>" data-reveal><span>02</span><h3>Bowls</h3><p>Everything you want. Fork required.</p><img src="<?php echo $asset( 'Bowl-1.webp' ); ?>" alt="Uberrito bowl" width="1024" height="1024" loading="lazy"><b>Order ↗</b></a>
				<a class="ub-menu-card ub-menu-card--cream ub-tilt" href="<?php echo esc_url( $order_url ); ?>" data-reveal><span>03</span><h3>Tacos</h3><p>Small format. Loud flavor.</p><img src="<?php echo $asset( 'tacos.webp' ); ?>" alt="Uberrito tacos" width="1100" height="970" loading="lazy"><b>Order ↗</b></a>
				<a class="ub-menu-card ub-menu-card--wide ub-menu-card--dark ub-tilt" href="<?php echo esc_url( $order_url ); ?>" data-reveal><span>04</span><h3>Nachos &amp; More</h3><p>Crunchy, cheesy, completely shareable. Maybe.</p><img src="<?php echo $asset( 'nachos-2.webp' ); ?>" alt="Uberrito loaded nachos" width="1400" height="1026" loading="lazy"><b>See the full menu ↗</b></a>
			</div>
		</div>
	</section>

	<section class="ub-catering" aria-labelledby="ub-catering-title">
		<div class="ub-catering__image" data-reveal><img src="<?php echo $asset( 'uberrito-loaded-nachos-wide.png' ); ?>" alt="Uberrito catering spread" width="1600" height="800" loading="lazy"></div>
		<div class="ub-catering__copy" data-reveal>
			<p class="ub-kicker">PARTY MODE: ON</p>
			<h2 id="ub-catering-title">YOU BET YOUR TACO<br><span>WE CATER.</span></h2>
			<p>Office lunch, game day or one seriously hungry crowd—we bring the bold flavors and make serving easy.</p>
			<a class="ub-button ub-button--dark ub-magnetic" href="<?php echo esc_url( $catering_url ); ?>">Plan your spread <span>↗</span></a>
		</div>
		<div class="ub-catering__stamp" aria-hidden="true">FEED<br>THE<br>CREW</div>
	</section>

	<section class="ub-merch" aria-labelledby="ub-merch-title">
		<div class="ub-home-shell ub-merch__layout">
			<div class="ub-merch__copy" data-reveal>
				<p class="ub-kicker">OFFICIAL MERCH · LIMITED DROPS</p>
				<h2 id="ub-merch-title">WEAR YOUR<br><span>CRAVING.</span></h2>
				<p>Bold gear for people who do not order boring. Apparel, drinkware and everyday Uberrito energy.</p>
				<a class="ub-button ub-button--lime ub-magnetic" href="#merch-collection">Explore the collection <span>↘</span></a>
			</div>
			<div id="merch-collection" class="ub-merch__visual ub-pointer-depth" data-depth="12" data-reveal>
				<p>DROP<br><b>001</b></p>
				<img src="<?php echo $asset( 'merch-official.webp' ); ?>" alt="Official Uberrito merchandise collection" width="1024" height="1024" loading="lazy">
			</div>
		</div>
	</section>

	<section class="ub-rewards" aria-labelledby="ub-rewards-title">
		<div class="ub-home-shell ub-rewards__layout">
			<div class="ub-rewards__visual ub-pointer-depth" data-depth="10" data-reveal>
				<div class="ub-rewards__burst">FREE<br>FOOD<br>ENERGY</div>
				<img src="<?php echo $asset( 'rewards-burritos.webp' ); ?>" alt="Uberrito rewards food" width="768" height="314" loading="lazy">
			</div>
			<div class="ub-rewards__copy" data-reveal>
				<p class="ub-kicker">EAT. EARN. EAT FREE.</p>
				<h2 id="ub-rewards-title">YOUR ORDER<br><span>OWES YOU.</span></h2>
				<ul><li><b>01</b> Join free</li><li><b>02</b> Earn 1 point per $1</li><li><b>03</b> Unlock member perks</li></ul>
				<div class="ub-actions"><a class="ub-button ub-button--dark ub-magnetic" href="<?php echo esc_url( $rewards_url ); ?>">Join NÜ Rewards <span>↗</span></a><a class="ub-text-link" href="https://play.google.com/store/search?q=uberrito&amp;c=apps">Get the app →</a></div>
			</div>
		</div>
	</section>

	<section class="ub-home-close" aria-labelledby="ub-close-title">
		<div class="ub-home-close__image" aria-hidden="true"><img src="<?php echo $asset( 'uberrito-restaurant-interior.jpeg' ); ?>" alt="" width="1536" height="1022" loading="lazy"></div>
		<div class="ub-home-shell ub-home-close__copy" data-reveal>
			<p class="ub-kicker">TWO TEXAS LOCATIONS. ONE BIG CRAVING.</p>
			<h2 id="ub-close-title">COME<br><span>HUNGRY.</span></h2>
			<div class="ub-location-links"><a href="<?php echo esc_url( $locations_url ); ?>">Atascocita, TX <span>↗</span></a><a href="<?php echo esc_url( $locations_url ); ?>">Sugar Land, TX <span>↗</span></a></div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
