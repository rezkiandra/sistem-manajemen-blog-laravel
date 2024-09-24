<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarDropdown extends Component
{
	public $title, $icon, $active;
	/**
	 * Create a new component instance.
	 */
	public function __construct($title = null, $icon = null, $active = false)
	{
		$this->title = $title;
		$this->icon = $icon;
		$this->active = $active;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.sidebar-dropdown');
	}
}
