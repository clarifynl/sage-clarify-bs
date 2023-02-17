<?php

namespace App\Blocks\Headers;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Fields\Partials\ImageJson;
use function Roots\bundle;

class FrontHeader extends Block
{
	/**
	 * The block name.
	 *
	 * @var string
	 */
	public $name = 'Front Header';

	/**
	 * The block name.
	 *
	 * @var string
	 */
	public $slug = 'front-header';

	/**
	 * The block view.
	 *
	 * @var string
	 */
	public $view = 'blocks.front-header.front-header';

	/**
	 * The block description.
	 *
	 * @var string
	 */
	public $description = 'A header block with page title & hero image';

	/**
	 * The block category.
	 *
	 * @var string
	 */
	public $category = 'layout';

	/**
	 * The block icon.
	 *
	 * @var string|array
	 */
	public $icon = 'cover-image';

	/**
	 * The block keywords.
	 *
	 * @var array
	 */
	public $keywords = ['header', 'hero'];

	/**
	 * The block post type allow list.
	 *
	 * @var array
	 */
	public $post_types = ['page'];

	/**
	 * The default block mode.
	 *
	 * @var string
	 */
	public $mode = 'preview';

	/**
	 * The supported block features.
	 *
	 * @var array
	 */
	public $supports = [
		'align'         => false,
		'align_text'    => false,
		'align_content' => false,
		'full_height'   => false,
		'mode'          => true,
		'multiple'      => false
	];

	/**
	 * Data to be passed to the block before rendering.
	 *
	 * @return array
	 */
	public function with()
	{
		return [
			'hero' => $this->hero()
		];
	}

	/**
	 * The block field group.
	 *
	 * @return array
	 */
	public function fields()
	{
		$block = new FieldsBuilder('front_header');
		$block
			->addGroup('hero', [
				'label'  => 'Hero',
				'layout' => 'table'
			])
				->addFields($this->get(ImageJson::class))
				->addText('hero_title', [
					'label'         => 'Hero Title',
					'instructions'  => 'Enter an optional hero title (will default to page title)',
					'wrapper'       => [
						'width' => 50
					]
				])
			->endGroup();

		return $block->build();
	}

	/**
	 * Return the hero fields
	 */
	public function hero()
	{
		return (object) [
			'image_json' => get_field('hero_image_json') ?: get_post_thumbnail_id(),
			'title'      => get_field('hero_title') ?: get_the_title()
		];
	}

	/**
	 * Assets to be enqueued when rendering the block.
	 *
	 * @return void
	 */
	public function enqueue()
	{
		bundle('front-header')->enqueue();
	}
}
