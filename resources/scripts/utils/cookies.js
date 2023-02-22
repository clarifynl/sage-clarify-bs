/*
 * Set cookie & expiration
 */
export function setCookie(cname, cvalue, exdays = 365) {
	let expires;

	const domain = window.location.hostname;

	if (exdays) {
		const date = new Date();

		date.setTime(Date.now() + (exdays * 24 * 60 * 60 * 1000));
		expires = `expires=${date.toGMTString()}`;
	} else {
		expires = '';
	}

	document.cookie = `${cname}=${cvalue};${expires};path=/;samesite=strict;domain=${domain};`;
}

/*
 * Get cookie value by name
 */
export function getCookie(cname) {
	const name = `${cname}=`;
	const decodedCookie = decodeURIComponent(document.cookie);
	const ca = decodedCookie.split(';');

	for (let i = 0; i < ca.length; i++) {
		let c = ca[i];

		while (c.charAt(0) === ' ') {
			c = c.substring(1);
		}

		if (c.indexOf(name) === 0) {
			return c.substring(name.length, c.length);
		}
	}

	return '';
}

/*
 * Delete cookie by name
 */
export function deleteCookie(cname) {
	setCookie(cname, '', -1);
}