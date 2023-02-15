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
					'label'        => 'Cookie Bar',
					'layout'       => 'block',
					'instructions' => 'Options for the cookie consent bar'
				])
				->addNumber('expiration', [
					'label'         => 'Expiration',
					'instructions'  => 'Set the cookie expiration in days',
					'required'      => 0,
					'default_value' => 365,
					'append'        => 'days',
					'min'           => 30,
					'max'           => 365
				])
				->addText('title', [
					'label'        => 'Title',
					'instructions' => 'Add the title to be displayed in the cookie bar'
				])
				->addWysiwyg('text', [
					'label'        => 'Text',
					'instructions' => 'Add the text to be displayed in the cookie bar (max 332 characters)',
					'required'     => 1,
					'media_upload' => 0,
					'maxlength'    => 332
				])
			->endGroup()
			->addRepeater('consent_types', [
				'label'        => 'Types',
				'instructions' => 'Add cookie consent types',
				'button_label' => 'Add type'
			])
				->addTab('settings', [
					'label'     => 'Settings'
				])
					->addTrueFalse('required', [
						'label'         => 'Consent type required',
						'instructions'  => 'Is this consent type required?',
						'wrapper'       => ['width' => 15]
					])
					->addTrueFalse('enabled', [
						'label'         => 'Consent type enabled',
						'instructions'  => 'Should this consent type be preselected?',
						'default_value' => 1,
						'wrapper'       => ['width' => 15]
					])
					->conditional('required', '==', '0')
					->addText('label', [
						'label'         => 'Consent type label',
						'instructions'  => 'Add a label for this consent type',
						'required'      => 1,
						'wrapper'       => ['width' => 50]
					])
					->addSelect('type', [
						'instructions'  => 'Select the <a href="https://support.google.com/tagmanager/answer/10718549?hl=en#consent-types" target="_blank" title="Tag Manager consent types">Tag Manager consent type</a>',
						'choices'       => ['ad_storage', 'analytics_storage', 'functionality_storage', 'personalization_storage', 'security_storage'],
						'default_value' => 'functionality_storage',
						'required'      => 1
					])
				->addTab('information', [
					'label'     => 'Information'
				])
					->addText('title', [
						'label'         => 'Consent type title',
						'instructions'  => 'Add a title for this consent type'
					])
					->addWysiwyg('description', [
						'label'         => 'Consent type description',
						'instructions'  => 'Add a description for this consent type'
					])
				->addTab('cookies', [
					'label'     => 'Cookies'
				])
					->addRepeater('cookies', [
						'label'        => 'Consent type cookies',
						'instructions' => 'Add used cookies to this consent type',
						'collapsed'    => 'name',
						'layout'       => 'block',
						'button_label' => 'Add Cookie',
					])
						->addText('name', [
							'instructions'  => 'Add the cookie name',
							'required'      => 1
						])
						->addText('purpose', [
							'instructions'  => 'Describe the purpose for this cookie',
							'required'      => 1
						])
						->addText('provider', [
							'instructions'  => 'Add the provider off this cookie',
							'required'      => 1,
							'default_value' => '.' . $_SERVER['SERVER_NAME']
						])
						->addText('expiration', [
							'instructions'  => 'Enter the expiration time for this cookie',
							'required'      => 1,
							'default_value' => 'Session'
						])
						->addSelect('type', [
							'instructions'  => 'Select the cookie type',
							'choices'       => ['HTTP', 'Pixel', 'HTML'],
							'default_value' => 'HTTP',
							'required'      => 1
						])
					->endRepeater()
			->endRepeater();

		return $builder->build();
	}
}
