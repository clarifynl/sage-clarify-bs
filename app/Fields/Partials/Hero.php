<?php

namespace App\Fields\Partials;
use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Hero extends Partial
{
	/**
	 * The partial field group.
	 *
	 * @return array
	 */
	public function fields() {
		$header = new FieldsBuilder('hero');
		$header
			->addGroup('page_hero', [
				'label' => 'Hero',
				'required' => 0,
			])
				->addText('tagline', ['label' => 'Tagline'])
					->setInstructions('Enter a tagline')
				->addFile('hero_video', [
					'label' => 'Hero Video',
					'required' => 1,
					'return_format' => 'array',
					'mime_types' => 'mp4'
				])
				->addFile('hero_video_sm', [
					'label' => 'Hero Video Mobile',
					'required' => 1,
					'return_format' => 'array',
					'mime_types' => 'mp4'
				])
			->endGroup();

		return $header;
	}
}