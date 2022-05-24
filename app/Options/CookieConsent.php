<?php

namespace App\Options;
use Log1x\AcfComposer\Options as Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CookieConsent extends Field
{
	/**
	 * The option page menu name.
	 *
	 * @var string
	 */
	public $name = 'Cookie Consent';

	/**
	 * The option page document title.
	 *
	 * @var string
	 */
	public $title = 'Cookie Consent';

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
		$builder = new FieldsBuilder('Cookie Consent');
		$builder
			->addGroup('cookie_bar', [
					'label'             => 'Cookie Bar',
					'layout'            => 'row',
					'instructions'      => 'Options for the sticky cookie bar',
					'wpml_cf_preferences' => 3
				])
				->addWysiwyg('text', [
					'label'             => 'Cookie Bar Text',
					'instructions'      => 'Add the text to be displayed in the sticky cookie bar (max 332 characters)',
					'required'          => 1,
					'media_upload'      => 0,
					'maxlength'         => 332
				])
			->endGroup()
			->addGroup('cookie_popup', [
				'label'                 => 'Cookie Popup',
				'layout'                => 'row',
				'instructions'          => 'Options for the cookie popup'])

				->addText('title', [
					'label'             => 'Cookie Popup Title',
					'instructions'      => 'Enter a heading for the cookie settings popup'])
				->addWysiwyg('text', [
					'label'             => 'Cookie Popup text',
					'instructions'      => 'Add text to be displayed in the cookie popup',
					'media_upload'      => 0])
				->addRepeater('settings', [
					'label'             => 'Cookie Popup Settings',
					'instructions'      => 'Add cookie settings for the consent',
					'layout'            => 'table'])

					->addTrueFalse('required', [
						'label'         => 'Setting required',
						'instructions'  => 'Add cookie settings for the consent',
						'wrapper'       => ['width' => 15],
						'ui'            => 0])
					->addTrueFalse('checked', [
						'label'         => 'Setting checked',
						'instructions'  => 'Should this cookie setting be checked by default?',
						'message'       => 'Checked',
						'default_value' => 1,
						'wrapper'       => ['width' => 15],
						'ui'            => 0])
					->conditional('required', '==', '0')
					->addText('label', [
						'instructions'  => 'Add the label text for this cookie setting',
						'required'      => 1,
						'wrapper'       => ['width' => 50]])
					->addText('cookie_value', [
						'instructions'  => 'Enter the cookie value for this setting',
						'required'      => 1,
						'wrapper'       => ['width' => 20]])
				->endRepeater()
			->endGroup();

		return $builder->build();
	}
}
