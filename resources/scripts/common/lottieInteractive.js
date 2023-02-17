import {create} from '@lottiefiles/lottie-interactivity';

class LottieInteractive
{
	constructor({selector} = {}) {
		this.players = document.querySelectorAll(selector);
	}

	/**
	 * Init class
	 */
	init() {
		Array.from(this.players).forEach(player => {
			const id     = player?.id;
			const mode   = player?.dataset?.lottieMode ?? 'scroll';
			const frames = parseInt(player?.dataset?.lottieFrames, 10);
			const type   = player?.dataset?.lottieType;

			let scrollContainer   = '';
			let scrollOffsetStart = 0;
			let scrollOffsetEnd   = 1;
			let scrollLoop        = [];
			let scrollVisibility  = [];

			if (mode === 'scroll') {
				/* eslint-disable padding-line-between-statements */
				switch (type) {
					case 'container':
						scrollContainer = player?.dataset?.lottieScrollContainer;
						break;

					case 'offset':
						scrollOffsetStart = parseFloat(player?.dataset?.lottieScrollOffsetStart) ?? 0;
						scrollOffsetEnd   = parseFloat(player?.dataset?.lottieScrollOffsetEnd) ?? 1;

						break;

					case 'loop':
						scrollLoop = [
							parseInt(player?.dataset?.lottieScrollLoopStart, 10) ?? 0,
							parseInt(player?.dataset?.lottieScrollLoopEnd, 10) ?? frames
						];

						break;

					case 'play':
					case 'playOnce':
					default:
						scrollVisibility = [
							parseFloat(player?.dataset?.lottieScrollVisibilityStart) ?? 0.5,
							parseFloat(player?.dataset?.lottieScrollVisibilityEnd) ?? 1
						];

						break;
				}
				/* eslint-enable padding-line-between-statements */
			}

			this.initPlayer(id, mode, frames, type, {
				scrollContainer,
				scrollOffsetStart,
				scrollOffsetEnd,
				scrollLoop,
				scrollVisibility
			});
		});
	}

	/**
	 * Create Lottie player with config
	 */
	initPlayer(id, mode, frames, type = 'scroll', scrollOptions = {}) {
		let config = {
			mode,
			player: `#${id}`
		};

		if (mode === 'cursor') {
			const cursorConfig = this.constructor.getCursorConfig(frames, type);

			config = {...config, ...cursorConfig};
		} else if (mode === 'scroll') {
			const scrollConfig = this.constructor.getScrollConfig(frames, type, scrollOptions);

			config = {...config, ...scrollConfig};
		}

		create(config);
	}

	/**
	 * Construct Cursor Config
	 */
	static getCursorConfig(frames, type = 'scroll') {
		const config = {};

		if (['hold', 'pauseHold', 'toggle'].includes(type)) {
			config.actions = [{
				type
			}];
		}

		if (['click', 'hover'].includes(type)) {
			config.actions = [{
				type,
				forceFlag: false
			}];
		}

		if (type === 'position') {
			config.actions = [
				{
					position: {
						x: [0, 1],
						y: [0, 1]
					},
					type: 'seek',
					frames: [0, frames]
				}
			];
		}

		if (type === 'movement') {
			config.actions = [
				{
					position: {
						x: [0, 1],
						y: [-1, 2]
					},
					type: 'seek',
					frames: [0, frames]
				}
			];
		}

		return config;
	}

	/**
	 * Construct Scroll Config
	 */
	static getScrollConfig(frames, type = 'scroll', scrollOptions = {}) {
		const config = {};

		if (['scroll', 'container'].includes(type)) {
			config.actions = [{
				visibility: [0, 1.0],
				type      : 'seek',
				frames    : [0, frames]
			}];
		}

		if (type === 'container') {
			config.container = `#${scrollOptions?.scrollContainer}`;
		}

		if (type === 'offset') {
			config.actions = [
				{
					visibility: [0, scrollOptions?.scrollOffsetStart],
					type      : 'stop',
					frames    : [0]
				},
				{
					visibility: [scrollOptions?.scrollOffsetStart, scrollOptions?.scrollOffsetEnd],
					type      : 'seek',
					frames    : [0, frames]
				}
			];
		}

		if (['play', 'playOnce'].includes(type)) {
			config.actions = [{
				visibility: scrollOptions?.scrollVisibility,
				type
			}];
		}

		return config;
	}
}

export default LottieInteractive;