<?php

/**
 * Theme helpers.
 */
namespace App;
use function Roots\view;


/**
 * Covert string to slug
 */
function to_slug($string) {
	$string = strip_tags($string);
	return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
}

/**
 * Convert Array to Object
 */
function arr_to_obj($arr) {
	return json_decode(json_encode($arr));
}

/**
 * Theme Variables
 */
function get_theme_vars() {
	return [
		'ajax_nonce' => wp_create_nonce('wc_ajax_nonce'),
		'ajax_url'   => apply_filters('the_permalink', admin_url('admin-ajax.php'))
	];
}

/*
 * Decode email addresses in source code
 */
function encode_email_address($email = '') {
	$output = null;

	for ($i = 0; $i < strlen($email); $i++) {
		$output .= '&#'.ord($email[$i]).';';
	}

	return ($output !== '') ? $output : $email;
}

/*
 * Construct custom pagination
 */
function get_pagination($total = null) {
	global $wp_query, $wp_rewrite;

	if (!isset($total)) {
		$total = $wp_query->max_num_pages;
	}

	$paginate = [
		'base'         => @add_query_arg('paged','%#%'),
		'total'        => $total,
		'current'      => get_query_var('paged') ? get_query_var('paged') : 1,
		'show_all'     => false,
		'format'       => '',
		'type'         => 'array',
		'end_size'     => 2,
		'mid_size'     => 1,
		'prev_next'    => true,
		'prev_text'    => '',
		'next_text'    => ''
	];

	if ($wp_rewrite->using_permalinks()) {
		$filter = get_query_var('filter');
		$filter_query = $filter ? '?filter=' . $filter : '';
		$paginate['base'] = user_trailingslashit(trailingslashit(remove_query_arg('filter', get_pagenum_link(1))) .'page/%#%/', 'paged') . $filter_query;
	}

	$pages = paginate_links($paginate);
	if ($pages) {
		$pages = \App\format_pagination($pages);
	}

	return $pages;
}

/*
 * Format custom pagination
 */
function format_pagination($data) {
	$pages = [];
	$nav   = [];

	// check link type
	foreach ($data as $link) {
		if (preg_match('/prev/i', $link)) {
			$nav['prev'] = $link;
		} elseif (preg_match('/next/i', $link)) {
			$nav['next'] = $link;
		} else {
			$pages[] = $link;
		}
	}

	// check if prev/next is missing
	if (count($nav) < 2) {
		$nav_string = implode(' ', $nav);

		if (!preg_match('/prev/i', $nav_string)) {
			$nav['prev'] = '<span class="page-numbers prev disabled"></span>';
		}

		if (!preg_match('/next/i', $nav_string)) {
			$nav['next'] = '<span class="page-numbers next disabled"></span>';
		}
	}

	$new_data = [
		'pages' => $pages,
		'nav'   => $nav
	];

	return \App\arrToObj($new_data);
}

/*
 * Make oEmbed responsive
 */
function make_oembed_responsive($embed = null) {
	if (!$embed) {
		return;
	}

	// Add extra parameters to src and replace HTML.
	preg_match('/src="(.+?)"/', $embed, $sources);
	if (array_key_exists(1, $sources)) {
		$org_src = $sources[1];
		$params  = [
			'controls'  => 0,
			'hd'        => 1,
			'autohide'  => 1,
			'title'     => 0,
			'byline'    => 0,
			'portrait'  => 0
		];
		$new_src = add_query_arg($params, $org_src);
		$embed   = str_replace($org_src, $new_src, $embed);
	}

	// Get original dimensions
	preg_match('/width="([0-9]+?)"/', $embed, $widths);
	preg_match('/height="([0-9]+?)"/', $embed, $heights);

	if (array_key_exists(1, $widths)) {
		$org_width = $widths[1];
	}

	if (array_key_exists(1, $heights)) {
		$org_height = $heights[1];
	}

	// Calculate ratio
	if (isset($org_width) && strpos($org_width, '%') === false && isset($org_height)) {
		$ratio = $org_height / $org_width;
	} else {
		$ratio = 9 / 16;
	}

	// Set ratio and remove dimensions
	$padding    = round($ratio * 100, 2);
	$responsive = preg_replace('/(width|height)\s*?=\s*?".*?"/', '', $embed);
	$responsive = str_replace('?feature=oembed', '', $responsive);

	return '<div class="b-embed" style="padding-bottom:'. $padding .'%">' . $responsive . '</div>';
}

/*
 * Make oEmbed lazyloaded
 */
function lazyload_oembed($embed = null) {
	if (!$embed) {
		return;
	}

	// Get src
	preg_match('/src="(.+?)"/', $embed, $sources);
	if (array_key_exists(1, $sources)) {
		$org_src  = $sources[1];
		$lazyload = str_replace($org_src, '', $embed);

		// Use src on new data-src
		$data_src = 'data-src="'. $org_src .'"';
		$lazyload = str_replace('></iframe>', ' ' . $data_src . '></iframe>', $lazyload);

		// Add lazyload class to iframe html
		$class    = 'class="lazyload"';
		$lazyload = str_replace('></iframe>', ' ' . $class . '></iframe>', $lazyload);

		return $lazyload;
	}

	return $embed;
}

/*
 * Make oEmbed responsive and lazyloaded
 */
function use_oembed_api($embed = null, $image = null) {
	if (!$embed) {
		return;
	}

	// Add extra parameters to src and replace HTML.
	$embed = str_replace('?feature=oembed', '', $embed);
	preg_match('/src="(.+?)"/', $embed, $sources);
	if (array_key_exists(1, $sources)) {
		$org_src = $sources[1];
		$params  = [
			'enablejsapi' => 1
		];
		$new_src = add_query_arg($params, $org_src);
		$embed   = str_replace($org_src, $new_src, $embed);
	}

	// Get original dimensions
	preg_match('/width="([0-9]+?)"/', $embed, $widths);
	preg_match('/height="([0-9]+?)"/', $embed, $heights);

	if (array_key_exists(1, $widths)) {
		$org_width = $widths[1];
	}

	if (array_key_exists(1, $heights)) {
		$org_height = $heights[1];
	}

	// Calculate ratio
	if (isset($org_width) && strpos($org_width, '%') === false && isset($org_height)) {
		$ratio = $org_height / $org_width;
	} else {
		$ratio = 9 / 16;
	}

	// Set ratio and remove dimensions
	$padding    = round($ratio * 100, 2);
	$responsive = preg_replace('/(width|height)\s*?=\s*?".*?"/', '', $embed);
	$lazyload   = \App\lazyload_oembed($responsive);

	$api_embed  = view('blocks/b-embed', [
		'ratio' => $ratio,
		'image' => $image,
		'embed' => $lazyload
	])->render();

	return $api_embed;
}

/*
 * Use image placeholder for video embedding
 */
function video_placeholder($html, $image) {
	return \App\use_oembed_api($html, $image);
}