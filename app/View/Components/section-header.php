<?php

namespace App\View\Components;

use Illuminate\View\Component;

class section-header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $section;

    public function __construct($section = '')
    {
        $section = $this->section;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.section-header');
    }
}
