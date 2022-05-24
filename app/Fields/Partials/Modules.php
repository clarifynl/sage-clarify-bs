<?php

namespace App\Fields\Partials;
use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Fields\Modules\Carousel;

class Modules extends Partial
{
	/**
	 * The partial field group.
	 *
	 * @return array
	 */
	public function fields() {
		$modules = new FieldsBuilder('modules');
		$modules->addFlexibleContent('page_modules', [
			'button_label' => 'Add Module'
		])
			->addLayout($this->get(Carousel::class))
		->endFlexibleContent();

		return $modules;
	}
}