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
		'wysiwyg' => [
			'wpml_cf_preferences' => 2,
			'media_upload'        => 0
		],
		'textarea' => [
			'wpml_cf_preferences' => 2,
			'new_lines' => 'br'
		],
		'image' => [
			'wpml_cf_preferences' => 2,
			'return_format'       => 'id'
		],
		'radio' => [
			'wpml_cf_preferences' => 2,
			'layout'              => 'horizontal'
		],
		'group' => [
			'wpml_cf_preferences' => 2,
			'layout'              => 'table'
		],
		'tab' => [
			'wpml_cf_preferences' => 2,
			'placement'           => 'top'
		],
		'repeater' => [
			'wpml_cf_preferences' => 3,
			'layout'              => 'row'
		],
		'trueFalse' => [
			'ui'                  => 1,
			'wpml_cf_preferences' => 2
		],
		'select' => [
			'ui'                  => 1,
			'wpml_cf_preferences' => 2
		],
		'postObject' => [
			'ui'                  => 1,
			'return_format'       => 'id',
			'wpml_cf_preferences' => 2
		],
		'flexibleContent' => [
			'wpml_cf_preferences' => 2
		],
		'taxonomy' => [
			'wpml_cf_preferences' => 2
		],
		'text' => [
			'wpml_cf_preferences' => 2
		],
		'link' => [
			'wpml_cf_preferences' => 2,
			'return_format'       => 'array'
		],
		'file' => [
			'wpml_cf_preferences' => 2,
			'return_format'       => 'array'
		],
		'forms'           => [
			'return_format'       => 'id',
			'wpml_cf_preferences' => 2
		]
	]
];
