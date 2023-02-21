<?php

namespace App\Blocks\Headers;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use function Roots\bundle;

class PageHeader extends Block
{
	/**
	 * The block name.
	 *
	 * @var string
	 */
	public $name = 'Page Header';

	/**
	 * The block name.
	 *
	 * @var string
	 */
	public $slug = 'page-header';

	/**
	 * The block view.
	 *
	 * @var string
	 */
	public $view = 'blocks.page-header.page-header';

	/**
	 * The block description.
	 *
	 * @var string
	 */
	public $description = 'A header block containing page title & optional image';

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
	public $icon = 'heading';

	/**
	 * The block keywords.
	 *
	 * @var array
	 */
	public $keywords = ['header', 'title', 'intro', 'image'];

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
			'title' => get_field('title') ?: get_the_title(),
			'image' => get_field('image') ?: get_post_thumbnail_id()
		];
	}

	/**
	 * The block field group.
	 *
	 * @return array
	 */
	public function fields()
	{
		$block = new FieldsBuilder('page_header');
		$block
			->addText('title', [
				'label'         => 'Title',
				'instructions'  => 'Enter an optional title for this page header (will default to page title)',
			])
			->addImage('image', [
				'label'         => 'Image',
				'instructions'  => 'Select the image to be used in this page header (will default to featured image)'
			]);

		return $block->build();
	}

	/**
	 * Assets to be enqueued when rendering the block.
	 *
	 * @return void
	 */
	public function enqueue()
	{
		bundle('page-header')->enqueue();
	}
}
