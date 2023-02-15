module.exports = {
	extends: ['@roots/sage/stylelint-config'],
	rules: {
		'color-no-invalid-hex': true,
		'indentation': 'tab',
		'max-line-length': 250,
		'no-invalid-position-at-import-rule': [
			true,
			{
				ignoreAtRules: ['tailwind'],
			}
		],
		'at-rule-no-unknown': [
			true,
			{
				ignoreAtRules: ['tailwind'],
			}
		]
	}
}