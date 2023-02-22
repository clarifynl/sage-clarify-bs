<div
	class="form-check{!! $inline ? ' form-check-inline' : '' !!}">
	<input
		id="{!! $name !!}"
		class="form-check-input"
		type="checkbox"
		value="{!! $value !!}"
		{!! checked($checked) !!}
		{!! disabled($disabled) !!}
		@if ($required)
			required
		@endif
	/>
	<label
		for="{!! $name !!}"
		class="form-check-label">
		{!! $label !!}
	</label>
</div>