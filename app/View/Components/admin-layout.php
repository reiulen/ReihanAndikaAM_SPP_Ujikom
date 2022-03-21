<?php

namespace App\View\Components;

use Illuminate\View\Component;

class admin-layout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;

    public function __construct($title = '')
    {
        $title = $this->title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-layout');
    }
}
