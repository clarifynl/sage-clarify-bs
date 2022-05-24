<?php

namespace App\Fields;
use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Fields\Partials\Modules;

class PageModules extends Field
{
	/**
	 * The field group.
	 *
	 * @return array
	 */
	public function fields() {
		$product = new \WC_Product( get_the_ID() );
		$post = new FieldsBuilder('page_modules');
		$post
			->setLocation('page_type', '==', 'front_page')
				->or('page_template', '==', 'default')
			->addFields($this->get(Modules::class));

		return $post->build();
	}
}