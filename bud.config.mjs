import path from 'path';
import glob from 'glob';

const toKebabCase = string => string.match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g).join('-');

/**
 * Get list of entrypoints for blocks
 */
const blockFiles = {};

glob.sync('app/Blocks/**/*.php').map(block => {
  const name  = toKebabCase(path.basename(block, '.php')).toLowerCase();
  const files = glob.sync(`resources/views/blocks/${name}/*.{js,scss}`);

  if (files?.length > 0) {
    const filesResult = files.map(file => file.replace(/resources\/views\/blocks/g, '@blocks'));

    blockFiles[name] = filesResult;
  }

  return blockFiles;
});

/**
 * Build configuration
 *
 * @see {@link https://roots.io/docs/sage/ sage documentation}
 * @see {@link https://bud.js.org/guides/configure/ bud.js configuration guide}
 *
 * @typedef {import('@roots/bud').Bud} Bud
 * @param {Bud} app
 */
export default async (app) => {
  /**
   * Global sass imports
   * @see {@link https://bud.js.org/extensions/bud-sass/}
   */
  app.sass.importGlobal([
    '@src/styles/common/variables',
    '~bootstrap/scss/bootstrap-utilities',
    '@src/styles/common/mixins',
    '@src/styles/common/global',
  ])

  /**
   * Application entrypoints
   * @see {@link https://bud.js.org/docs/bud.entry/}
   */
  app
    .alias('@blocks', app.path('@src/views/blocks'))
    .provide({jquery: ['$', 'jQuery']})
    .entry({
      app: ['@scripts/app', '@styles/app'],
      editor: ['@scripts/editor', '@styles/editor'],
      admin: ['@styles/wp-admin'],
      login: ['@styles/wp-login'],
      ...blockFiles
    })

    /**
     * Directory contents to be included in the compilation
     * @see {@link https://bud.js.org/docs/bud.assets/}
     */
    .assets(['images'])

    /**
     * Matched files trigger a page reload when modified
     * @see {@link https://bud.js.org/docs/bud.watch/}
     */
    .watch(['resources/views', 'app'])

    /**
     * Proxy origin (`WP_HOME`)
     * @see {@link https://bud.js.org/docs/bud.proxy/}
     */
    .proxy('https://ona.test')

    /**
     * Development origin
     * @see {@link https://bud.js.org/docs/bud.serve/}
     */
    .serve('http://localhost:3000')

    /**
     * URI of the `public` directory
     * @see {@link https://bud.js.org/docs/bud.setPublicPath/}
     */
    .setPublicPath('/app/themes/sage-clarify-bs/public/')

    /**
     * Generate WordPress `theme.json`
     *
     * @note This overwrites `theme.json` on every build.
     *
     * @see {@link https://bud.js.org/extensions/sage/theme.json/}
     * @see {@link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json/}
     */
    .wpjson.settings({
      color: {
        custom: false,
        customDuotone: false,
        customGradient: false,
        defaultDuotone: false,
        defaultGradients: false,
        defaultPalette: false,
        duotone: [],
      },
      custom: {
        spacing: {},
        typography: {
          'font-size': {},
          'line-height': {},
        },
      },
      spacing: {
        padding: true,
        units: ['px', '%', 'em', 'rem', 'vw', 'vh'],
      },
      typography: {
        customFontSize: false,
      },
    })
    .enable();
};
