<?php

namespace App\Fields;
use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Fields\Partials\Hero;

class FrontPage extends Field
{
	/**
	 * The field group.
	 *
	 * @return array
	 */
	public function fields() {
		$frontPage = new FieldsBuilder('front page');
		$frontPage
			->setLocation('page_type', '==', 'front_page')
			->addFields($this->get(Hero::class));

		return $frontPage->build();
	}
}