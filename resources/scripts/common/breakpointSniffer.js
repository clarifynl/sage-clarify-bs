import sassToJs from 'sass-to-js/js/dist/sass-to-js.min';

export default new class
{
	constructor() {
		const snifferContent = sassToJs(
			document.querySelector('.js-breakpoint-sniffer'),
			{
				pseudoEl: '::after',
				cssProperty: 'content'
			}
		);

		this.breakpoints = Object.entries(snifferContent).map(([key, value]) => [key, parseInt(value, 10)]);
		this.keys = Object.keys(snifferContent);
		this.current = null;
		this.previous = null;
		this.observer = null;
		this.changeCallbacks = [];
		this.callbacks = [];

		this.startObserver();
	}

	startObserver() {
		this.observer = new ResizeObserver(entries => {
			entries.forEach(entry => {
				let currentBreakpoint = null;

				this.breakpoints.some(([breakpoint, width]) => {
					if (width > entry.contentRect.width) {
						return true;
					}

					currentBreakpoint = breakpoint;

					return false;
				});

				if (this.current !== currentBreakpoint) {
					this.previous = this.current;
					this.current = currentBreakpoint;
					this.applyChange();

					if (!this.previous || this.isBigger(this.current, this.previous)) {
						this.apply('down', currentBreakpoint);
					}

					if (!this.previous || this.isSmaller(this.current, this.previous)) {
						this.apply('up', currentBreakpoint);
					}
				}
			});
		});

		this.observer.observe(document.body);
	}

	applyChange() {
		this.changeCallbacks.forEach(callback => callback(this.current));
	}

	onChange(callback) {
		callback(this.current);
		this.changeCallbacks.push(callback);
	}

	isSmaller(a, b = this.current) {
		if (a == null || b == null) return true;

		return this.keys.indexOf(a) >= this.keys.indexOf(b);
	}

	isBigger(a, b = this.current) {
		if (a == null || b == null) return true;

		return this.keys.indexOf(a) <= this.keys.indexOf(b);
	}

	apply(type, currentBreakpoint) {
		this.callbacks.forEach(([callbackType, breakpoint, callback]) => {
			if (type === callbackType && breakpoint === currentBreakpoint) {
				callback(this.current);
			}
		})
	}

	onDown(breakpoint, callback) {
		if (this.isSmaller(breakpoint)) {
			callback(this.current);
		}

		this.callbacks.push(['down', breakpoint, callback]);
	}

	onUp(breakpoint, callback) {
		if (this.isBigger(breakpoint)) {
			callback(this.current);
		}

		this.callbacks.push(['up', breakpoint, callback]);
	}
}