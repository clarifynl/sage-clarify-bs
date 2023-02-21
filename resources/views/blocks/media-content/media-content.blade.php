@isset ($media_content, $block)
	<section class="{{ $block->classes }}">
		<div class="{{ $block->classes }}__wrap">
			<figure
				class="{{ $block->classes }}__media
					align-{!! $media_content->align !!}
					{!! (!isset($media_content->image_json) && $block->preview) ? 'select-image' : '' !!}
				">
				@includeWhen(isset($media_content->image_json), 'partials.image-json', [
					'image_json' => $media_content->image_json
				])
			</figure>
			<article
				class="{{ $block->classes }}__text align-{!! $media_content->align !!}">
				@includeWhen(isset($media_content->text), 'partials.text', ['text' => $media_content->text])
			</article>
		</div>
	</section>
@endisset