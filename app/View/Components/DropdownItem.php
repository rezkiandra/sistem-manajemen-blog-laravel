<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropdownItem extends Component
{
	public $route, $title;
	/**
	 * Create a new component instance.
	 */
	public function __construct($route = null, $title = null)
	{
		$this->route = $route;
		$this->title = $title;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.dropdown-item');
	}
}
