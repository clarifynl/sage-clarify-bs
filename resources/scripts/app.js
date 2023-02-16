import 'lazysizes';
import '@lottiefiles/lottie-player';
import domReady from '@roots/sage/client/dom-ready';
import LottieInteractive from '@scripts/common/lottieInteractive';

/**
 * Application entrypoint
 */
domReady(async () => {
	new LottieInteractive({selector: '[data-lottie-mode]'});
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
import.meta.webpackHot?.accept(console.error);
