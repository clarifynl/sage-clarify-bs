<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Default Field Type Settings
	|--------------------------------------------------------------------------
	|
	| Here you can set default field group and field type configuration that
	| is then merged with your field groups when they are composed.
	|
	| This allows you to avoid the repetitive process of setting common field
	| configuration such as `ui` on every `trueFalse` field or your
	| preferred `instruction_placement` on every `fieldGroup`.
	|
	*/

	'defaults' => [
		'buttonGroup' => [
			'wpml_cf_preferences' => 3
		],
		'country' => [
			'ui'                  => 1,
			'return_format'       => 'array',
			'wpml_cf_preferences' => 2
		],
		'file' => [
			'wpml_cf_preferences' => 2,
			'return_format'       => 'array'
		],
		'flexibleContent' => [
			'wpml_cf_preferences' => 3
		],
		'fontAwesome' => [
			'enqueue_fa'          => 0,
			'save_format'         => 'object',
			'show_preview'        => 0,
			'wpml_cf_preferences' => 3
		],
		'forms' => [
			'return_format'       => 'id',
			'wpml_cf_preferences' => 2
		],
		'gallery' => [
			'return_format'       => 'id',
			'wpml_cf_preferences' => 2
		],
		'group' => [
			'layout'              => 'table',
			'wpml_cf_preferences' => 3
		],
		'image' => [
			'return_format'       => 'id',
			'wpml_cf_preferences' => 2
		],
		'link' => [
			'return_format'       => 'array',
			'wpml_cf_preferences' => 2
		],
		'postObject' => [
			'ui'                  => 1,
			'return_format'       => 'id',
			'wpml_cf_preferences' => 2
		],
		'radio' => [
			'layout'              => 'horizontal',
			'wpml_cf_preferences' => 2,
		],
		'relationship' => [
			'return_format'       => 'id',
			'wpml_cf_preferences' => 2
		],
		'repeater' => [
			'layout'              => 'row',
			'wpml_cf_preferences' => 3
		],
		'select' => [
			'ui'                  => 1,
			'wpml_cf_preferences' => 2
		],
		'tab' => [
			'placement'           => 'top',
			'wpml_cf_preferences' => 3
		],
		'taxonomy' => [
			'wpml_cf_preferences' => 2
		],
		'text' => [
			'wpml_cf_preferences' => 2
		],
		'textarea' => [
			'new_lines'           => 'br',
			'wpml_cf_preferences' => 2
		],
		'trueFalse' => [
			'ui'                  => 1,
			'wpml_cf_preferences' => 2
		],
		'url' => [
			'wpml_cf_preferences' => 3
		],
		'wysiwyg' => [
			'media_upload'        => 0,
			'wpml_cf_preferences' => 2
		]
	]
];
