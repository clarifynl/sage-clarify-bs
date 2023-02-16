<?php

namespace App\Fields\Partials;
use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Fields\Partials\ImageJson;

class MediaTextBlock extends Partial
{
	/**
	 * The partial field group.
	 *
	 * @return array
	 */
	public function fields()
	{
		$partial = new FieldsBuilder('MediaText');
		$partial
			->addGroup('media_text', [
				'label'  => 'Media & Text',
				'layout' => 'block'
			])
				->addButtonGroup('align', [
					'label'    => 'Media Alignment',
					'required' => 1,
					'choices'  => [
						'left'  => '<i class="dashicons dashicons-editor-alignleft"></i>',
						'right' => '<i class="dashicons dashicons-editor-alignright"></i>'
					],
					'default_value' => 'right',
					'wrapper'       => [
						'width' => '100'
					]
				])
				->addGroup('text', [
					'label'   => 'Text',
					'layout'  => 'block',
					'wrapper' => [
						'width' => '50'
					]
				])
					->addText('title', [
						'label'        => 'Title',
						'instructions' => 'Add a title'
					])
					->addWysiwyg('content', [
						'label'        => 'Content',
						'instructions' => 'Enter the (textual) content'
					])
					->addLink('link', [
						'label'        => 'Link',
						'instructions' => 'Add an optional link'
					])
				->endGroup()
				->addFields($this->get(ImageJson::class))
			->endGroup();

		return $partial;
	}
}