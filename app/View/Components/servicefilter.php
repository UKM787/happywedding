<?php

namespace App\View\Components;

use Illuminate\View\Component;

class servicefilter extends Component
{

    public $items, $services;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($items, $services)
    {
        $this->items = $items;
        $this->services = $services;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.servicefilter');
    }
}
