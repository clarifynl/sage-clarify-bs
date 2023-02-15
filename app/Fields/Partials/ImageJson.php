<?php

namespace App\Fields\Partials;
use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ImageJson extends Partial
{
	/**
	 * The partial field group.
	 *
	 * @return array
	 */
	public function fields()
	{
		$partial = new FieldsBuilder('ImageJson');
		$partial
			->addGroup('image_json', [
				'label'   => 'Image / JSON',
				'layout'  => 'block',
				'wrapper' => [
					'width' => '50'
				]
			])
				->addTrueFalse('use_json', [
					'label'       => '',
					'ui_on_text'  => 'JSON',
					'ui_off_text' => 'Image'
				])
				->addImage('image', [
					'label'        => 'Image',
					'instructions' => 'Select/upload the image',
					'required'     => 1,
					'preview_size' => 'medium'
				])
					->conditional('use_json', '==', '0')
				->addGroup('json', [
					'label'             => 'Lottie JSON',
					'layout'            => 'block',
					'conditional_logic' => [
						[
							[
								'field'    => 'use_json',
								'operator' =>  '==',
								'value'    => '1'
							]
						]
					]
				])
					->addFile('file', [
						'label'        => 'Lottie JSON file',
						'instructions' => 'Upload the <a class="underline" href="http://airbnb.io/lottie" target="_blank">Lottie animation</a> in JSON format',
						'required'     => 1,
						'max_size'     => '1 MB',
						'mime_types'   => 'json'
					])
					->addTrueFalse('interactive', [
						'label'         => 'Lottie Interactivity',
						'default_value' => 0,
						'wrapper'       => [
							'width' => '33'
						]
					])
					->addSelect('mode', [
						'label'         => 'Lottie Mode',
						'instructions'  => 'Select the Lottie Interactivity mode',
						'choices'       => [
							//'chain' => 'Chaining',
							'cursor' => 'Cursor',
							'scroll' => 'Scroll'
						],
						'default_value' => 'scroll',
						'required'      => 1,
						'wrapper'       => [
							'width'     => '66'
						]
					])
						->conditional('interactive', '==', '1')
					->addSelect('cursor_type', [
						'label'         => 'Cursor Types',
						'instructions'  => 'Select a cursor animation type',
						'choices'       => [
							'click'     => 'Animate on click',
							'hold'      => 'Animate on hold',
							'hover'     => 'Animate on hover',
							'pauseHold' => 'Animate on hold & pause on release',
							'position'  => "Sync animation with cursor's position",
							'movement'  => "Sync animation with cursor's movement",
							'toggle'    => 'Toggle animation on click'
						],
						'default_value' => 'position',
						'required'      => 1
					])
						->conditional('mode', '==', 'cursor')
					->addSelect('scroll_type', [
						'label'         => 'Scroll Types',
						'instructions'  => 'Select a scroll animation type',
						'choices'       => [
							'scroll'    => 'Scroll',
							'container' => 'Scroll relative to container',
							'offset'    => 'Scroll with offset',
							'loop'      => 'Animate from specific frames',
							'play'      => 'Animate when visible',
							'playOnce'  => 'Animate when visible and play once'
						],
						'default_value' => 'scroll',
						'required'      => 1,
						'wrapper'       => [
							'width' => '50'
						]
					])
						->conditional('mode', '==', 'scroll')
					->addText('scroll_container', [
						'label'         => 'Scroll Container',
						'instructions'  => 'Enter the container ID of the relative scroll container',
						'prepend'      => '#',
						'wrapper'       => [
							'width' => '50'
						]
					])
						->conditional('scroll_type', '==', 'container')
					->addGroup('scroll_offset', [
						'label'         => 'Scroll Offset',
						'instructions'  => 'Specifiy the scroll offset posotions',
						'layout'        => 'table',
						'wrapper'       => [
							'width' => '50'
						]
					])
						->conditional('scroll_type', '==', 'offset')
						->addNumber('start', [
							'label'         => 'Start',
							'min'           => 0,
							'max'           => 1,
							'default_value' => 0,
							'wrapper'       => [
								'width' => '50'
							]
						])
						->addNumber('end', [
							'label'         => 'End',
							'min'           => 0,
							'max'           => 1,
							'default_value' => 1,
							'wrapper'       => [
								'width' => '50'
							]
						])
					->endGroup()
					->addGroup('scroll_loop', [
						'label'         => 'Scroll Loop',
						'instructions'  => 'Specifiy the start- and endframes to loop between on scroll',
						'layout'        => 'table',
						'wrapper'       => [
							'width' => '50'
						]
					])
						->conditional('scroll_type', '==', 'loop')
						->addNumber('start', [
							'label'   => 'Start frame',
							'min'     => 1,
							'wrapper' => [
								'width' => '50'
							]
						])
						->addNumber('end', [
							'label'   => 'End frame',
							'min'     => 2,
							'wrapper' => [
								'width' => '50'
							]
						])
					->endGroup()
					->addGroup('scroll_visibility', [
						'label'         => 'Scroll Visibility',
						'instructions'  => 'Specifiy the scroll visibility percentages',
						'layout'        => 'table',
						'conditional_logic' => [
							[
								[
									'field'    => 'scroll_type',
									'operator' =>  '==',
									'value'    => 'play'
								],
							],
							[
								[
									'field'    => 'scroll_type',
									'operator' =>  '==',
									'value'    => 'playOnce'
								]
							]
						],
						'wrapper'       => [
							'width' => '50'
						]
					])
						->addNumber('start', [
							'label'         => 'Start',
							'min'           => 0,
							'max'           => 1,
							'default_value' => 0.5,
							'wrapper'       => [
								'width' => '50'
							]
						])
						->addNumber('end', [
							'label'         => 'End',
							'min'           => 0,
							'max'           => 1,
							'default_value' => 1,
							'wrapper'       => [
								'width' => '50'
							]
						])
					->endGroup()
					->addTrueFalse('autoplay', [
						'label'         => 'Lottie Autoplay',
						'default_value' => 1,
						'wrapper'       => [
							'width' => '33'
						]
					])
						->conditional('interactive', '==', '0')
					->addTrueFalse('loop', [
						'label'         => 'Lottie Loop',
						'default_value' => 1,
						'wrapper'       => [
							'width' => '33'
						]
					])
						->conditional('interactive', '==', '0')
				->endGroup()
			->endGroup();

		return $partial;
	}
}