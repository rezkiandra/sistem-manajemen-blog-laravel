<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateForm extends Component
{
	public $action;
	/**
	 * Create a new component instance.
	 */
	public function __construct($action = null)
	{
		$this->action = $action;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.create-form');
	}
}
