<?php

namespace App\View\Composers\Modules;
use Roots\Acorn\View\Composer;

class Carousel extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'modules.m-carousel'
	];

	/**
	 * Data to be passed to view before rendering, but after merging.
	 *
	 * @return array
	 */
	public function with() {
		$data = $this->data->module['module_carousel'];

		return [
			'slides' => $this->slides($data)
		];
	}

	/**
	 * Returns slide repeater
	 */
	public function slides($data) {
		$slides = $data['slides'];

		foreach ($slides as $slide) {
			// alter data
		}

		return \App\arr_to_obj($slides);
	}
}
