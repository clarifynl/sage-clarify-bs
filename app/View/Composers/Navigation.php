<?php

namespace App\View\Composers;
use Roots\Acorn\View\Composer;
use Log1x\Navi\Navi;

class Navigation extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'partials.navigation'
	];

	/**
	 * Data to be passed to view before rendering.
	 *
	 * @return array
	 */
	public function with() {
		return [
			'navigation' => $this->navigation()
		];
	}

	/**
	 * Returns the primary navigation.
	 *
	 * @return array
	 */
	public function navigation() {
		$menu = $this->data['nav_menu'] ?: 'main_menu';
		$navi = (new Navi())->build($menu);

		if ($navi->isEmpty()) {
			return;
		}

		return $navi->toArray();
	}
}