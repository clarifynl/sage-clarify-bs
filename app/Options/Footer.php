<?php

namespace App\Options;
use Log1x\AcfComposer\Options as Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Footer extends Field
{
	/**
	 * The option page menu name.
	 *
	 * @var string
	 */
	public $name = 'Footer';

	/**
	 * The option page document title.
	 *
	 * @var string
	 */
	public $title = 'Footer';

	/**
	 * The slug of another admin page to be used as a parent.
	 *
	 * @var string
	 */
	public $parent = 'theme-options';

	/**
	 * The option page field group.
	 *
	 * @return array
	 */
	public function fields()
	{
		$option = new FieldsBuilder('Footer');
		$option
			->addGroup('footer', [
				'label'  => 'Footer',
				'layout' => 'block'
			])
			->endGroup();

		return $option->build();
	}
}