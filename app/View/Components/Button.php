<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
	public $title, $type, $class, $icon;
	/**
	 * Create a new component instance.
	 */
	public function __construct($title = null, $type = 'button', $class = 'primary', $icon = null)
	{
		$this->title = $title;
		$this->type = $type;
		$this->class = $class;
		$this->icon = $icon;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.button');
	}
}
