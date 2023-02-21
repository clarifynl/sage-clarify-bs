<section class="{{ $block->classes }}">
	<div class="{{ $block->classes }}__wrap">
		<h1 class="{{ $block->classes }}__title">{!! $title !!}</h1>
		<figure class="{{ $block->classes }}__media
			{!! (!isset($image) && $block->preview) ? 'select-image' : '' !!}">
			@if ($image)
				{!! \ResponsivePics::get_image($image, 'xs-12, md-6', null, $block->classes . '__image', true); !!}
			@endif
		</figure>
	</div>
</section>