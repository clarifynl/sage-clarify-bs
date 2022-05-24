<?php

namespace App\Fields\Partials;
use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Socials extends Partial
{
	/**
	 * The partial field group.
	 *
	 * @return array
	 */
	public function fields()
	{
		$socials = new FieldsBuilder('Socials');
		$socials
			->addRepeater('socials', [
				'label'        => 'Social media channel',
				'button_label' => 'Add social',
				'layout'       => 'table'
			])
				->addField('icon', 'font-awesome', [
					'label'           => 'Channel Icon',
					'instructions'    => 'Select an icon for this social media channel',
					'required'        => 1,
					'icon_sets'       => [
						0 => 'brands'
					],
					'save_format'     => 'class',
					'allow_null'      => 0,
					'show_preview'    => 0,
					'enqueue_fa'      => 0
				])
				->addUrl('link', [
					'label'        => 'Channel URL',
					'instructions' => 'Add the URL for this social media channel',
					'required'     => 1
				])
			->endRepeater();

		return $socials;
	}
}