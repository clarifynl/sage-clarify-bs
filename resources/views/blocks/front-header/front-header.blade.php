@isset ($hero)
	<section class="{{ $block->classes }}">
		<div class="{{ $block->classes }}__wrapper">
			@dump($hero)
		</div>
	</section>
@endisset