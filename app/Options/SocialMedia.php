<?php

namespace App\Options;
use Log1x\AcfComposer\Options as Field;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Fields\Partials\Socials;

class SocialMedia extends Field
{
	/**
	 * The option page menu name.
	 *
	 * @var string
	 */
	public $name = 'Socials';

	/**
	 * The option page document title.
	 *
	 * @var string
	 */
	public $title = 'Socials';

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
		$option = new FieldsBuilder('Social Media');
		$option->addFields($this->get(Socials::class));

		return $option->build();
	}
}