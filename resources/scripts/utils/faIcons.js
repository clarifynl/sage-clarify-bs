import {library, dom} from '@fortawesome/fontawesome-svg-core';
import {fab} from '@fortawesome/free-brands-svg-icons';

// add the imported icons to the library
library.add(fab);

// tell FontAwesome to watch the DOM and add the SVGs when it detects icon markup
dom.watch();