<?php
/**
 * Plugin Name:       Überrito Effects
 * Description:       Site-wide front-end motion for the Überrito site: a branded
 *                    page-curtain load/navigation transition and a staggered
 *                    reveal for the full-screen mobile menu links. Pure CSS/JS,
 *                    respects prefers-reduced-motion. No settings, no data.
 * Version:           1.0.0
 * Author:            Überrito Web
 * License:           GPL-2.0-or-later
 * Text Domain:       uberrito-effects
 *
 * @package UberritoEffects
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

/**
 * Brand tokens. Kept as constants so the palette lives in one place.
 */
const UBR_FX_GREEN         = '#1F4D2C'; // Forest green.
const UBR_FX_GREEN_DEEP    = '#12351d'; // Darker green (gradient end).
const UBR_FX_ORANGE        = '#EC5A2A'; // Überrito orange (glow / accents).
const UBR_FX_LOGO_FALLBACK = '/wp-content/uploads/2026/07/uberrito-horz-1.png';

/**
 * Print the curtain + menu-reveal CSS in <head>.
 */
function ubr_fx_css() {
	$green  = UBR_FX_GREEN;
	$deep   = UBR_FX_GREEN_DEEP;
	$orange = UBR_FX_ORANGE;
	?>
<style id="ubr-fx-css">
/* ---- Page curtain --------------------------------------------------- */
#ubr-curtain{
	position:fixed; inset:0; z-index:99999; pointer-events:none;
	background:linear-gradient(160deg, <?php echo esc_attr( $green ); ?> 0%, <?php echo esc_attr( $deep ); ?> 100%);
	display:flex; align-items:center; justify-content:center;
}
#ubr-curtain.is-revealing{ animation:ubrCurtUp .58s cubic-bezier(.65,0,.35,1) .55s forwards; }
#ubr-curtain.is-leaving  { display:flex; animation:ubrCurtDown .42s cubic-bezier(.65,0,.35,1) forwards; }
#ubr-curtain.is-done     { display:none; }
#ubr-curtain img{
	width:min(46vw,240px); height:auto; opacity:0; transform:scale(.82);
	filter:drop-shadow(0 0 34px <?php echo esc_attr( $orange ); ?>73); /* orange glow */
	animation:ubrCurtBeat .9s cubic-bezier(.3,.6,.35,1) forwards;
}
#ubr-curtain.is-leaving img{ animation:ubrCurtLogoOut .3s ease-out forwards; }
@keyframes ubrCurtBeat{ 0%{opacity:0;transform:scale(.82)} 55%{opacity:1;transform:scale(1.06)} 75%{transform:scale(.97)} 100%{opacity:1;transform:scale(1)} }
@keyframes ubrCurtLogoOut{ to{opacity:0;transform:scale(.9)} }
@keyframes ubrCurtUp{ to{transform:translateY(-100%)} }
@keyframes ubrCurtDown{ from{transform:translateY(-100%)} to{transform:translateY(0)} }

/* ---- Staggered reveal for the full-screen menu links ---------------- */
@keyframes ubrNavIn{ from{opacity:0; transform:translateY(-8px)} to{opacity:1; transform:translateY(0)} }
#ubrMenu.ubr-fx-open .ubr-menu__links a{ animation:ubrNavIn .34s cubic-bezier(.22,1,.36,1) both; }
#ubrMenu.ubr-fx-open .ubr-menu__links a:nth-child(1){ animation-delay:.05s; }
#ubrMenu.ubr-fx-open .ubr-menu__links a:nth-child(2){ animation-delay:.10s; }
#ubrMenu.ubr-fx-open .ubr-menu__links a:nth-child(3){ animation-delay:.15s; }
#ubrMenu.ubr-fx-open .ubr-menu__links a:nth-child(4){ animation-delay:.20s; }
#ubrMenu.ubr-fx-open .ubr-menu__links a:nth-child(5){ animation-delay:.25s; }
#ubrMenu.ubr-fx-open .ubr-menu__links a:nth-child(6){ animation-delay:.30s; }
#ubrMenu.ubr-fx-open .ubr-menu__links a:nth-child(n+7){ animation-delay:.34s; }

@media (prefers-reduced-motion: reduce){
	#ubr-curtain, #ubr-curtain img{ animation:none !important; display:none !important; }
	#ubrMenu.ubr-fx-open .ubr-menu__links a{ animation:none !important; }
}
</style>
	<?php
}
add_action( 'wp_head', 'ubr_fx_css', 99 );

/**
 * Print the curtain + menu-reveal JS before </body>.
 */
function ubr_fx_js() {
	?>
<script id="ubr-fx-js">
(function () {
	'use strict';
	if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

	/* ---- Page curtain ---- */
	var LOGO_URL = '';
	var found = document.querySelector('header img[src*="logo" i], img[src*="uberrito-horz" i], .site-logo img, img.logo');
	if (found) { LOGO_URL = found.currentSrc || found.getAttribute('data-src') || found.src; }
	if (!LOGO_URL) { LOGO_URL = '<?php echo esc_js( UBR_FX_LOGO_FALLBACK ); ?>'; }

	var c = document.createElement('div'); c.id = 'ubr-curtain';
	var img = document.createElement('img'); img.alt = ''; if (LOGO_URL) img.src = LOGO_URL;
	c.appendChild(img);
	document.documentElement.appendChild(c);

	function done(){ c.classList.add('is-done'); }
	requestAnimationFrame(function(){ c.classList.add('is-revealing'); });
	c.addEventListener('animationend', function (e){
		if (e.target === c && c.classList.contains('is-revealing')) done();
	});
	setTimeout(done, 2200); // safety net

	window.addEventListener('pageshow', function (e){
		if (e.persisted){ c.classList.remove('is-leaving'); c.classList.add('is-revealing','is-done'); }
	});

	document.addEventListener('click', function (e){
		if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
		var a = e.target.closest && e.target.closest('a[href]');
		if (!a) return;
		if (a.target && a.target !== '_self') return;
		if (a.hasAttribute('download')) return;
		var href = a.getAttribute('href');
		if (!href || href.charAt(0) === '#') return;
		if (/^(tel:|mailto:|javascript:)/i.test(href)) return;
		var url; try { url = new URL(href, location.href); } catch (err) { return; }
		if (url.origin !== location.origin) return;
		if (url.href === location.href) return;
		e.preventDefault();
		c.classList.remove('is-revealing','is-done'); c.classList.add('is-leaving');
		setTimeout(function(){ location.href = url.href; }, 460);
	});

	/* ---- Staggered menu reveal: wrap the theme's ubrMenu(open) toggle ---- */
	function hook(){
		if (typeof window.ubrMenu !== 'function') return false;
		var orig = window.ubrMenu;
		window.ubrMenu = function (open){
			try { orig.apply(this, arguments); } catch (err) {}
			var m = document.getElementById('ubrMenu');
			if (m) m.classList.toggle('ubr-fx-open', !!open);
			return undefined;
		};
		return true;
	}
	if (!hook()) {
		// ubrMenu may be defined later; retry briefly.
		var tries = 0, t = setInterval(function(){ if (hook() || ++tries > 40) clearInterval(t); }, 100);
	}
})();
</script>
	<?php
}
add_action( 'wp_footer', 'ubr_fx_js', 99 );
