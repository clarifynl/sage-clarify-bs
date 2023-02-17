<footer class="footer">
	<div class="footer__wrap">
		<a class="footer__brand" href="{{ $home_url }}" title="{!! $site_name !!}">
			@svg('images.logo-placeholder', 'footer__logo')
		</a>
		<section class="footer__nav">
			@include('partials.navigation', [
				'nav_menu' => 'footer_menu'
			])
		</section>
		<section class="footer__service">
			@include('partials.navigation', [
				'nav_menu' => 'service_menu'
			])
		</section>
		<section class="footer__socials">
			@include('partials.socials')
		</section>
	</div>
</footer>
