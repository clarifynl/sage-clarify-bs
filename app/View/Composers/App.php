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
			'home_url'  => home_url('/'),
			'site_name' => get_bloginfo('name', 'display'),
			'site_desc' => get_bloginfo('description'),
			'site_logo' => asset('images/logo-placeholder.svg')->contents(),
			'title'     => $this->title()
		];
	}

	/**
	 * Returns the post title.
	 *
	 * @return string
	 */
	public function title()
	{
		if (is_home()) {
			if ($home = get_option('page_for_posts', true)) {
				return get_the_title($home);
			}

			return __('Latest Posts', 'sage');
		}

		if (is_archive()) {
			return get_the_archive_title();
		}

		if (is_search()) {
			return sprintf(
				/* translators: %s is replaced with the search query */
				__('Search Results for %s', 'sage'),
				get_search_query()
			);
		}

		if (is_404()) {
			return __('Not Found', 'sage');
		}

		return get_the_title();
	}
}