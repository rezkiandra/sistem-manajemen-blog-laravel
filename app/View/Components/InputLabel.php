<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputLabel extends Component
{
	public $label, $name, $type, $placeholder, $options, $value, $min, $max, $col;
	/**
	 * Create a new component instance.
	 */
	public function __construct($label, $name, $type = 'text', $placeholder = null, $options = [], $value = null, $min = 0, $max = null, $col = 12)
	{
		$this->label = $label;
		$this->name = $name;
		$this->type = $type;
		$this->placeholder = $placeholder;
		$this->options = $options;
		$this->value = $value;
		$this->min = $min;
		$this->max = $max;
		$this->col = $col;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.input-label');
	}
}
