<?php

namespace App\View\Composers\Sections;
use Roots\Acorn\View\Composer;

class CookieConsent extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'sections.cookie-bar'
	];

	/**
	 * Data to be passed to view before rendering.
	 *
	 * @return array
	 */
	public function with() {
		return [
			'cookie_bar'    => $this->cookie_bar(),
			'consent_types' => $this->consent_types()
		];
	}

	/**
	 * Returns the cookie bar options
	 *
	 * @return object
	 */
	public function cookie_bar() {
		$cookie_bar = get_field('cookie_bar', 'option') ?: [];

		return \App\arr_to_obj($cookie_bar);
	}

	/**
	 * Returns the cookie consent types
	 *
	 * @return object
	 */
	public function consent_types() {
		$consent_types = get_field('consent_types', 'option') ?: [];

		return \App\arr_to_obj($consent_types);
	}
}