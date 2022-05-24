<?php

namespace App\View\Composers;
use Roots\Acorn\View\Composer;

class PageModules extends Composer {
	protected static $views = [
		'partials.page-modules'
	];

	public function with() {
		return [
			'page_modules' => $this->page_modules()
		];
	}

	public function page_modules() {
		$page_modules = get_field('page_modules') ?: null;

		return \App\arr_to_obj($page_modules);
	}
}
