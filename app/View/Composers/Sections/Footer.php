<?php

namespace App\View\Composers\Sections;
use Roots\Acorn\View\Composer;

class Footer extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'sections.footer'
	];

	/**
	 * Data to be passed to view before rendering.
	 *
	 * @return array
	 */
	public function with() {
		return [
			'footer' => $this->footer()
		];
	}

	/**
	 * Returns the primary navigation.
	 *
	 * @return array
	 */
	public function footer() {
		$footer = get_field('footer', 'option') ?: [];

		return \App\arr_to_obj($footer);
	}
}