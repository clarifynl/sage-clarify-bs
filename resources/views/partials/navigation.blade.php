@if ($navigation)
	<ul class="nav {!! $nav_class ?? '' !!}">
		@foreach ($navigation as $item)
			<li class="nav-item {{ $item->classes ?? '' }}{{ $item->children ? ' dropdown' : '' }}">
				@if ($item->children)
					<a
						href="#"
						data-bs-toggle="dropdown"
						role="button"
						aria-expanded="false"
						class="nav-link dropdown-toggle">
						{!! $item->label !!}
					</a>
					<ul class="dropdown-menu">
						@foreach ($item->children as $child)
							<li class="nav-item {{ $child->classes ?? '' }}">
								<a
									href="{{ $child->url }}"
									class="dropdown-item{{ $child->active ? ' active' : '' }}">
									{!! $child->label !!}
								</a>
							</li>
						@endforeach
					</ul>
				@else
					<a
						href="{{ $item->url }}"
						class="nav-link{{ $item->active ? ' active' : '' }}">
						{!! $item->label !!}
					</a>
				@endif
			</li>
		@endforeach
	</ul>
@endif