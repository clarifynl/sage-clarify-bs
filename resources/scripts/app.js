import domReady from '@roots/sage/client/dom-ready';
import 'bootstrap/js/src/util';
import 'bootstrap/js/src/collapse';
import 'bootstrap/js/src/dropdown';
import 'bootstrap/js/src/modal';
import 'bootstrap/js/src/tab';
import 'lazysizes';
import '@lottiefiles/lottie-player';

import '@scripts/utils/faIcons';
import LottieInteractive from '@scripts/common/lottieInteractive';
import CookieBar from '@scripts/sections/cookieBar';

/**
 * Application entrypoint
 */
domReady(async () => {
	const cookieBar = new CookieBar({
		selector: '.js-cookie-bar',
		link: '.js-cookie-settings'
	});

	const lottie = new LottieInteractive({
		selector: '[data-lottie-mode]'
	});

	cookieBar.init();
	lottie.init();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
import.meta.webpackHot?.accept(console.error);
