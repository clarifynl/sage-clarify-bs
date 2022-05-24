<?php

namespace App\Fields\Modules;
use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Carousel extends Partial
{
	/**
	 * The partial field group.
	 *
	 * @return array
	 */
	public function fields() {
		$module = new FieldsBuilder('carousel');
		$module
			->addGroup('module_carousel', [
				'label'    => 'Carousel',
				'required' => 0
			])
				->addRepeater('slides', [
						'label'         => 'Slides',
						'instructions'  => 'Add a slide',
						'min'           => 1,
						'max'           => 5,
						'layout'        => 'row',
						'button_label'  => 'Add Slide'
					])
					->addImage('image', [
						'label'         => 'Image',
						'instructions'  => 'Select an image'
					])
					->addTextArea('tagline', [
						'label'         => 'Tagline',
						'instructions'  => 'Enter a tagline',
						'required'      => 1,
						'maxlength'     => 100
					])
				->endRepeater()
				->addGroup('cta')
					->addText('label', [
						'label'        => 'CTA Label',
						'instructions' => 'Enter the CTA label'
					])
				->endGroup()
			->endGroup();

		return $module;
	}
}