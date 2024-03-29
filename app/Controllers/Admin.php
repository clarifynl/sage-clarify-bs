<?php

namespace App\Controllers;
use function Roots\bundle;

class Admin
{
	/**
	 * Remove the default post type from menu
	 */
	public static function remove_default_post_type() {
		remove_menu_page('edit.php');
	}

	/**
	 * Remove the default post type from menu bar
	 */
	public static function remove_default_post_type_menu_bar($wp_admin_bar) {
		$wp_admin_bar->remove_node('new-post');
	}

	/**
	 * Remove the comments tab from menu bar
	 */
	public static function remove_comments_menu_bar() {
		remove_menu_page('edit-comments.php');
	}

	/**
	 * Remove the new post link in Admin Bar
	 */
	public static function remove_add_new_post_admin_bar() {
		?>
		<script type="text/javascript">
			function remove_add_new_post_admin_bar() {
				var add_new = document.getElementById('wp-admin-bar-new-content');
				if(!add_new) return;
				var add_new_a = add_new.getElementsByTagName('a')[0];
				if(add_new_a) add_new_a.setAttribute('href','#!');
			}
			remove_add_new_post_admin_bar();
		</script>
		<?php
	}

	/**
	 * Remove JQuery migrate
	 */
	public static function remove_jquery_migrate($scripts) {
		if (isset($scripts->registered['jquery'])) {
			$script = $scripts->registered['jquery'];

			if ($script->deps) {
				$script->deps = array_diff($script->deps, array('jquery-migrate'));
			}
		}
	}

	/**
	 * Format embed block
	 */
	public static function format_oembed_value($html, $data, $url) {
		$responsive = \App\make_oembed_responsive($html);
		$lazyload   = \App\lazyload_oembed($responsive);

		return $lazyload;
	}

	/**
	 * Set preview link to headless front-end
	 */
	public static function set_jpeg_quality($quality, $context) {
		return 90;
	}

	/**
	 * Add allowed mime types for uploads
	 */
	public static function set_upload_mimes($mimes) {
		$mimes['svg']  = 'image/svg+xml';
		$mimes['json'] = 'text/plain';
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
	 * Add Google Tag Manager
	 */
	public static function add_gtm_script() {
		$GTM_ID = env('GTM_CONTAINER_ID') ?: null;

		if ($GTM_ID) {
			if ((!defined('WP_ENV') || \WP_ENV === 'production') &&
				!current_user_can('manage_options')) { ?>
				<script nonce="<?= wp_create_nonce(); ?>">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
					new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
					j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
					'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
					})(window,document,'script','dataLayer','<?= $GTM_ID; ?>');
				</script>
			<?php } else { ?>
				<script nonce="<?= wp_create_nonce(); ?>">console.log('Google Tag Manager Container: <?= $GTM_ID; ?>');</script>
			<?php }
		}
	}
	/*
	 * Add Google Tag Manager (noscript) in body
	 */
	public static function add_gtm_noscript() {
		$GTM_ID = env('GTM_CONTAINER_ID') ?: null;

		if ($GTM_ID && (!defined('WP_ENV') || \WP_ENV === 'production') &&
			!current_user_can('manage_options')) {
			echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id='. $GTM_ID .'" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
		}
	}

	/**
	 * Add Google tag (GA4)
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
				<script>console.log('Google Analytics Measurement ID: <?= $gtag_id; ?>');</script>
			<?php }
		}
	}

	/**
	 * Remove default Gutenberg block-library styles
	 */
	public static function remove_block_library_styles(){
		wp_dequeue_style('wp-block-library');
		wp_dequeue_style('wp-block-library-theme');
		wp_dequeue_style('wc-blocks-style');
	}

	/**
	 * Style WP Login
	 */
	public static function login_enqueue_scripts() {
		bundle('login')->enqueue();
		echo app(\Spatie\GoogleFonts\GoogleFonts::class)->load()->toHtml();
		echo app(\Spatie\GoogleFonts\GoogleFonts::class)->load('serif')->toHtml();
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
		bundle('admin')->enqueue();
	}

	/**
	 * Automatically wrap paragraphs in p tags
	 */
	public static function add_p_tags($init, $editor_id = '') {
		$init['wpautop'] = false;
		$init['indent'] = true;
		$init['tadv_noautop'] = true;

		return $init;
	}
}