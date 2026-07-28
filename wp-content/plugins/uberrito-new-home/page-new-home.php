<?php
/** Experimental Uberrito homepage at /new-home/. */
defined( 'ABSPATH' ) || exit;

$uploads = trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/07/';
$asset = static function ( $file ) use ( $uploads ) { return esc_url( $uploads . ltrim( $file, '/' ) ); };
$plugin_asset = static function ( $file ) { return esc_url( plugin_dir_url( __FILE__ ) . ltrim( $file, '/' ) ); };
$order_url = 'https://uberrito.toast.site/';
$rewards_url = home_url( '/rewards/' );
$locations_url = home_url( '/locations/' );
$catering_url = home_url( '/catering/' );
$location_data = function_exists( 'uberrito_new_home_locations' ) ? uberrito_new_home_locations() : array();
$format_time = static function ( $time ) {
	$parsed = DateTimeImmutable::createFromFormat( 'H:i', $time );
	return $parsed ? $parsed->format( 'g:i A' ) : $time;
};
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
  <div class="nv-loader__orbit" aria-hidden="true"><span class="nv-food-icon nv-food-icon--bean">●</span><span class="nv-food-icon nv-food-icon--chip">▲</span><span class="nv-food-icon nv-food-icon--cheese">▰</span><span class="nv-food-icon nv-food-icon--lime">◉</span></div>
  <div class="nv-loader__burrito" aria-hidden="true"><img src="<?php echo $asset( 'wrapped-burrito.png.webp' ); ?>" alt="" width="900" height="452"></div>
  <p>Rolling something fresh...</p>
  <div class="nv-loader__bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><span></span></div>
</div>

<header class="nv-site-head">
  <div class="nv-offers" aria-label="Current offers"><div class="nv-offers__inner">
    <img class="nv-offers__image" src="<?php echo $asset( 'rewards-chips.webp' ); ?>" alt="" width="600" height="300">
    <div class="nv-offers__copy" aria-live="polite"><small>NEW MEMBER OFFER</small><p>New here? Get <strong>FREE</strong> small chips &amp; queso.</p></div>
    <a class="nv-offers__link" href="<?php echo esc_url( $rewards_url ); ?>">Join now <span aria-hidden="true">→</span></a>
    <div class="nv-offers__controls"><button type="button" data-offer-prev aria-label="Previous offer">←</button><span><b data-offer-current>1</b> / 4</span><button type="button" data-offer-next aria-label="Next offer">→</button><button type="button" data-offer-pause aria-label="Pause offer rotation">Ⅱ</button></div>
  </div></div>
  <nav class="nv-nav" aria-label="Main navigation">
    <a class="nv-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $asset( 'uberrito-white-logo.png' ); ?>" alt="Uberrito Fresh Mex" width="854" height="155"></a>
    <div class="nv-nav__links"><a href="#menu">Menu</a><a href="#catering">Catering</a><a href="#rewards">Rewards</a><a href="#locations">Locations</a><a href="#merch">Merch</a></div>
    <a class="nv-pill nv-pill--lime" href="<?php echo esc_url( $order_url ); ?>">Order now <span>→</span></a>
    <button class="nv-menu-toggle" type="button" aria-expanded="false" aria-controls="nv-mobile-menu" aria-label="Open menu"><i></i><i></i></button>
  </nav>
  <div id="nv-mobile-menu" class="nv-mobile-menu" hidden>
    <div class="nv-menu-preview" aria-hidden="true"><img src="<?php echo $asset( 'burrito.webp' ); ?>" alt=""></div>
    <div class="nv-shell nv-menu-panel">
      <p class="nv-eyebrow">PICK YOUR NEXT MOVE</p>
      <nav aria-label="Explore Uberrito">
        <a href="<?php echo esc_url( $order_url ); ?>" data-preview-url="<?php echo $asset( 'burrito.webp' ); ?>"><span>01</span>Order now <b>↗</b></a>
        <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" data-preview-url="<?php echo $asset( 'Bowl-1.webp' ); ?>"><span>02</span>View menu <b>↗</b></a>
        <a href="https://www.instagram.com/uberrito/" data-preview-url="<?php echo $asset( 'tacos.webp' ); ?>"><span>03</span>Follow us <b>↗</b></a>
        <a href="<?php echo esc_url( $rewards_url ); ?>" data-preview-url="<?php echo $asset( 'rewards-burritos.webp' ); ?>"><span>04</span>Rewards <b>↗</b></a>
        <a href="<?php echo esc_url( $catering_url ); ?>" data-preview-url="<?php echo $asset( 'uberrito-loaded-nachos-wide.png' ); ?>"><span>05</span>Catering <b>↗</b></a>
        <a href="<?php echo esc_url( $locations_url ); ?>" data-preview-url="<?php echo $plugin_asset( 'location-atascocita-google.jpg' ); ?>"><span>06</span>Locations <b>↗</b></a>
        <a href="<?php echo esc_url( $locations_url ); ?>" data-preview-url="<?php echo $plugin_asset( 'location-sugar-land-google.png' ); ?>"><span>07</span>Leave a review <b>↗</b></a>
        <a href="https://apps.apple.com/us/app/%C3%BCberrito-fresh-mex/id1569506904" data-preview-url="<?php echo $asset( 'bowl-and-glass.webp' ); ?>"><span>08</span>Download app <b>↗</b></a>
      </nav>
    </div>
  </div>
