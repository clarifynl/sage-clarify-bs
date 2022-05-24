<?php

namespace App\Controllers;
use function Roots\bundle;

class Admin
{
	/*
	 * Format oEmbed field value
	 */
	public static function format_oembed_value($html, $data, $url) {
		$responsive = \App\make_oembed_responsive($html);
		$lazyload   = \App\lazyload_oembed($responsive);

		return $lazyload;
	}

	/*
	 * Set preview link to headless front-end
	 */
	public static function set_jpeg_quality($quality, $context) {
		return 90;
	}

	/*
	 * Add allowed mime types for uploads
	 */
	public static function set_upload_mimes($mimes) {
		$mimes['svg']  = 'image/svg+xml';
		$mimes['json'] = 'application/json';
		$mimes['zip']  = 'application/zip';
		$mimes['gzip'] = 'application/x-zip';
		$mimes['rar']  = 'application/rar';

		return $mimes;
	}

	/*
	 * Set Excerpt Length
	 */
	public static function set_excerpt_length($length) {
		return 32;
	}

	/**
	 * Add Google Tag Manager G4 tag
	 */
	public static function add_gtag_script() {
		$gtag_id = isset($_SERVER['GTAG_ID']) ? $_SERVER['GTAG_ID'] : null;

		if ($gtag_id) {
			if ((!defined('WP_ENV') || \WP_ENV === 'production') &&
				!current_user_can('manage_options')) { ?>
				<script async src="https://www.googletagmanager.com/gtag/js?id=<?= $gtag_id; ?>"></script>
				<script>
					window.dataLayer = window.dataLayer || [];
					function gtag(){dataLayer.push(arguments);}
					gtag('js', new Date());
					gtag('config', '<?= $gtag_id; ?>', {'anonymize_ip': true});
				</script>
			<?php } else { ?>
				<script>console.log('Google Analytics: <?= $gtag_id; ?>');</script>
			<?php }
		}
	}

	/*
	 * Add Google Tag Manager noscript tag directly after body
	 */
	public static function add_gtag_noscript() {
		if (env('GTAG_ID') && (!defined('WP_ENV') || \WP_ENV === 'production') && !current_user_can('manage_options')) {
			echo '<noscript><iframe sandbox src="https://www.googletagmanager.com/ns.html?id='. env('GTAG_ID') .'" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
		}
	}

	/**
	 * Style WP Login
	 */
	public static function login_enqueue_scripts() {
		// bundle('login')->enqueue();
	}

	/**
	 * Set WP Login logo url
	 */
	public static function set_login_headerurl($url) {
		return get_bloginfo('url');
	}

	/**
	 * Set WP Login Title
	 */
	public static function set_login_headertext($headertext) {
		return get_bloginfo('name');
	}

	/**
	 * Style WP Admin
	 */
	public static function admin_enqueue_scripts() {
		bundle('wp-admin')->enqueue();
	}
}