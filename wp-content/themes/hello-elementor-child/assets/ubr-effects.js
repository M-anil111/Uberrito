/* Uberrito front-end effects: branded page curtain + staggered menu reveal.
   Vanilla JS, no dependencies. Skipped entirely under reduced motion. */
(function () {
	'use strict';
	if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

	/* ---- Page curtain ---- */
	var LOGO_URL = '';
	var found = document.querySelector('header img[src*="logo" i], img[src*="uberrito-horz" i], .site-logo img, img.logo');
	if (found) { LOGO_URL = found.currentSrc || found.getAttribute('data-src') || found.src || ''; }
	if (!LOGO_URL && window.UBR_FX_LOGO) { LOGO_URL = window.UBR_FX_LOGO; }

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
		var tries = 0, t = setInterval(function(){ if (hook() || ++tries > 40) clearInterval(t); }, 100);
	}
})();
