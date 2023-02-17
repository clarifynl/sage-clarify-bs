@if ($socials)
	<nav class="socials">
		@foreach ($socials as $social)
			<a class="socials__link" href="{{ $social->link }}" rel="noopener noreferrer" title="{!! sprintf(__('Follow us on %s', 'sage'), $social->icon->id) !!}" target="_blank">
				<i class="fa {{ $social->icon->class }}"></i>
			</a>
		@endforeach
	</nav>
@endif