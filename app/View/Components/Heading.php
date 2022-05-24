<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Heading extends Component
{
	/**
	 * The heading level
	 *
	 * @var string
	 */
	public $level;

	/**
	 * The style classes which will be used in the actual component
	 *
	 * @var string
	 */
	public $styles;

	/**
	 * Add Tailwind classes per heading level
	 *
	 * @var array
	 */
	public $classes = [
		1 => 'font-bold text-3xl lg:text-4xl mb-8',
		2 => 'font-bold text-3xl lg:text-4xl mb-8',
		3 => 'font-bold text-2xl mb-8',
		4 => 'font-bold text-xl mb-4'
	];

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct($level = 1, $styleLevel = null)
	{
		$this->level = $level;
		$this->styles = $this->getStyle($styleLevel ?? $level);
	}

	public function getStyle($level) {
		return isset($this->classes[$level]) ? $this->classes[$level] : '';
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render()
	{
		return view('components.heading');
	}
}
