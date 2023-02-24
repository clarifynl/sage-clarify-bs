<header class="header js-header">
	<div class="header__wrap">
		<a class="header__brand" href="{{ $home_url }}" title="{!! $site_name !!}">
			@svg('images.logo-placeholder', 'header__logo')
		</a>
		<div id="navMain" class="header__nav collapse">
			@include('partials.navigation')
		</div>
		<button
			class="header__toggle"
			type="button"
			data-bs-toggle="collapse"
			data-bs-target="#navMain"
			aria-controls="navMain"
			aria-expanded="false"
			aria-label="{!! __('Toggle navigation', 'sage') !!}"
		>
			<span class="header__menu">{!! __('Menu', 'sage') !!}</span>
			<span class="header__icon navbar-toggler-icon"></span>
		</button>
	</div>
</header>

