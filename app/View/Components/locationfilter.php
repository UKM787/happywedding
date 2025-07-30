<?php

namespace App\View\Components;

use Illuminate\View\Component;

class locationfilter extends Component
{
    public $locations, $states;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($locations, $states)
    {
        $this->locations = $locations;
        $this->states = $states;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.locationfilter');
    }
}
