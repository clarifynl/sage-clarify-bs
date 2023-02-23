@if ($cookie_bar)
	<section class="cookie-bar js-cookie-bar hidden" data-cookie-expiration="{!! $cookie_bar->expiration !!}">
		<div class="cookie-bar__content js-consent-text">
			@if ($cookie_bar->title)
				<h5 class="cookie-bar__title">{!! $cookie_bar->title !!}</h5>
			@endif
			@if ($cookie_bar->text)
				<div class="cookie-bar__text">{!! $cookie_bar->text !!}</div>
			@endif
		</div>
		@if ($consent_types)
			<ul class="cookie-bar__types js-consent-types hidden">
				@foreach ($consent_types as $type)
					<li class="cookie-bar__type">
						<x-forms.checkbox
							:name="sanitize_title($type->type)"
							:value="$type->type"
							:label="$type->label"
							:checked="$type->enabled"
							:disabled="$type->required"
							:required="$type->required"
							:inline="true"
						/>
					</li>
				@endforeach
			</ul>
		@endif
		<div class="cookie-bar__actions">
			<div class="cookie-bar__buttons hidden js-consent-btns1">
				<button
					class="btn btn-outline-primary js-consent-cancel"
					type="button"
					title="{!! __('Cancel', 'sage') !!}">
					{!! __('Cancel', 'sage') !!}
				</button>
				<button
					class="btn btn-primary js-consent-save"
					type="button"
					title="{!! __('Save', 'sage') !!}">
					{!! __('Save', 'sage') !!}
				</button>
			</div>
			<div class="cookie-bar__buttons js-consent-btns2">
				<button
					class="btn btn-outline-primary js-consent-settings"
					type="button"
					title="{!! __('Settings', 'sage') !!}">
					{!! __('Settings', 'sage') !!}
				</button>
				<button
					class="btn btn-primary js-consent-accept"
					type="button"
					title="{!! __('Accept all', 'sage') !!}">
					{!! __('Accept all', 'sage') !!}
				</button>
			</div>
		</div>
	</section>
@endif