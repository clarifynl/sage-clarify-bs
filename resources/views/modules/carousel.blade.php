@if ($slides)
	<section class="m-carousel">
		<div class="m-carousel__gallery swiper-container js-image-carousel">
			<div class="swiper-wrapper">
				@foreach ($slides as $slide)
					<div class="m-carousel__item swiper-slide">
						{!! ResponsivePics::get_picture($slide->image, 'xs-full 250, sm-full 250, md-full 350 lg-full 490, xxl-full 800', 'm-carousel__img', true) !!}
						@if ($slide->tagline)
							<label>{!! $slide->tagline !!}</label>
						@endif
					</div>
				@endforeach
			</div>
		</div>
		@include('components.c-nav')
	</section>
@endif