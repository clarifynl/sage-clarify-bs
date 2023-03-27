<?php

namespace App\View\Components;
use Roots\Acorn\View\Component;

class Button extends Component
{
	/**
	 * The html tag for the button.
	 *
	 * @var string
	 */
	public $tag;

	/**
	 * The button label.
	 *
	 * @var string
	 */
	public $label;

	/**
	 * The button target.
	 *
	 * @var string
	 */
	public $target;

	/**
	 * The button url.
	 *
	 * @var uri
	 */
	public $url;

	/**
	 * Should the button be outlined?
	 *
	 * @var boolean
	 */
	public $outline;

	/**
	 * The button icon
	 *
	 * @var string
	 */
	public $icon;

	/**
	 * Position of the button icon
	 *
	 * @var string
	 */
	public $iconPos;

	/**
	 * The button color.
	 *
	 * @var string
	 */
	public $variant;

	/**
	 * The available button variants.
	 *
	 * @var array
	 */
	public $variants = [
		'primary'   => 'btn btn-primary',
		'secondary' => 'btn btn-secondary',
		'success'   => 'btn btn-success',
		'danger'    => 'btn btn-danger',
		'warning'   => 'btn btn-warning',
		'info'      => 'btn btn-info',
		'light'     => 'btn btn-light',
		'dark'      => 'btn btn-dark',
		'link'      => 'btn btn-link'
	];

	/**
	 * The button size
	 *
	 * @var string
	 */
	public $size;

	/**
	 * The available button sizes.
	 *
	 * @var array
	 */
	public $sizes = [
		'sm' => 'btn-sm',
		'lg' => 'btn-lg'
	];

	/**
	 * Create the component instance.
	 */
	public function __construct(
		$label = null,
		$url = null,
		$target = null,
		$size = null,
		$outline = false,
		$icon = null,
		$iconPos = 'after',
		$variant = 'primary'
	) {
		$this->tag      = $url ? 'a' : 'button';
		$this->label    = $label;
		$this->url      = $url;
		$this->target   = $target;
		$this->size     = $size ? $this->sizes[$size] : null;
		$this->outline  = $outline;
		$this->icon     = $icon;
		$this->iconPos  = $iconPos;
		$this->variant  = $this->variants[$variant];

		if ($outline && $variant !== 'link') {
			$this->variant = str_replace('btn-', 'btn-outline-', $this->variant);
		}

		if ($size) {
			$this->variant = $this->variant .' '. $this->size;
		}
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return $this->view('components.button');
	}
}
