<?php

namespace App\View\Components;
use Roots\Acorn\View\Component;

class Badge extends Component
{
	/**
	 * The badge name.
	 *
	 * @var string
	 */
	public $name;

	/**
	 * The badge label.
	 *
	 * @var string
	 */
	public $label;

	/**
	 * The badge value.
	 *
	 * @var string
	 */
	public $value;

	/**
	 * Is the badge removable.
	 *
	 * @var boolean
	 */
	public $remove;

	/**
	 * The badge color.
	 *
	 * @var string
	 */
	public $type;

	/**
	 * The badge colors.
	 *
	 * @var array
	 */
	public $types = [
		'primary'   => 'badge text-bg-primary',
		'secondary' => 'badge text-bg-secondary',
		'success'   => 'badge text-bg-success',
		'danger'    => 'badge text-bg-danger',
		'warning'   => 'badge text-bg-warning',
		'info'      => 'badge text-bg-info',
		'light'     => 'badge text-bg-light',
		'dark'      => 'badge text-bg-dark'
	];

	/**
	 * Create the component instance.
	 */
	public function __construct($name = null, $label = null, $value = null, $remove = false, $type = 'primary')
	{
		$this->name   = $name;
		$this->label  = $label;
		$this->value  = $value ?: sanitize_title($label);
		$this->remove = $remove;
		$this->type   = $this->types[$type] ?? $this->types['primary'];
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return $this->view('components.badge');
	}
}
