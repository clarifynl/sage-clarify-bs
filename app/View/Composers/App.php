<?php

namespace App\View\Composers;
use Roots\Acorn\View\Composer;
use function Roots\asset;

class App extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'*'
	];

	/**
	 * Data to be passed to view before rendering.
	 *
	 * @return array
	 */
	public function with() {
		return [
			'siteInfo' => $this->siteInfo()
		];
	}

	/**
	 * Returns site info
	 *
	 * @return array
	 */
	public function siteInfo() {
		return (object) [
			'siteName'    => get_bloginfo('name', 'display'),
			'siteDesc'    => get_bloginfo('description'),
			'homeUrl'     => home_url('/'),
			'siteLogo'    => asset('images/qwic-logo.svg')->contents(),
			'siteIcon'    => asset('images/qwic-icon.svg')->contents()
		];
	}
}
