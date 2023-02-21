@isset ($hero)
	<section class="{{ $block->classes }}">
		<div class="{{ $block->classes }}__wrap">
			<figure
				class="{{ $block->classes }}__media
					{!! (!isset($hero->image_json) && $block->preview) ? 'select-image' : '' !!}
				">
				@includeWhen(isset($hero->image_json), 'partials.image-json', [
					'image_json' => $hero->image_json
				])
			</figure>
			<h1 class="{{ $block->classes }}__title">{!! $hero->title ?? $title !!}</h1>
		</div>
	</section>
@endisset