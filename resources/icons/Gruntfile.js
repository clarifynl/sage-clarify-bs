module.exports = grunt => {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		webfont: {
			icons: {
				src: 'svg/*.svg',
				dest: '../fonts/icons',
				destCss: '../styles/common',
				options: {
					destHtml: '../fonts/icons',
					font: 'icons',
					fontFilename: 'icons',
					hashes: false,
					htmlDemoFilename: 'icons',
					types: 'woff,woff2',
					order: 'woff2,woff',
					syntax: 'bem',
					stylesheet: 'scss',
					relativeFontPath: '~@fonts/icons',
					template: 'templates/icons.tmpl.scss',
					templateOptions: {
						baseClass: 'icon',
						classPrefix: 'icon-'
					},
					customOutputs: [{
						template: 'templates/icons-glyph.json',
						dest    : '../fonts/icons/icons.json'
					}]
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-webfont');
	grunt.registerTask('default', ['webfont']);
};
