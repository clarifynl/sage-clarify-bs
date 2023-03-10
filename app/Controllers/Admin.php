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

	/**
	 * Add Google Tag Manager noscript tag directly after body
	 */
	public static function add_gtag_noscript() {
		if (env('GTAG_ID') && (!defined('WP_ENV') || \WP_ENV === 'production') && !current_user_can('manage_options')) {
			echo '<noscript><iframe sandbox src="https://www.googletagmanager.com/ns.html?id='. env('GTAG_ID') .'" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
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

	/**
	 * Fix Gravity forms merge tags error in form notifications due to acorn's laravel
	 *
	 * See: https://github.com/roots/acorn/issues/198
	 */
	public static function fix_acorn_gform_merge_tags() {
		$isGravityFormsEditPage = isset($_GET['page']) && 'gf_edit_forms' === $_GET['page'];

		if (!$isGravityFormsEditPage) {
			return;
		} ?>

		<script type="text/javascript">
			function MaybeAddSaveLinkMergeTag( mergeTags, elementId, hideAllFields, excludeFieldTypes, isPrepop, option ) {
				const eventSelectEl = document.querySelector('select[name="_gform_setting_event"]');
				if(!eventSelectEl) {
					return mergeTags;
				}

				var event = eventSelectEl.value;
				if (event === 'form_saved' || event === 'form_save_email_requested') {
					mergeTags['other'].tags.push({
						tag:  '{save_link}',
						label: <?php echo json_encode(esc_html__('Save & Continue Link', 'gravityforms')); ?>
					});
					mergeTags['other'].tags.push({
						tag:   '{save_token}',
						label: <?php echo json_encode(esc_html__('Save & Continue Token', 'gravityforms')); ?>
					});
				}
				return mergeTags;
			}
		</script>
		<?php
	}
}