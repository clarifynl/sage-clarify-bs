<span {{ $attributes->merge(['class' => $type]) }}>
	<span class="badge__label">{!! $label !!}</span>
	@if ($remove)
		<a class="badge__close js-close-badge" data-key="{!! $name !!}" data-value="{!! $value !!}"></a>
	@endif
</span>