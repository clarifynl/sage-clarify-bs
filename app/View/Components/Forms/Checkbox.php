<?php

namespace App\View\Components\Forms;
use Roots\Acorn\View\Component;

class Checkbox extends Component
{
	/**
	 * The checkbox name.
	 *
	 * @var string
	 */
	public $name;

	/**
	 * The checkbox label.
	 *
	 * @var string
	 */
	public $label;

	/**
	 * The checkbox value.
	 *
	 * @var string
	 */
	public $value;

	/**
	 * The checkbox checked status.
	 *
	 * @var boolean
	 */
	public $checked;

	/**
	 * The checkbox disabled state.
	 *
	 * @var boolean
	 */
	public $disabled;

	/**
	 * The checkbox required state.
	 *
	 * @var boolean
	 */
	public $required;

	/**
	 * The checkbox inline state.
	 *
	 * @var boolean
	 */
	public $inline;

	/**
	 * Create the component instance.
	 */
	public function __construct($name, $label, $value = null, $checked = false, $disabled = false, $required = false, $inline = false)
	{
		$this->name     = $name;
		$this->label    = $label;
		$this->value    = $value ?: sanitize_title($label);
		$this->checked  = $checked;
		$this->disabled = $disabled;
		$this->required = $required;
		$this->inline   = $inline;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return $this->view('components.forms.checkbox');
	}
}
