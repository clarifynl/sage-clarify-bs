import {getCookie, setCookie} from '@scripts/utils/cookies';

class Cookiebar
{
	/**
	 * Construct class
	 */
	constructor({selector, link} = {}) {
		this.cookiebar   = document.querySelector(selector);
		this.cookielink  = document.querySelector(link);
		this.cookieValue = getCookie('cookie_consent');
		this.content     = null;
		this.expiration  = null;
		this.btns1       = null;
		this.btns2       = null;
		this.settings    = null;
		this.accept      = null;
		this.cancel      = null;
		this.save        = null;
		this.types       = null;

		if (this.cookiebar) {
			this.expiration   = parseInt(this.cookiebar.dataset.cookieExpiration, 10) || 365;
			this.content      = this.cookiebar.querySelector('.js-consent-text');
			this.types        = this.cookiebar.querySelector('.js-consent-types');
			this.btns1        = this.cookiebar.querySelector('.js-consent-btns1');
			this.btns2        = this.cookiebar.querySelector('.js-consent-btns2');
			this.settings     = this.cookiebar.querySelector('.js-consent-settings');
			this.accept       = this.cookiebar.querySelector('.js-consent-accept');
			this.cancel       = this.cookiebar.querySelector('.js-consent-cancel');
			this.save         = this.cookiebar.querySelector('.js-consent-save');
			this.consentTypes = this.cookiebar.querySelectorAll('input[type="checkbox"]');
		} else {
			this.cookielink.style.display = 'none';
		}
	}

	/**
	 * Init buttons & bar
	 */
	init() {
		this.initButtons();
		this.initBar();
	}

	/**
	 * Set selection based upon cookie value
	 */
	applyCookie() {
		const selection = JSON.parse(this.cookieValue);

		if (selection) {
			Array.from(this.consentTypes)
				.filter(type => !type.disabled)
				.forEach(type => {
					const checked = selection.indexOf(type.value) > -1;

					type.checked = checked;
				});
		}
	}

	/**
	 * Push GTM event when cookie value has changed
	 */
	pushSettings(newConsent) {
		if (this.cookieValue !== newConsent) {
			const {
				gtm_id: gtmId,
				is_admin: isAdmin,
				wp_env: wpEnv
			} = window.wordpress;

			if (!gtmId) {
				return;
			}

			// This will trigger the 'Google Consent Mode' tag
			if (wpEnv === 'production' && !isAdmin) {
				window.dataLayer = window.dataLayer || [];
				window.dataLayer.push({
					'event': 'consentSelected',
					'consentPrev': this.cookieValue,
					'consentNew': newConsent
				});

				// Triggers after updating built-in consent modes
				window.dataLayer.push({
					'event': 'consentUpdate'
				});
			} else {
				console.log(`Google Tag Manager event: consent selected: ${JSON.stringify(newConsent)}`);
			}
		}
	}

	/**
	 * open cookie bar settings
	 */
	openSettings(e) {
		e.preventDefault();
		this.btns1.classList.remove('hidden');
		this.btns2.classList.add('hidden');
		this.content.classList.add('hidden');
		this.types.classList.remove('hidden');
		this.cookiebar.classList.remove('hidden');

		this.cancel.addEventListener('click', () => {
			this.cookiebar.classList.add('hidden');
		});
	}

	/**
	 * Show cookie bar settings
	 */
	toggleSettings(e) {
		e.preventDefault();

		if (this.types.classList.contains('hidden')) {
			this.btns1.classList.remove('hidden');
			this.btns2.classList.add('hidden');
			this.content.classList.add('hidden');
			this.types.classList.remove('hidden');
		} else {
			this.btns1.classList.add('hidden');
			this.btns2.classList.remove('hidden');
			this.content.classList.remove('hidden');
			this.types.classList.add('hidden');
		}
	}

	/**
	 * Save cookie consent settings
	 */
	saveCookieConsent(selection) {
		setCookie('cookie_consent', JSON.stringify(selection), this.expiration);
		this.pushSettings(selection);
		this.cookieValue = JSON.stringify(selection);
		this.cookiebar.classList.add('hidden');
	}

	/**
	 * Accept all settings
	 */
	acceptAll() {
		const selection = [];

		Array.from(this.consentTypes)
			.forEach(type => {
				selection.push(type.value);
			});

		this.saveCookieConsent(selection);
	}

	/**
	 * Save cookie bar settings
	 */
	saveSettings() {
		const selection = [];

		Array.from(this.consentTypes)
			.filter(type => !type.disabled && type.checked)
			.forEach(type => {
				selection.push(type.value);
			});

		this.saveCookieConsent(selection);
	}

	/**
	 * Show cookie bar when cookie is (not) set
	 */
	initButtons() {
		this.settings.addEventListener('click', this.toggleSettings.bind(this));
		this.accept.addEventListener('click', this.acceptAll.bind(this));

		this.cancel.addEventListener('click', this.toggleSettings.bind(this));
		this.save.addEventListener('click', this.saveSettings.bind(this));

		this.cookielink.addEventListener('click', this.openSettings.bind(this));
	}

	/**
	 * Show cookie bar when cookie is (not) set
	 */
	initBar() {
		if (this.cookieValue) {
			this.applyCookie();
		} else {
			this.cookiebar.classList.remove('hidden');
		}
	}
}

export default Cookiebar;