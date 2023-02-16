<?php

namespace App\View\Composers\Partials;
use Roots\Acorn\View\Composer;

class ImageJson extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'partials.image-json'
	];

	/**
	 * Data to be passed to view before rendering.
	 *
	 * @return array
	 */
	public function with() {
		$use_json = $this->data->image_json->use_json ?: false;
		$json     = $this->data->image_json->json ?: [];

		return [
			'use_json' => $use_json,
			'lottie'   => $use_json ? $this->lottie($json) : []
		];
	}

	/**
	 * Returns the Lottie settings.
	 *
	 * @return object
	 */
	public function lottie($json) {
		$lottie  = $json;
		$options = [
			'ssl' => [
				'verify_peer'      => \WP_ENV !== 'development',
				'verify_peer_name' => \WP_ENV !== 'development'
			]
		];
		$context  = stream_context_create($options);
		$contents = file_get_contents($json->file->url, false, $context);
		$data     = json_decode($contents, TRUE);

		// Add total frames to object
		$lottie->frames = $data['op'] ?: 0;

		return \App\arr_to_obj($lottie);
	}
}