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
			'site_name'    => get_bloginfo('name', 'display'),
			'site_desc'    => get_bloginfo('description'),
			'home_url'     => home_url('/'),
			'site_logo'    => asset('images/qwic-logo.svg')->contents(),
			'site_icon'    => asset('images/qwic-icon.svg')->contents()
		];
	}
}