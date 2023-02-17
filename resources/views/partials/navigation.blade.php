@if ($navigation)
	<ul class="nav {!! $nav_class ?? '' !!}">
		@foreach ($navigation as $item)
			<li class="nav__item {{ $item->classes ?? '' }}">
				<a
					href="{{ $item->url }}"
					class="nav__link{{ $item->children ? ' nav__toggle' : '' }}{{ $item->active ? ' active' : '' }}">
					{!! $item->label !!}
				</a>
				@if ($item->children)
					<ul class="nav__submenu">
						@foreach ($item->children as $child)
							<li class="nav__subitem {{ $child->classes ?? '' }}">
								<a
									href="{{ $child->url }}"
									class="nav__sublink{{ $child->active ? ' active' : '' }}">
									{!! $child->label !!}
								</a>
							</li>
						@endforeach
					</ul>
				@endif
			</li>
		@endforeach
	</ul>
@endif