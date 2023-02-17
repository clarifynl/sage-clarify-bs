@extends('layouts.app')

@section('content')
	@include('partials.page-header')
	@if (! have_posts())
		<x-alert type="warning">
			{!! __('Sorry, no results were found.', 'sage') !!}
		</x-alert>
	@endif
	@while(have_posts()) @php(the_post())
		@includeFirst(['sections.content-' . get_post_type(), 'sections.content'])
	@endwhile
	{!! get_the_posts_navigation() !!}
@endsection
@section('sidebar')
	@include('sections.sidebar')
@endsection
