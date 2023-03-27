<{{ $tag }}
	{{ $attributes->merge(['class' => $variant]) }}
	@if ($url)
		href="{!! $url !!}"
		target="{!! $target ?: '_self' !!}"
		role="button"
	@else
		type="button"
	@endif
	{{ $attributes->merge() }}
	>
	@if ($icon && $iconPos === 'before')
		<i class="icon icon-{!! $icon !!}"></i>
	@endif
	<span>{!! $label ?? $slot !!}</span>
	@if ($icon && $iconPos === 'after')
		<i class="icon icon-{!! $icon !!}"></i>
	@endif
</{{ $tag }}>