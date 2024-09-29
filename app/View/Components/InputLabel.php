<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputLabel extends Component
{
	public $label, $name, $type, $placeholder, $options, $value, $min, $max, $col, $field, $step, $multiple, $class, $valueField, $labelField;
	/**
	 * Create a new component instance.
	 */
	public function __construct($label, $name, $type = 'text', $placeholder = null, $options = [], $value = null, $min = 0, $max = null, $col = 12, $field = null, $step = null, $multiple = null, $class = null, $valueField = null, $labelField = null)
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
		$this->field = $field;
		$this->step = $step;
		$this->multiple = $multiple;
		$this->class = $class;
		$this->valueField = $valueField;
		$this->labelField = $labelField;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.input-label');
	}
}
