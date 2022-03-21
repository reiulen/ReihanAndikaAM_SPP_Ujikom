<?php

namespace App\View\Components;

use Illuminate\View\Component;

class error-alert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $error;
    public function __construct($error = '')
    {
        $error = $this->error
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.error-alert');
    }
}
