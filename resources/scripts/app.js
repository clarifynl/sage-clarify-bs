import 'lazysizes';
import '@lottiefiles/lottie-player';
import '@scripts/utils/faIcons';
import domReady from '@roots/sage/client/dom-ready';
import LottieInteractive from '@scripts/common/lottieInteractive';

/**
 * Application entrypoint
 */
domReady(async () => {
	const lottie = new LottieInteractive({selector: '[data-lottie-mode]'});

	lottie.init();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
import.meta.webpackHot?.accept(console.error);
