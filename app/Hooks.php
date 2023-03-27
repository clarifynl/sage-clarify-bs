<?php

namespace App;

class Hooks
{
	public function __construct() {
		if (!is_admin()) {
			self::add_actions_frontend();
			self::add_filters_frontend();
			self::remove_actions_frontend();
		} else {
			self::add_actions_backend();
			self::add_filters_backend();
			self::remove_actions_backend();
		}

		self::add_ajax_actions();
	}

	private function add_filters_frontend() {
		add_filter('show_admin_bar',                               '__return_false');
		add_filter('login_headerurl',                              ['App\Controllers\Admin',        'set_login_headerurl'], 10, 1);
		add_filter('login_headertext',                             ['App\Controllers\Admin',        'set_login_headertext'], 10, 1);
		add_filter('embed_oembed_html',                            ['App\Controllers\Admin',        'format_oembed_value'], 10, 3);
		add_filter('gform_field_content',                          ['App\Controllers\GravityForms', 'control_field_content'], 10, 5);
		add_filter('gform_submit_button',                          ['App\Controllers\GravityForms', 'control_submit_button'], 10, 2);
	}

	private function add_filters_backend() {
		add_filter('jpeg_quality',                                 ['App\Controllers\Admin',        'set_jpeg_quality'], 10, 2);
		add_filter('upload_mimes',                                 ['App\Controllers\Admin',        'set_upload_mimes'], 10, 1);
		add_filter('excerpt_length',                               ['App\Controllers\Admin',        'set_excerpt_length'], 999);
		add_filter('tiny_mce_before_init',                         ['App\Controllers\Admin',        'add_p_tags']);
		add_filter('allowed_block_types_all',                      ['App\Controllers\Blocks',       'set_allowed_block_types'], 10, 2);
	}

	private function add_actions_frontend() {
		add_action('wp_head',                                      ['App\Controllers\Admin',        'add_gtm_script']);
		add_action('wp_head',                                      ['App\Controllers\Admin',        'add_gtag_script']);
		add_action('wp_body_open',                                 ['App\Controllers\Admin',        'add_gtm_noscript'], 10, 0);
		add_action('login_enqueue_scripts',                        ['App\Controllers\Admin',        'login_enqueue_scripts'], 10, 0);
		add_action('wp_default_scripts',                           ['App\Controllers\Admin',        'remove_jquery_migrate'], 10, 1);
		add_action('wp_enqueue_scripts',                           ['App\Controllers\Admin',        'remove_block_library_styles'], 100, 0);
	}

	private function remove_actions_frontend() {
		remove_action('wp_enqueue_scripts',                        'wp_enqueue_global_styles');
		remove_action('wp_body_open',                              'wp_global_styles_render_svg_filters');
	}

	private function add_actions_backend() {
		add_action('acf/init',                                      ['App\Controllers\Acf',          'init_options_page']);
		add_action('admin_enqueue_scripts',                         ['App\Controllers\Admin',        'admin_enqueue_scripts']);
		add_action('admin_menu',                                    ['App\Controllers\Admin',        'remove_default_post_type']);
		add_action('admin_bar_menu',                                ['App\Controllers\Admin',        'remove_default_post_type_menu_bar'], 999, 1);
		add_action('admin_menu',                                    ['App\Controllers\Admin',        'remove_comments_menu_bar']);
		add_action('admin_footer',                                  ['App\Controllers\Admin',        'remove_add_new_post_admin_bar']);
		add_action('init',                                          ['App\Controllers\Blocks',       'register_block_templates'], 999);
		add_action('admin_footer',                                  ['App\Controllers\GravityForms', 'fix_acorn_gform_merge_tags']);
	}

	private function remove_actions_backend() {
		//
	}

	private function add_ajax_actions() {
		//
	}
}

new Hooks();