<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthForm extends Component
{
	public $title, $description, $action;
	/**
	 * Create a new component instance.
	 */
	public function __construct($title = null, $description = null, $action = null)
	{
		$this->title = $title;
		$this->description = $description;
		$this->action = $action;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.auth-form');
	}
}
