@if ($navigation)
	<nav class="h-full">
		<ul class="flex h-full">
			@foreach ($navigation as $item)
				<li class="h-full">
					<a
						href="{{ $item->url }}"
						target="{!! $item->target !!}"
						class="flex items-center h-full px-8 hover:underline {{ $item->children ? ' dropdown-toggle' : '' }}{{ $item->active ? ' active' : '' }}">
						{!! $item->label !!}
					</a>
					@if ($item->children)
						<ul class="dropdown-menu">
							@foreach ($item->children as $child)
								<li class="nav-item">
									<a
										href="{{ $child->url }}"
										target="{!! $item->target !!}"
										class="dropdown-item {{ $child->active ? ' active' : '' }}">
										{!! $child->label !!}
									</a>
								</li>
							@endforeach
						</ul>
					@endif
				</li>
			@endforeach
		</ul>
	</nav>
@endif