<?php

namespace App\Blocks;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Fields\Partials\MediaTextBlock;
use function Roots\bundle;

class MediaContent extends Block
{
	/**
	 * The block name.
	 *
	 * @var string
	 */
	public $name = 'Media & Content';

	/**
	 * The block name.
	 *
	 * @var string
	 */
	public $slug = 'media-content';

	/**
	 * The block view.
	 *
	 * @var string
	 */
	public $view = 'blocks.media-content.media-content';

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
	public $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false"><path d="M3 18h8V6H3v12zM14 7.5V9h7V7.5h-7zm0 5.3h7v-1.5h-7v1.5zm0 3.7h7V15h-7v1.5z"></path></svg>';

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
			'media_content' => $this->media_content()
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
		$block->addFields($this->get(MediaTextBlock::class));

		return $block->build();
	}

	/**
	 * Return the media_text fields
	 */
	public function media_content()
	{
		$media_content = get_field('media_text') ?: [];

		return \App\arr_to_obj($media_content);
	}

	/**
	 * Assets to be enqueued when rendering the block.
	 *
	 * @return void
	 */
	public function enqueue() {
		bundle('media-content')->enqueue();
	}
}
