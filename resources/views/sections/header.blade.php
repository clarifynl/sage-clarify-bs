<header class="header js-header">
	<div class="header__wrap">
		<a class="header__brand" href="{{ $home_url }}" title="{!! $site_name !!}">
			@svg('images.logo-placeholder', 'header__logo')
		</a>
		<button class="header__toggle js-hamburger-button" type="button" aria-label="{!! __('Toggle navigation', 'sage') !!}">
			<span class="header__menu"></span>
			<span>{!! __('Menu', 'sage') !!}</span>
		</button>
		<div class="header__nav">
			@include('partials.navigation')
		</div>
	</div>
</header>

