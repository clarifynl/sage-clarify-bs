<a class="visually-hidden-focusable" href="#main">{{ __('Skip to content') }}</a>

@include('sections.header')
<main id="main" class="main">
	@yield('content')
</main>
@hasSection('sidebar')
	<aside class="sidebar">
		@yield('sidebar')
	</aside>
@endif
@include('sections.footer')
@include('sections.cookie-bar')
@include('sections.breakpoint-sniffer')