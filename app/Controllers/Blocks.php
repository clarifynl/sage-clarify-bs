<?php

namespace App\Controllers;

class Blocks
{
	/**
	 * Restrict allowed Gutenberg Blocks
	 */
	public static function set_allowed_block_types($allowed_block_types, $editor_context)
	{
		$allowed_blocks = [
			'core/buttons',
			'core/button',
			'core/embed',
			'core/group',
			'core/heading',
			'core/image',
			'core/list',
			'core/paragraph',
			'core/quote',
			'core/video',
			'acf/media-content',
			'gravityforms/form'
		];

		return $allowed_blocks;
	}

	/**
	 * Register Gutenberg Block Templates
	 */
	public static function register_block_templates()
	{
		// Page
		$page_object   = get_post_type_object('page');
		$post_id       = isset($_GET['post']) ? (int) $_GET['post'] : null;
		$post_type     = get_post_type($post_id);
		$page_template = get_post_meta($post_id, '_wp_page_template', true);
		$front_page_id = (int) get_option('page_on_front');
		$is_front_page = $front_page_id === $post_id;

		// Frontpage
		if ($is_front_page) {
			$page_object->template = [
				['acf/front-header'],
				['sage/inner-blocks']
			];
			$page_object->template_lock = 'all';
		}

		// Default Page
		if (!$is_front_page && (!$page_template || $page_template === 'default')) {
			$page_object->template = [
				['acf/page-header'],
				['sage/inner-blocks']
			];
			$page_object->template_lock = 'all';
		}
	}
}