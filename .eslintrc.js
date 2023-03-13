module.exports = {
	root: true,
	extends: [
		'@clarifynl/eslint-config-clarify'
	],
	globals: {
		jQuery: 'readonly'
	},
	overrides: [
		{
			files: [ '**/*.jsx' ],
			extends: [
				'plugin:@wordpress/eslint-plugin/recommended',
				'@clarifynl/eslint-config-clarify/react'
			],
			rules: {
				'react-hooks/rules-of-hooks': 'off'
			}
		}
	]
}