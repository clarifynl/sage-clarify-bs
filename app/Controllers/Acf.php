<?php

namespace App\Controllers;

class Acf
{
	/*
	 * Init ACF options page
	 */
	public static function init_options_page() {

		$option_page = acf_add_options_page([
			'page_title'  => __('Theme Options', 'sage'),
			'menu_title'  => 'Theme Options',
			'menu_slug'   => 'theme-options',
			'capability'  => 'edit_posts',
			'redirect'    => true,
			'icon_url'    => false,
			'position'    => 40,
			'autoload'    => true
		]);

		return $option_page;
	}
}