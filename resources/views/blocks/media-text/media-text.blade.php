@isset ($media_text, $block)
	<section class="{{ $block->classes }}">
		<div class="{{ $block->classes }}__wrapper">
			<figure
				class="{{ $block->classes }}__media
					align-{!! $media_text->align !!}
					{!! (!isset($media_text->image_json) && $block->preview) ? 'select-image' : '' !!}
				">
				@includeWhen(isset($media_text->image_json), 'partials.image-json', [
					'image_json' => $media_text->image_json
				])
			</figure>
			<article
				class="{{ $block->classes }}__text align-{!! $media_text->align !!}">
				@includeWhen(isset($media_text->text), 'partials.text', ['text' => $media_text->text])
			</article>
		</div>
	</section>
@endisset