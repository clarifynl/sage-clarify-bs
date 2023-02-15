@if (isset($text->title) && $text->title)
	@if (isset($header_size) && $header_size == 'h4')
		<h4 class="typo-h4 mb-[.25em] {!! isset($header_color) ? $header_color : 'text-primary-800' !!}">{!! $text->title !!}</h3>
	@else
		<h3 class="typo-h3 mb-[.5em] {!! isset($header_color) ? $header_color : 'text-primary-800' !!}">{!! $text->title !!}</h3>
	@endif
@elseif ($block->preview)
	<h3 class="typo-h3 mb-[.5em] text-neutral-100">{!! __('Enter a title','sage') !!}</h3>
@endif
@if (isset($text->content) && $text->content)
	<div class="tinymce {!! isset($paragraph_color) ? $paragraph_color : 'text-black' !!}">
		{!! $text->content !!}
	</div>
@elseif ($block->preview)
	<div class="tinymce text-neutral-100">{!! __('Add content','sage') !!}</div>
@endif
@if (isset($text->link) && $text->link)
	<a href="{!! $text->link->url !!}" target="{!! $text->link->target !!}" title={!! $text->link->title !!}>
		<button class="group btn typo-button w-full justify-center md:justify-start md:w-auto mt-4">
			{!! $text->link->title !!}
			<i class="
				icon
				icon-arrow-{!! preg_match('/^(.*).(pdf|doc|xls|gif)$/i', $text->link->url) ? 'bottom' : 'right' !!}
				ml-4
				overflow-hidden
				@if (preg_match('/^(.*).(pdf|doc|xls|gif)$/i', $text->link->url))
					group-hover:animate-bottomfromtop
				@else
					group-hover:animate-rightfromleft
				@endif
			"></i>
		</button>
	</a>
@elseif ($block->preview)
	<div class="typo-md text-neutral-100">{!! __('Add a link','sage') !!}</div>
@endif