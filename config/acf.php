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
		'country'         => ['wpml_cf_preferences' => 2, 'ui' => 1, 'return_format' => 'array'],
		'flexibleContent' => ['wpml_cf_preferences' => 2],
		'forms'           => ['wpml_cf_preferences' => 2, 'return_format' => 'id'],
		'group'           => ['wpml_cf_preferences' => 2, 'layout' => 'table'],
		'image'           => ['wpml_cf_preferences' => 2, 'return_format' => 'id'],
		'link'            => ['wpml_cf_preferences' => 2],
		'postObject'      => ['wpml_cf_preferences' => 2, 'ui' => 1, 'return_format' => 'id'],
		'radio'           => ['wpml_cf_preferences' => 2, 'layout' => 'horizontal'],
		'relationship'    => ['wpml_cf_preferences' => 2, 'return_format' => 'id'],
		'repeater'        => ['wpml_cf_preferences' => 3, 'layout' => 'row'],
		'select'          => ['wpml_cf_preferences' => 2, 'ui' => 1],
		'tab'             => ['wpml_cf_preferences' => 2, 'placement' => 'top'],
		'taxonomy'        => ['wpml_cf_preferences' => 2],
		'text'            => ['wpml_cf_preferences' => 2],
		'textarea'        => ['wpml_cf_preferences' => 2, 'new_lines' => 'br'],
		'trueFalse'       => ['wpml_cf_preferences' => 2, 'ui' => 1],
		'wysiwyg'         => ['wpml_cf_preferences' => 2, 'media_upload' => 0]
	]
];
