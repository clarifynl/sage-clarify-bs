<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Page extends Composer {

	protected static $views = [
		'partials.page-content'
	];

	public function override() {
		$id = $this->data['page'] ?? get_the_ID();

		return [
			'featured_image' => is_front_page() ? false : $this->image($id),
			'title'          => get_the_title($id),
			'content'        => get_the_content($id)
		];
	}

	public function image($id) {
		$image = get_post_thumbnail_id($id);

		return $image;
	}

}
