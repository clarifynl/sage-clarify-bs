<div
	class="form-check{!! $inline ? ' form-check-inline' : '' !!}">
	<input
		id="{!! $value !!}"
		class="form-check-input"
		name="{!! $name !!}"
		type="checkbox"
		value="{!! $value !!}"
		{!! checked($checked) !!}
		{!! disabled($disabled) !!}
		@if ($required)
			required
		@endif
	/>
	<label
		for="{!! $value !!}"
		class="form-check-label">
		{!! $label !!}
	</label>
</div>