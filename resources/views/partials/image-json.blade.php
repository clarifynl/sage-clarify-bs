@if ($image_json->image || $image_json->json)
	@if (!$use_json && $image_json->image)
		{!! \ResponsivePics::get_image(
			$image_json->image,
			(isset($image_sizes) ? $image_sizes : 'xs-12, md-6'),
			(isset($image_crop) ? $image_crop : null),
			(isset($classes) ? $classes : ''),
			true
		); !!}
	@elseif ($use_json && $lottie->file)
		<lottie-player
			id="lottie_{{ $block ? $block->block->id : '' }}"
			src="{!! $lottie->file->url !!}"
			@if ($lottie->interactive)
				data-lottie-mode="{!! $lottie->mode !!}"
				data-lottie-frames="{!! $lottie->frames !!}"
				@if ($lottie->mode === 'cursor')
					data-lottie-type="{!! $lottie->cursor_type !!}"
				@elseif ($lottie->mode === 'scroll')
					data-lottie-type="{!! $lottie->scroll_type !!}"
					@if ($lottie->scroll_type === 'container')
						data-lottie-scroll-container="{!! $lottie->scroll_container !!}"
					@endif
					@if ($lottie->scroll_type === 'offset')
						data-lottie-scroll-offset-start="{!! $lottie->scroll_offset->start !!}"
						data-lottie-scroll-offset-end="{!! $lottie->scroll_offset->end !!}"
					@endif
					@if ($lottie->scroll_type === 'loop')
						data-lottie-scroll-loop-start="{!! $lottie->scroll_loop->start !!}"
						data-lottie-scroll-loop-end="{!! $lottie->scroll_loop->end !!}"
					@endif
					@if ($lottie->scroll_type === 'play' ||
						$lottie->scroll_type === 'playOnce')
						data-lottie-scroll-visibility-start="{!! $lottie->scroll_visibility->start !!}"
						data-lottie-scroll-visibility-end="{!! $lottie->scroll_visibility->end !!}"
					@endif
				@endif
			@else
				@if ($lottie->autoplay)
					autoplay
				@endif
				@if ($lottie->loop)
					loop
				@endif
			@endif
		/>
	@endif
@elseif ($block->preview)
	<p class="preview">{!! __('Select/upload an image/json','sage') !!}</p>
@endif