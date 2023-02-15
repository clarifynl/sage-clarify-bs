module.exports = {
	customSyntax: 'postcss-scss',
	extends: [
		'@roots/sage/stylelint-config',
		'@roots/bud-sass/stylelint-config'
	],
	plugins: [
		'stylelint-scss'
	],
	rules: {
		'color-no-invalid-hex': true,
		'indentation': 'tab',
		'max-line-length': 250
	}
}