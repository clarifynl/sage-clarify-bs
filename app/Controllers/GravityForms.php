<?php

namespace App\Controllers;

class GravityForms
{
	/**
	 * This filter is executed before creating the field’s content, allowing users to completely modify the way the field is rendered.
	 *
	 * Add Bootstrap Form control & check classes
	 */
	public static function control_field_content($content, $field, $value, $lead_id, $form_id) {
		$textual = [
			'date',
			'email',
			'name',
			'number',
			'password',
			'phone',
			'text',
			'website'
		];

		if (in_array($field->type, $textual)) {
			return preg_replace(
				["/type='\w+'/", '/gform-field-label/'],
				['class="form-control" $0', 'gform-field-label form-label'],
				$content
			);
		}

		if ($field->type === 'textarea') {
			return preg_replace(
				["/class='textarea/"],
				['class="textarea form-control'],
				$content
			);
		}

		if ($field->type === 'checkbox' ||
			$field->type === 'radio') {
			return preg_replace(
				['/gchoice/', '/gfield-choice-input/', '/gform-field-label/'],
				['gchoice form-check', 'gfield-choice-input form-check-input', 'gform-field-label form-check-label'],
				$content
			);
		}

		if ($field->type === 'consent') {
			return preg_replace(
				['/ginput_container_consent/', "/type=\'(checkbox|radio)\'/", '/gfield_consent_label/'],
				['ginput_container_consent form-check', 'class="form-check-input" $0', 'gfield_consent_label form-check-label'],
				$content
			);
		}

		return $content;
	}

	/**
	 * Customize gform_button
	 *
	 * Use <button> tag intead of <input> and add Bootstrap btn classes
	 */
	public static function control_submit_button($button, $form) {
		$btn_text = $form['button']['text'] ?? __('Send', 'sage');

		return "<button class='btn btn-primary gform_button' id='gform_submit_button_{$form['id']}' type='submit'>{$btn_text}</button>";
	}

	/**
	 * Fix Gravity forms merge tags error in form notifications due to acorn's laravel
	 *
	 * See: https://github.com/roots/acorn/issues/198
	 */
	public static function fix_acorn_gform_merge_tags() {
		$isGravityFormsEditPage = isset($_GET['page']) && 'gf_edit_forms' === $_GET['page'];

		if (!$isGravityFormsEditPage) {
			return;
		} ?>

		<script type="text/javascript">
			function MaybeAddSaveLinkMergeTag( mergeTags, elementId, hideAllFields, excludeFieldTypes, isPrepop, option ) {
				const eventSelectEl = document.querySelector('select[name="_gform_setting_event"]');
				if(!eventSelectEl) {
					return mergeTags;
				}

				var event = eventSelectEl.value;
				if (event === 'form_saved' || event === 'form_save_email_requested') {
					mergeTags['other'].tags.push({
						tag:  '{save_link}',
						label: <?php echo json_encode(esc_html__('Save & Continue Link', 'gravityforms')); ?>
					});
					mergeTags['other'].tags.push({
						tag:   '{save_token}',
						label: <?php echo json_encode(esc_html__('Save & Continue Token', 'gravityforms')); ?>
					});
				}
				return mergeTags;
			}
		</script>
		<?php
	}
}
