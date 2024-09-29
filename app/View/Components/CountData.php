<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CountData extends Component
{
	public $count, $label, $icon;
	/**
	 * Create a new component instance.
	 */
	public function __construct($count = 0, $label = null, $icon = null)
	{
		$this->count = $count;
		$this->label = $label;
		$this->icon = $icon;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.count-data');
	}
}
