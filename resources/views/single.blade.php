@extends('layouts.app')

@section('content')
	@while(have_posts()) @php(the_post())
		@includeFirst(['sections.content-' . get_post_type(), 'sections.content'])
	@endwhile
@endsection
