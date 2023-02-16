<?php

namespace App\View\Composers\Partials;
use Roots\Acorn\View\Composer;

class Socials extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'partials.socials'
	];

	/**
	 * Data to be passed to view before rendering.
	 *
	 * @return array
	 */
	public function with()
	{
		return [
			'socials' => $this->socials()
		];
	}

	/**
	 * Returns the primary navigation.
	 *
	 * @return object
	 */
	public function socials()
	{
		$socials = get_field('socials', 'option');

		return \App\arr_to_obj($socials);
	}
}