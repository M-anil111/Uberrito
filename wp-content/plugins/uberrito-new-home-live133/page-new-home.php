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
   <div class="nv-offers" aria-label="Current offers">
      <div class="nv-offers__inner">
         <img class="nv-offers__image" src="<?php echo $asset( 'rewards-chips.webp' ); ?>" alt="" width="600" height="300">
         <div class="nv-offers__copy" aria-live="polite">
            <small>NEW MEMBER OFFER</small>
            <p>New here? Get <strong>FREE</strong> small chips &amp; queso.</p>
         </div>
         <a class="nv-offers__link" href="<?php echo esc_url( $rewards_url ); ?>">Join now <span aria-hidden="true">→</span></a>
         <div class="nv-offers__controls"><button type="button" data-offer-prev aria-label="Previous offer">←</button><span><b data-offer-current>1</b> / 4</span><button type="button" data-offer-next aria-label="Next offer">→</button><button type="button" data-offer-pause aria-label="Pause offer rotation">Ⅱ</button></div>
      </div>
   </div>
   <nav class="nv-nav" aria-label="Main navigation">
      <a class="nv-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $asset( 'uberrito-white-logo.png' ); ?>" alt="Uberrito Fresh Mex" width="854" height="155"></a>
      <div class="nv-nav__links"><a href="#menu">Menu</a><a href="#catering">Catering</a><a href="#rewards">Rewards</a><a href="#locations">Locations</a><a href="#merch">Merch</a></div>
      <a class="nv-pill nv-pill--lime" href="<?php echo esc_url( $order_url ); ?>">Order now <span>→</span></a>
      <button class="nv-menu-toggle" type="button" aria-expanded="false" aria-controls="nv-mobile-menu" aria-label="Open menu"><i></i><i></i></button>
   </nav>
   <div id="nv-mobile-menu" class="nv-mobile-menu" hidden><a href="#menu">Menu</a><a href="#catering">Catering</a><a href="#rewards">Rewards</a><a href="#locations">Locations</a><a href="#merch">Merch</a><a href="<?php echo esc_url( $order_url ); ?>">Order now</a></div>
