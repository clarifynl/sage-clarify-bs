<?php

namespace App\View\Composers\Partials;
use Roots\Acorn\View\Composer;

class Error extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'partials.error'
	];

	/**
	 * Data to be passed to view before rendering.
	 *
	 * @return array
	 */
	public function with() {
		return [
			'error' => $this->error()
		];
	}

	/**
	 * Returns the error option.
	 *
	 * @return object
	 */
	public function error() {
		$error = get_field('four_zero_four', 'option');

		return \App\arr_to_obj($error);
	}
}