<?php

namespace App\Blocks;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Fields\Partials\MediaText;

class MediaTextBlock extends Block
{
	/**
	 * The block name.
	 *
	 * @var string
	 */
	public $name = 'Media & Text';

	/**
	 * The block name.
	 *
	 * @var string
	 */
	public $slug = 'media-text';

	/**
	 * The block view.
	 *
	 * @var string
	 */
	public $view = 'blocks.media-text.media-text';

	/**
	 * The block description.
	 *
	 * @var string
	 */
	public $description = 'A block with content and media side-by-side.';

	/**
	 * The block category.
	 *
	 * @var string
	 */
	public $category = 'common';

	/**
	 * The block icon.
	 *
	 * @var string|array
	 */
	public $icon = 'align-pull-right';

	/**
	 * The block keywords.
	 *
	 * @var array
	 */
	public $keywords = ['media', 'text', 'columns'];

	/**
	 * The block post type allow list.
	 *
	 * @var array
	 */
	public $post_types = ['page', 'post'];

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
		'multiple'      => true
	];

	/**
	 * Data to be passed to the block before rendering.
	 *
	 * @return array
	 */
	public function with()
	{
		return [
			'media_text' => $this->media_text()
		];
	}

	/**
	 * The block field group.
	 *
	 * @return array
	 */
	public function fields()
	{
		$block = new FieldsBuilder('media_text_block');
		$block->addFields($this->get(MediaText::class));

		return $block->build();
	}

	/**
	 * Return the media_text fields
	 */
	public function media_text()
	{
		$media_text = get_field('media_text') ?: [];

		return \App\arr_to_obj($media_text);
	}

	/**
	 * Assets to be enqueued when rendering the block.
	 *
	 * @return void
	 */
	public function enqueue() {
		bundle('media-text')->enqueue();
	}
}