</header>
<main id="content" class="nv-home">
   <div class="nv-pointer-trail" aria-hidden="true"></div>
   <section class="nv-hero" aria-label="Uberrito highlights">
      <article class="nv-hero__slide is-active" data-hero-slide aria-labelledby="nv-hero-title">
         <div class="nv-hero__backdrop"><img src="<?php echo $asset( 'banner-home.webp' ); ?>" alt="Fresh Uberrito burritos filled with grilled protein and vegetables" width="1672" height="941" fetchpriority="high"></div>
         <div class="nv-hero__shade"></div>
         <div class="nv-shell nv-hero__layout">
            <div class="nv-hero__copy">
               <p class="nv-eyebrow">FRESH MEX · TEXAS MADE</p>
               <h1 id="nv-hero-title"><span>FRESH.</span><span>BOLD.</span><span class="nv-accent">MADE DAILY.</span></h1>
               <p class="nv-hero__lede">Fresh ingredients, bold flavors and endless combinations. Made your way, every day.</p>
               <div class="nv-actions"><a class="nv-pill nv-pill--lime nv-magnetic" href="<?php echo esc_url( $order_url ); ?>">Order now <span>→</span></a><a class="nv-pill nv-pill--ghost nv-magnetic" href="https://apps.apple.com/us/app/%C3%BCberrito-fresh-mex/id1569506904">Download app <span>↓</span></a></div>
               <p class="nv-location-line">● Two locations <b>Atascocita</b> + <b>Sugar Land</b></p>
            </div>
         </div>
      </article>
      <article class="nv-hero__slide nv-hero__slide--rewards" data-hero-slide aria-labelledby="nv-reward-hero-title" aria-hidden="true">
         <div class="nv-hero__backdrop"><img src="<?php echo $asset( 'tacos-banner.webp' ); ?>" alt="Uberrito rewards meal" width="1600" height="900"></div>
         <div class="nv-hero__shade"></div>
         <div class="nv-shell nv-hero__layout">
            <div class="nv-hero__copy">
               <p class="nv-eyebrow">NÜ REWARDS · FREE TO JOIN</p>
               <h2 id="nv-reward-hero-title"><span>EAT.</span><span>EARN.</span><span class="nv-accent">EAT FREE.</span></h2>
               <p class="nv-hero__lede">Earn one point for every $1 you spend. Redeem your points for a free side and more.</p>
               <div class="nv-actions"><a class="nv-pill nv-pill--lime nv-magnetic" href="<?php echo esc_url( $rewards_url ); ?>">Join NÜ Rewards <span>→</span></a><a class="nv-pill nv-pill--ghost nv-magnetic" href="<?php echo esc_url( $order_url ); ?>">Start earning <span>→</span></a></div>
            </div>
         </div>
      </article>
      <div class="nv-hero__controls" aria-label="Hero slides">
         <button type="button" data-hero-prev aria-label="Previous slide">←</button>
         <div><button class="is-active" type="button" data-hero-dot="0" aria-label="Show fresh food slide"></button><button type="button" data-hero-dot="1" aria-label="Show rewards slide"></button></div>
         <button type="button" data-hero-next aria-label="Next slide">→</button>
      </div>
      <a class="nv-scroll" href="#menu">Scroll to taste <span>↓</span></a>
   </section>
   <div class="nv-marquee" aria-label="Uberrito brand values">
      <div>FRESH INGREDIENTS <i><img style="max-width: 60px; display: inline;" src="/wp-content/uploads/2026/07/Bowl-1.webp" alt=""></i> BOLD FLAVOR <i><img style="max-width: 60px; display: inline;" src="/wp-content/uploads/2026/07/Salad-1.webp" alt=""></i> MADE YOUR WAY <i><img style="max-width: 60px; display: inline;" src="/wp-content/uploads/2026/07/nachos-thumb-1.webp" alt=""></i> ZERO BORING BITES <i><img style="max-width: 60px; display: inline;" src="/wp-content/uploads/2026/07/salads-1.webp" alt=""></i> FRESH INGREDIENTS <i><img style="max-width: 60px; display: inline;" src="/wp-content/uploads/2026/07/nachos-2.webp" alt=""></i> BOLD FLAVOR <i><img style="max-width: 60px; display: inline;" src=/wp-content/uploads/2026/07/chips-dips.webp" alt=""></i> MADE YOUR WAY <i><img style="max-width: 60px; display: inline;" src="/wp-content/uploads/2026/07/burrito.webp" alt=""></i> ZERO BORING BITES <i><img style="max-width: 60px; display: inline;" src="/wp-content/uploads/2026/07/burrito-in-a-bowl-1.webp" alt=""></i></div>
   </div>
   <section id="menu" class="nv-menu-section">
      <div class="nv-shell">
         <div class="nv-section-head" data-nv-reveal>
            <div>
               <p class="nv-eyebrow">PICK YOUR PLAYER</p>
               <h2>OUR <span>MENU</span></h2>
               <p  class="nv-eyebrow-text">Fresh ingredients. Endless combinations. <em>Made your way.</em></p>
            </div>
            <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="nv-pill nv-pill--lime">View full menu</a>
         </div>
         <div class="nv-menu-grid">
            <?php
               $menu_items = array(
                 array( 'Burritos', 'Wrapped and ready.', 'burrito.webp' ), array( 'Bowls', 'Fork-first flavor.', 'Bowl-1.webp' ), array( 'Tacos', 'Small but loud.', 'tacos.webp' ),
                 array( 'Nachos', 'Loaded on purpose.', 'nachos-thumb-1.webp' ), array( 'Salads', 'Green, never boring.', 'Salad-1.webp' ), array( 'Chips + Guac', 'The essential sidekick.', 'uberrito-chips-guacamole.png' ),
               );
               foreach ( $menu_items as $index => $item ) : ?>
            <a class="nv-menu-item" href="<?php echo esc_url( $order_url ); ?>" data-nv-reveal>
               <img src="<?php echo $asset( $item[2] ); ?>" alt="<?php echo esc_attr( $item[0] ); ?>" width="900" height="700" loading="lazy">
               <div>
                  <span><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
                  <h3><?php echo esc_html( $item[0] ); ?></h3>
                  <p><?php echo esc_html( $item[1] ); ?></p>
               </div>
               <b>→</b>
            </a>
            <?php endforeach; ?>
         </div>
         <div class="nv-menu-proof" data-nv-reveal>
            <span>
                <i class="nv-proof-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M496 392c0 26.2-24.76 52.41-67.93 71.91C382.24 484.6 321.13 496 256 496s-126.24-11.4-172.07-32.09C40.76 444.41 16 418.2 16 392c0-22.99 18.31-41.17 33.67-52.38 19.51-14.24 46.21-26.25 77.85-35.12C104.1 319.98 91.4 339.3 91.4 360c0 24.53 17.84 47.15 50.23 63.69C172.31 439.37 212.93 448 256 448s83.69-8.63 114.37-24.31c32.39-16.54 50.23-39.16 50.23-63.69 0-20.7-12.7-40.02-36.12-55.5 31.64 8.87 58.34 20.88 77.85 35.12C477.69 350.83 496 369.01 496 392" fill="#b9d457" opacity="1" data-original="#b9d457" class=""></path><path d="M404.6 360c0 18.21-14.74 35.77-41.51 49.44C334.62 423.99 296.59 432 256 432s-78.62-8.01-107.09-22.56c-26.77-13.67-41.51-31.23-41.51-49.44 0-16.62 12.27-32.69 34.76-45.76 21.92 40.65 64.73 68.31 113.84 68.31s91.92-27.66 113.84-68.31c22.49 13.07 34.76 29.14 34.76 45.76" fill="#b9d457" opacity="1" data-original="#b9d457" class=""></path><path d="M355.05 196.75c-.07-.13-.14-.25-.2-.38L256 24.08l-98.85 172.29c-.06.13-.13.25-.2.38-9.4 16.93-14.37 36.16-14.37 55.62 0 62.96 50.88 114.18 113.42 114.18s113.42-51.22 113.42-114.18c0-19.46-4.97-38.69-14.37-55.62m-49.17-37.5c3.84-2.2 8.73-.87 10.93 2.96l11.77 20.52c2.2 3.83.88 8.72-2.96 10.92a8.001 8.001 0 0 1-10.92-2.96l-11.77-20.52a8 8 0 0 1 2.95-10.92m-6.07 180.8c-1.16.59-2.4.88-3.62.88-2.92 0-5.73-1.6-7.14-4.38-2-3.93-.44-8.75 3.5-10.76 27.68-14.09 44.87-42.23 44.87-73.42 0-11.8-2.58-23.69-7.47-34.38a8.02 8.02 0 0 1 3.96-10.61 8.007 8.007 0 0 1 10.6 3.96c5.83 12.77 8.91 26.96 8.91 41.03 0 37.24-20.54 70.84-53.61 87.68M439.65 84.61a47.05 47.05 0 0 0-25.92 26.12c-4.72-11.84-14.13-21.32-25.93-26.12 11.8-4.79 21.21-14.27 25.93-26.12 4.71 11.85 14.12 21.33 25.92 26.12M86.23 207.37a40.57 40.57 0 0 0-18.36 18.48c-3.92-8-10.4-14.52-18.37-18.48a40.64 40.64 0 0 0 18.37-18.48c3.91 8 10.39 14.52 18.36 18.48" fill="#b9d457" opacity="1" data-original="#b9d457" class=""></path></g></svg>
                </i>
                <h3>Made fresh daily</h3>
                <small>Never pre-cooked. Always fresh.</small>
            </span>
            <span>
                <i class="nv-proof-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M31.531 53.515a6.2 6.2 0 0 0 3.091-.84l17.796-10.49c.518-.308.841-.877.841-1.484a1.728 1.728 0 0 0-2.45-1.584l-.788.357-7.863 3.617-5.093 2.336a4 4 0 0 1-.407.524c-.744.727-1.671 1.108-2.646 1.108H23.567a1 1 0 0 1 0-2h10.445c.449 0 .881-.18 1.215-.506a1.4 1.4 0 0 0 .251-.355c.006-.012.018-.022.025-.034l.002-.006q.21-.383.21-.803v-.004c-.005-.028.005-.055.003-.083-.002-.025-.015-.047-.015-.073h.015c-.003-.015-.013-.028-.015-.043h-.001v-.003q-.002-.005-.003-.01a1.71 1.71 0 0 0-1.688-1.487h-9.519a3.73 3.73 0 0 1-2.621-1.083 8 8 0 0 0-2.597-1.731 8.1 8.1 0 0 0-3.115-.629h-.79c-.581 0-1.139.048-1.659.144a9.9 9.9 0 0 0-5.412 2.785l-4.3 4.289v12.286l2.557-2.136a8.83 8.83 0 0 1 5.678-2.06h19.298zM33.099 15.024v.002a20.85 20.85 0 0 0-3.14 11.026v4.294l17.131-17.13a.999.999 0 1 1 1.414 1.414L31.378 31.757h7.72C50.623 31.757 60 22.39 60 10.876V5.151h-9.139c-7.262 0-13.902 3.691-17.762 9.873M11.139 9.586v4.684c0 9.413 7.484 17.112 16.82 17.474v-5.691q0-.779.054-1.552c.012-.174.035-.347.051-.521.031-.34.061-.68.106-1.017.028-.206.067-.409.101-.613.049-.303.097-.606.159-.907.044-.216.099-.429.149-.643.067-.285.133-.57.211-.852.061-.22.13-.437.198-.655.084-.272.168-.544.262-.813q.117-.328.244-.652.15-.394.314-.783a22 22 0 0 1 .289-.642 22 22 0 0 1 .698-1.379c.07-.127.132-.258.204-.383a17.44 17.44 0 0 0-12.283-5.055z" fill="#b9d457" opacity="1" data-original="#b9d457" class=""></path></g></svg>
                </i>
                <h3>Quality ingredients</h3>
                <small>Real ingredients. Real flavor.</small>
            </span>
            <span>
                <i class="nv-proof-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M54.234 34.472c-.112-.014-43.17.01-43.321 0H8.559c-1.04 11.225 7.181 21.213 18.664 21.214h9.643A18.68 18.68 0 0 0 55.53 37.024v-2.551zM27.223 57.76a20.5 20.5 0 0 1-5.786-.83v1.193A1.876 1.876 0 0 0 23.314 60h17.46a1.876 1.876 0 0 0 1.878-1.877v-1.192c-3.59 1.291-11.584.713-15.43.83M46.934 28.945a1.06 1.06 0 0 1-1.13-.808c-.638-3.228-5.435-4.59-8.741-3.474a1.04 1.04 0 0 1-.726-.3c-2.6-2.66-8.714-2.186-10.452 1.026a1.05 1.05 0 0 1-.891.518c-3.197-.394-6.94 1.79-6.823 4.573a1.02 1.02 0 0 1-.456.86 1 1 0 0 1-.685.177 7.4 7.4 0 0 0-3.484.881h39.35c-.695-1.98-3.121-3.453-5.962-3.453M23.466 15.866a1.037 1.037 0 0 0 1.628 1.286 5.3 5.3 0 0 0-.237-6.862 3.22 3.22 0 0 1 .153-4.499A1.037 1.037 0 0 0 23.57 4.3a5.29 5.29 0 0 0-.243 7.39 3.226 3.226 0 0 1 .14 4.177M31.433 15.866a1.037 1.037 0 0 0 1.628 1.286 5.296 5.296 0 0 0-.236-6.862 3.22 3.22 0 0 1 .152-4.499A1.037 1.037 0 0 0 31.538 4.3a5.287 5.287 0 0 0-.244 7.39 3.225 3.225 0 0 1 .14 4.177M39.4 15.866a1.037 1.037 0 0 0 1.628 1.286 5.3 5.3 0 0 0-.236-6.862 3.22 3.22 0 0 1 .152-4.499A1.037 1.037 0 0 0 39.505 4.3a5.287 5.287 0 0 0-.245 7.39 3.225 3.225 0 0 1 .14 4.177" fill="#b9d457" opacity="1" data-original="#b9d457" class=""></path></g></svg>
                </i>
                <h3>Made your way</h3>
                <small>Customize every bite.</small>
            </span>
        </div>
      </div>
   </section>
   <section class="nv-feels" aria-labelledby="nv-feels-title">
      <div class="nv-feels__wave"></div>
      <div class="nv-shell nv-feels__stage">
         <div class="nv-feels__copy" data-nv-reveal>
            <p class="nv-eyebrow">THE GOOD STUFF</p>
            <h2 id="nv-feels-title">FOOD THAT<br><span>FEELS GOOD.</span></h2>
            <p>Bright, fresh, filling and completely yours. We prep daily so every bite hits different—in the best way.</p>
         </div>
         <div class="nv-burrito-pal" data-nv-reveal aria-label="A playful standing burrito character that follows your pointer"><span class="nv-burrito-arm nv-burrito-arm--left"></span><img src="<?php echo $asset( 'wrapped-burrito.png.webp' ); ?>" alt="Standing Uberrito burrito character" width="900" height="452"><span class="nv-character-eyes"><i class="nv-eye"><b></b></i><i class="nv-eye"><b></b></i></span><span class="nv-burrito-smile"></span><span class="nv-burrito-arm nv-burrito-arm--right"></span><span class="nv-burrito-leg nv-burrito-leg--left"></span><span class="nv-burrito-leg nv-burrito-leg--right"></span><span class="nv-orbit-tag nv-orbit-tag--one">Fresh daily</span><span class="nv-orbit-tag nv-orbit-tag--two">Big flavor</span><span class="nv-orbit-tag nv-orbit-tag--three">Your way</span></div>
      </div>
   </section>
   <section id="locations" class="nv-flight" aria-labelledby="nv-flight-title">
      <div class="nv-flight__sticky">
         <div class="nv-shell nv-flight__heading" data-nv-reveal>
            <p class="nv-eyebrow">TEXAS, TWO WAYS</p>
            <h2 id="nv-flight-title">FRESH FLAVOR<br><span>HAS LANDED.</span></h2>
         </div>
         <svg class="nv-flight__path" viewBox="0 0 1400 620" role="img" aria-label="Route from Atascocita to Sugar Land">
            <path id="nv-flight-path" d="M80 480 C300 80 540 90 700 310 S1090 610 1320 150" fill="none" stroke="currentColor" stroke-width="6" stroke-linecap="round" stroke-dasharray="18 22"/>
         </svg>
         <div class="nv-plane" aria-hidden="true">✈</div>
         <article class="nv-location-card nv-location-card--one" data-nv-reveal>
            <span>01</span><img src="<?php echo $asset( 'uberrito-atascocita-exterior.jpeg' ); ?>" alt="Uberrito Atascocita exterior" width="1200" height="1063" loading="lazy">
            <div>
               <h3>Atascocita</h3>
               <p>19350 W Lake Houston Pkwy<br>Humble, TX 77346</p>
               <a href="<?php echo esc_url( $locations_url ); ?>">Get directions →</a>
            </div>
         </article>
         <article class="nv-location-card nv-location-card--two" data-nv-reveal>
            <span>02</span><img src="<?php echo $asset( 'uberrito-restaurant-interior.jpeg' ); ?>" alt="Inside Uberrito Sugar Land" width="1536" height="1022" loading="lazy">
            <div>
               <h3>Sugar Land</h3>
               <p>15445 SW Fwy, Suite 500<br>Sugar Land, TX 77478</p>
               <a href="<?php echo esc_url( $locations_url ); ?>">Get directions →</a>
            </div>
         </article>
      </div>
   </section>
   <section id="catering" class="nv-catering" aria-labelledby="nv-catering-title">
      <div class="nv-catering__copy" data-nv-reveal>
         <p class="nv-eyebrow">FEED THE WHOLE GROUP CHAT</p>
         <h2 id="nv-catering-title">CATER WITH<br><span>UBERRITO.</span></h2>
         <p>Corporate events, parties, game days or just because. We’ve got you.</p>
         <a class="nv-pill nv-pill--green nv-magnetic" href="<?php echo esc_url( $catering_url ); ?>">Cater now <span>→</span></a>
         <div class="nv-clippy nv-clippy--catering" aria-hidden="true"><span class="nv-clippy__bubble">Need lunch for the whole crew? I got you!</span><img src="<?php echo $asset( 'wrapped-burrito.png.webp' ); ?>" alt=""><span class="nv-clippy__eyes"><i></i><i></i></span></div>
      </div>
      <div class="nv-catering__visual" data-nv-reveal><img src="<?php echo $plugin_asset( 'catering-spread.webp' ); ?>" alt="Uberrito catering spread with fresh trays and sides" width="1672" height="941" loading="lazy"><span>Office lunch?</span><span>Game day?</span><span>We got you.</span></div>
   </section>
   <section id="merch" class="nv-merch" aria-labelledby="nv-merch-title">
      <div class="nv-shell nv-merch__layout">
         <div class="nv-merch__copy" data-nv-reveal>
            <p class="nv-eyebrow">OFFICIAL MERCH · LIMITED DROPS</p>
            <h2 id="nv-merch-title">WEAR THE<br><span>UBERRITO</span><br>LIFESTYLE.</h2>
            <p>Premium apparel, drinkware and everyday essentials designed for true Uberrito fans.</p>
            <a class="nv-pill nv-pill--green nv-magnetic" href="#bottom-nav">Shop merch <span>→</span></a>
         </div>
         <div class="nv-merch__art nv-parallax" data-depth="14" data-nv-reveal>
            <img class="nv-merch__collection" src="<?php echo $asset( 'merch-official.webp' ); ?>" alt="Official Uberrito merchandise" width="1024" height="1024" loading="lazy"><img class="nv-merch__cup" src="<?php echo $plugin_asset( 'uberrito-cup.png' ); ?>" alt="Uberrito Above and Beyond Burrito cup" width="511" height="1080" loading="lazy">
            <div>DROP<br><b>001</b></div>
            <div class="nv-clippy nv-clippy--merch" aria-hidden="true"><span class="nv-clippy__bubble">Fresh fit. Zero boring merch.</span><span class="nv-clippy__hoodie"></span><img src="<?php echo $asset( 'wrapped-burrito.png.webp' ); ?>" alt=""><span class="nv-clippy__cap"></span><span class="nv-clippy__eyes"><i></i><i></i></span></div>
         </div>
      </div>
   </section>
   <section id="rewards" class="nv-reward-ribbon" aria-label="Uberrito rewards">
      <div class="nv-shell">
         <div>
            <p>NÜ REWARDS · NEW MEMBER BONUS</p>
            <h2>EAT. EARN. <span>EAT FREE.</span></h2>
            <strong>Join today and get enough bonus points for a FREE side.</strong>
         </div>
         <a class="nv-face-button nv-face-button--small nv-magnetic" href="<?php echo esc_url( $rewards_url ); ?>"><span class="nv-eye"><i></i></span><span class="nv-eye"><i></i></span><b>JOIN<br>FREE</b></a>
      </div>
   </section>
   <section id="bottom-nav" class="nv-bottom-nav" aria-labelledby="nv-bottom-title">
      <div class="nv-bottom-preview" aria-hidden="true"><img src="<?php echo $asset( 'burrito.webp' ); ?>" alt=""></div>
      <div class="nv-shell">
         <p class="nv-eyebrow">PICK YOUR NEXT MOVE</p>
         <h2 id="nv-bottom-title" class="screen-reader-text">Explore Uberrito</h2>
         <nav aria-label="Explore Uberrito"><a href="<?php echo esc_url( $order_url ); ?>" data-preview="burrito.webp"><span>01</span>Order now <b>↗</b></a><a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" data-preview="Bowl-1.webp"><span>02</span>View menu <b>↗</b></a><a href="https://www.instagram.com/uberrito/" data-preview="tacos.webp"><span>03</span>Follow us <b>↗</b></a><a href="<?php echo esc_url( $rewards_url ); ?>" data-preview="rewards-burritos.webp"><span>04</span>Rewards <b>↗</b></a><a href="<?php echo esc_url( $catering_url ); ?>" data-preview="uberrito-loaded-nachos-wide.png"><span>05</span>Catering <b>↗</b></a><a href="<?php echo esc_url( $locations_url ); ?>" data-preview="uberrito-atascocita-exterior.jpeg"><span>06</span>Locations <b>↗</b></a><a href="<?php echo esc_url( $locations_url ); ?>"><span>07</span>Leave a review <b>↗</b></a><a href="https://apps.apple.com/us/app/%C3%BCberrito-fresh-mex/id1569506904"><span>08</span>Download app <b>↗</b></a></nav>
      </div>
   </section>
   <footer class="nv-footer">
      <div class="nv-ninja-stage" aria-hidden="true">
         <div class="nv-slash-trail"></div>
         <?php foreach ( array( 'wrapped-burrito.png.webp', 'uberrito-chips-guacamole.png', 'Fajita-Steak.webp', 'lime-slices.png.webp', 'nachos.webp' ) as $index => $food ) : ?><span class="nv-ninja-item nv-ninja-item--<?php echo esc_attr( (string) ( $index + 1 ) ); ?>" data-ninja-item><i class="nv-ninja-half nv-ninja-half--left" style="--food:url('<?php echo $asset( $food ); ?>')"></i><i class="nv-ninja-half nv-ninja-half--right" style="--food:url('<?php echo $asset( $food ); ?>')"></i></span><?php endforeach; ?>
      </div>
      <div class="nv-shell nv-footer__top">
         <p>Fresh ingredients · bold flavor · made daily</p>
         <p>Atascocita · Sugar Land</p>
      </div>
      <div class="nv-footer__word" aria-label="Uberrito"><img src="<?php echo $asset( 'uberrito-white-logo.png' ); ?>" alt="Uberrito Fresh Mex" width="854" height="155"></div>
      <div class="nv-shell nv-footer__base">
         <p>© <?php echo esc_html( gmdate( 'Y' ) ); ?> Uberrito</p>
         <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a><a href="<?php echo esc_url( $order_url ); ?>">Order now ↗</a>
      </div>
   </footer>
</main>
<?php wp_footer(); ?>
</body>
</html>
