<?php

namespace App\Options;
use Log1x\AcfComposer\Options as Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ErrorPage extends Field
{
	/**
	 * The option page menu name.
	 *
	 * @var string
	 */
	public $name = 'Error Page';

	/**
	 * The option page document title.
	 *
	 * @var string
	 */
	public $title = 'Error Page';

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
	public function fields() {
		$errorPage = new FieldsBuilder('ErrorPage');
		$errorPage
			->addGroup('four_zero_four', [
					'label'  => '404 Error',
					'layout' => 'row',
				])
				->addImage('image', [
					'label'         => 'Image',
					'instructions'  => 'Add an image to the 404 page',
					'return_format' => 'id',
					'preview_size'  => 'medium',
					'wpml_cf_preferences' => 1
				])
				->addText('title', [
					'label'        => 'Title',
					'instructions' => 'Set the title for the 404 page',
					'required'     => 1
				])
				->addWysiwyg('message', [
					'label'        => 'Message',
					'instructions' => 'Enter the message when a user visits the 404 page',
					'required'     => 1
				])
			->endGroup();

		return $errorPage->build();
	}
}
