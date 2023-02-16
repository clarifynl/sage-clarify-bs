<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Page extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'partials.page-content'
	];

	/**
	 * Data to be passed to view before rendering, but after merging.
	 *
	 * @return array
	 */
	public function override() {
		$id = $this->data['page'] ?? get_the_ID();

		return [
			'image'   => get_post_thumbnail_id($id) ?: null,
			'title'   => get_the_title($id) ?: null,
			'content' => get_the_content($id) ?: null
		];
	}
}
