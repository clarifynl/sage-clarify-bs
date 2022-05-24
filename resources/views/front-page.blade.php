@extends('layouts.app')

@section('content')
	@while(have_posts()) @php(the_post())
		@include('partials.page-hero')
		@include('partials.page-content')
		@include('partials.page-modules')
	@endwhile
@endsection
