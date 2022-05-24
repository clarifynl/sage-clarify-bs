@if ($page_modules)
	@foreach ($page_modules as $module)
		@includeIf('modules.'.\App\to_slug($module->acf_fc_layout), ['module' => $module])
	@endforeach
@endif