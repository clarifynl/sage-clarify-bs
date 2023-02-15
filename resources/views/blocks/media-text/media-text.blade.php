@isset ($media_text)
	<section class="{{ isset($block) ? $block->classes : '' }}">
		<div class="">
			<figure
				class="
					{!! ($media_text->align === 'left') ? ' md:order-1' : ' md:order-2 xl:col-start-8 ' !!}
					{!! (!isset($media_text->image_json) && $block->preview) ? ' border border-neutral-100' : '' !!}
				">
				@includeWhen(isset($media_text->image_json), 'partials.image-json', [
					'image_json' => $media_text->image_json
				])
			</figure>
			<article
				class="
					{!! ($media_text->align === 'left') ? ' xl:col-start-7 md:order-2' : ' md:order-1' !!}
				">
				@includeWhen(isset($media_text->text), 'partials.text', ['text' => $media_text->text])
			</article>
		</div>
	</section>
@endisset