</header>

<main id="content" class="nv-home">
  <div class="nv-pointer-trail" aria-hidden="true"></div>
  <section class="nv-hero" aria-label="Uberrito highlights">
    <article class="nv-hero__slide is-active" data-hero-slide aria-labelledby="nv-hero-title">
      <div class="nv-hero__backdrop"><img src="<?php echo $asset( 'banner-home.webp' ); ?>" alt="Uberrito team member finishing a fresh bowl" width="1920" height="950" fetchpriority="high"></div>
      <div class="nv-hero__shade"></div>
      <div class="nv-shell nv-hero__layout"><div class="nv-hero__copy">
        <p class="nv-eyebrow">FRESH MEX · TEXAS MADE</p>
        <h1 id="nv-hero-title"><span>FRESH.</span><span>BOLD.</span><span class="nv-accent">MADE DAILY.</span></h1>
        <p class="nv-hero__lede">Fresh ingredients, bold flavors and endless combinations. Made your way, every day.</p>
        <div class="nv-actions"><a class="nv-pill nv-pill--lime nv-magnetic" href="<?php echo esc_url( $order_url ); ?>">Order now <span>→</span></a><a class="nv-pill nv-pill--ghost nv-magnetic" href="https://apps.apple.com/us/app/%C3%BCberrito-fresh-mex/id1569506904">Download app <span>↓</span></a></div>
        <p class="nv-location-line">● Two locations <b>Atascocita</b> + <b>Sugar Land</b></p>
      </div></div>
    </article>
    <article class="nv-hero__slide nv-hero__slide--rewards" data-hero-slide aria-labelledby="nv-reward-hero-title" aria-hidden="true">
      <div class="nv-hero__backdrop"><img src="<?php echo $asset( 'banner-home-2.webp' ); ?>" alt="Fresh Uberrito bowl with colorful ingredients" width="1920" height="850"></div>
      <div class="nv-hero__shade"></div>
      <div class="nv-shell nv-hero__layout"><div class="nv-hero__copy">
        <p class="nv-eyebrow">NÜ REWARDS · FREE TO JOIN</p>
        <h2 id="nv-reward-hero-title"><span>EAT.</span><span>EARN.</span><span class="nv-accent">EAT FREE.</span></h2>
        <p class="nv-hero__lede">Earn one point for every $1 you spend. Redeem your points for a free side and more.</p>
        <div class="nv-actions"><a class="nv-pill nv-pill--lime nv-magnetic" href="<?php echo esc_url( $rewards_url ); ?>">Join NÜ Rewards <span>→</span></a><a class="nv-pill nv-pill--ghost nv-magnetic" href="<?php echo esc_url( $order_url ); ?>">Start earning <span>→</span></a></div>
      </div></div>
    </article>
    <div class="nv-hero__controls" aria-label="Hero slides"><button type="button" data-hero-prev aria-label="Previous slide">←</button><div><button class="is-active" type="button" data-hero-dot="0" aria-label="Show fresh food slide"></button><button type="button" data-hero-dot="1" aria-label="Show rewards slide"></button></div><button type="button" data-hero-next aria-label="Next slide">→</button></div>
    <a class="nv-scroll" href="#menu">Scroll to taste <span>↓</span></a>
  </section>

  <div class="nv-marquee" aria-label="Uberrito brand values"><div>FRESH INGREDIENTS <i>✹</i> BOLD FLAVOR <i>✹</i> MADE YOUR WAY <i>✹</i> ZERO BORING BITES <i>✹</i> FRESH INGREDIENTS <i>✹</i> BOLD FLAVOR <i>✹</i> MADE YOUR WAY <i>✹</i> ZERO BORING BITES <i>✹</i></div></div>

  <section id="menu" class="nv-menu-section"><div class="nv-shell">
    <header class="nv-section-head" data-nv-reveal><div><p class="nv-eyebrow">BUILD IT YOUR WAY</p><h2>OUR <span>MENU</span></h2></div><p>Fresh ingredients. Endless combinations. <em>Made your way.</em></p><a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>">View full menu →</a></header>
    <div class="nv-menu-grid">
      <?php
      $menu_items = array(
        array( 'Burritos', 'Wrapped and ready.', 'burrito.webp' ), array( 'Bowls', 'Fork-first flavor.', 'Bowl-1.webp' ), array( 'Tacos', 'Small but loud.', 'tacos.webp' ),
        array( 'Nachos', 'Loaded on purpose.', 'nachos-thumb-1.webp' ), array( 'Salads', 'Green, never boring.', 'Salad-1.webp' ), array( 'Chips + Guac', 'The essential sidekick.', 'uberrito-chips-guacamole.png' ),
      );
      foreach ( $menu_items as $index => $item ) : ?>
        <a class="nv-menu-item" href="<?php echo esc_url( $order_url ); ?>" data-nv-reveal><img src="<?php echo $asset( $item[2] ); ?>" alt="<?php echo esc_attr( $item[0] ); ?>" width="900" height="700" loading="lazy"><div><span><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span><h3><?php echo esc_html( $item[0] ); ?></h3><p><?php echo esc_html( $item[1] ); ?></p></div><b>→</b></a>
      <?php endforeach; ?>
    </div>
    <div class="nv-menu-proof" data-nv-reveal><span><i class="nv-proof-icon">♨</i><b>Made fresh daily</b><small>Never pre-cooked. Always fresh.</small></span><span><i class="nv-proof-icon">◉</i><b>Quality ingredients</b><small>Real ingredients. Real flavor.</small></span><span><i class="nv-proof-icon">✦</i><b>Made your way</b><small>Customize every bite.</small></span></div>
  </div></section>

  <section class="nv-feels" aria-labelledby="nv-feels-title"><div class="nv-feels__wave"></div><div class="nv-shell nv-feels__stage">
    <div class="nv-feels__copy" data-nv-reveal><p class="nv-eyebrow">THE GOOD STUFF</p><h2 id="nv-feels-title">FOOD THAT<br><span>FEELS GOOD.</span></h2><p>Bright, fresh, filling and completely yours. We prep daily so every bite hits different—in the best way.</p></div>
    <div class="nv-burrito-pal" data-nv-reveal aria-label="A playful standing burrito character that follows your pointer"><span class="nv-burrito-arm nv-burrito-arm--left"></span><img src="<?php echo $asset( 'wrapped-burrito.png.webp' ); ?>" alt="Standing Uberrito burrito character" width="900" height="452"><span class="nv-character-eyes"><i class="nv-eye"><b></b></i><i class="nv-eye"><b></b></i></span><span class="nv-burrito-smile"></span><span class="nv-burrito-arm nv-burrito-arm--right"></span><span class="nv-burrito-leg nv-burrito-leg--left"></span><span class="nv-burrito-leg nv-burrito-leg--right"></span><span class="nv-orbit-tag nv-orbit-tag--one">Fresh daily</span><span class="nv-orbit-tag nv-orbit-tag--two">Big flavor</span><span class="nv-orbit-tag nv-orbit-tag--three">Your way</span></div>
  </div></section>

  <section id="locations" class="nv-flight" aria-labelledby="nv-flight-title"><div class="nv-flight__sticky">
    <div class="nv-shell nv-flight__heading" data-nv-reveal><p class="nv-eyebrow">TEXAS, TWO WAYS</p><h2 id="nv-flight-title">FRESH FLAVOR<br><span>HAS LANDED.</span></h2></div>
    <svg class="nv-flight__path" viewBox="0 0 1400 620" role="img" aria-label="Route from Atascocita to Sugar Land"><path id="nv-flight-path" d="M80 480 C300 80 540 90 700 310 S1090 610 1320 150" fill="none" stroke="currentColor" stroke-width="6" stroke-linecap="round" stroke-dasharray="18 22"/></svg><div class="nv-plane" aria-hidden="true">✈</div>
    <?php
    foreach ( array_values( $location_data ) as $location_index => $location ) :
      $status = uberrito_new_home_location_status( $location );
      $card_class = 0 === $location_index ? 'nv-location-card--one' : 'nv-location-card--two';
    ?>
      <article class="nv-location-card <?php echo esc_attr( $card_class ); ?>" data-nv-reveal>
        <span><?php echo esc_html( str_pad( (string) ( $location_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
        <img src="<?php echo esc_url( $location['image'] ); ?>" alt="<?php echo esc_attr( 'Uberrito ' . $location['name'] . ' exterior' ); ?>" width="900" height="620" loading="lazy">
        <div>
          <div class="nv-location-card__topline"><h3><?php echo esc_html( $location['name'] ); ?></h3><b class="nv-location-status <?php echo $status['is_open'] ? 'is-open' : 'is-closed'; ?>"><?php echo esc_html( $status['label'] ); ?></b></div>
          <p><?php echo esc_html( $location['address_one'] ); ?><br><?php echo esc_html( $location['address_two'] ); ?></p>
          <p class="nv-location-hours">Daily <?php echo esc_html( $format_time( $location['open_time'] ) . ' - ' . $format_time( $location['close_time'] ) ); ?></p>
          <a href="<?php echo esc_url( $location['directions'] ); ?>">Get directions →</a>
        </div>
      </article>
    <?php endforeach; ?>
  </div></section>

  <section id="catering" class="nv-catering" aria-labelledby="nv-catering-title"><div class="nv-catering__copy" data-nv-reveal><p class="nv-eyebrow">FEED THE WHOLE GROUP CHAT</p><h2 id="nv-catering-title">CATER WITH<br><span>UBERRITO.</span></h2><p>Corporate events, parties, game days or just because. We’ve got you.</p><a class="nv-pill nv-pill--green nv-magnetic" href="<?php echo esc_url( $catering_url ); ?>">Cater now <span>→</span></a></div><div class="nv-catering__visual" data-nv-reveal><img src="<?php echo $plugin_asset( 'catering-spread.webp' ); ?>" alt="Uberrito catering spread with fresh trays and sides" width="1672" height="941" loading="lazy"><span>Office lunch?</span><span>Game day?</span><span>We got you.</span><div class="nv-clippy nv-clippy--catering" aria-hidden="true"><span class="nv-clippy__bubble">Need lunch for the whole crew? I got you!</span><img src="<?php echo $asset( 'wrapped-burrito.png.webp' ); ?>" alt=""><span class="nv-clippy__eyes"><i></i><i></i></span></div></div></section>

  <section id="merch" class="nv-merch" aria-labelledby="nv-merch-title"><div class="nv-shell nv-merch__layout">
    <div class="nv-merch__copy" data-nv-reveal><p class="nv-eyebrow">OFFICIAL MERCH · LIMITED DROPS</p><h2 id="nv-merch-title">WEAR THE<br><span>UBERRITO</span><br>LIFESTYLE.</h2><p>Premium apparel, drinkware and everyday essentials designed for true Uberrito fans.</p><a class="nv-pill nv-pill--green nv-magnetic" href="#nv-mobile-menu" data-nv-open-menu>Shop merch <span>→</span></a></div>
    <div class="nv-merch__art nv-parallax" data-depth="14" data-nv-reveal><img class="nv-merch__collection" src="<?php echo $asset( 'merch-official.webp' ); ?>" alt="Official Uberrito merchandise" width="1024" height="1024" loading="lazy"><img class="nv-merch__cup" src="<?php echo $plugin_asset( 'uberrito-cup.png' ); ?>" alt="Uberrito Above and Beyond Burrito cup" width="511" height="1080" loading="lazy"><div>DROP<br><b>001</b></div></div>
  </div></section>

  <section id="rewards" class="nv-reward-ribbon" aria-label="Uberrito rewards"><div class="nv-shell"><div><p>NÜ REWARDS · NEW MEMBER BONUS</p><h2>EAT. EARN. <span>EAT FREE.</span></h2><strong>Join today and get enough bonus points for a FREE side.</strong></div><a class="nv-face-button nv-face-button--small nv-magnetic" href="<?php echo esc_url( $rewards_url ); ?>"><span class="nv-eye"><i></i></span><span class="nv-eye"><i></i></span><b>JOIN<br>FREE</b></a></div></section>

  <footer class="nv-footer">
    <div class="nv-ninja-stage" aria-hidden="true"><div class="nv-slash-trail"></div><?php foreach ( array( 'wrapped-burrito.png.webp', 'uberrito-chips-guacamole.png', 'Fajita-Steak.webp', 'lime-slices.png.webp', 'nachos.webp' ) as $index => $food ) : ?><span class="nv-ninja-item nv-ninja-item--<?php echo esc_attr( (string) ( $index + 1 ) ); ?>" data-ninja-item><i class="nv-ninja-half nv-ninja-half--left" style="--food:url('<?php echo $asset( $food ); ?>')"></i><i class="nv-ninja-half nv-ninja-half--right" style="--food:url('<?php echo $asset( $food ); ?>')"></i></span><?php endforeach; ?></div>
    <div class="nv-shell nv-footer__top"><p>Fresh ingredients · bold flavor · made daily</p><p>Atascocita · Sugar Land</p></div>
    <div class="nv-footer__word" aria-label="Uberrito"><img src="<?php echo $asset( 'uberrito-white-logo.png' ); ?>" alt="Uberrito Fresh Mex" width="854" height="155"></div>
    <div class="nv-shell nv-footer__base"><p>© <?php echo esc_html( gmdate( 'Y' ) ); ?> Uberrito</p><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a><a href="<?php echo esc_url( $order_url ); ?>">Order now ↗</a></div>
  </footer>
</main>
<?php wp_footer(); ?>
</body>
</html>
