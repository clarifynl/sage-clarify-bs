($ => {
	/**
	 * initializeBlock
	 *
	 * Adds custom JavaScript to the block HTML.
	 *
	 * @date    15/4/19
	 * @since   1.0.0
	 *
	 * @param   object $block The block jQuery element.
	 * @param   object attributes The block attributes (only available when editing).
	 * @return  void
	 */

	// Initialize each block
	const initializeBlock = $block => {
		// Do stuff
		console.log($block);
	}

	// Initialize each block on page load (front end).
	$(document).ready(() => {
		const $blocks = $('.wp-block-media-content');

		$blocks.each((i, el) => {
			initializeBlock($(el));
		});
	});

	// Initialize dynamic block preview (editor).
	if (window.acf) {
		window.acf.addAction('render_block_preview/type=media-content', initializeBlock);
	}
})(jQuery);