<article @php(post_class('grid grid-cols-6 mt-32 mb-32'))>
	<header class="entry-header col-span-6 sm:col-span-2">
		<h1 class="entry-title font-serif text-2xl font-bold mx-4 sm:mx-8 mb-16">{!! $title !!}</h1>
		@if ($image)
			{!! ResponsivePics::get_image($fimage, 'xs-4', null, true) !!}
		@endif
	</header>
	<div class="entry-content col-span-6 mx-4 sm:col-span-3 sm:mx-8">
		@php(the_content())
	</div>
</article>
