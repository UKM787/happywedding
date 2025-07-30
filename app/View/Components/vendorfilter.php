<?php

namespace App\View\Components;

use Illuminate\View\Component;

class vendorfilter extends Component
{

    public $categories, $items, $vendors;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categories = null, $items, $vendors = null)
    {
        $this->categories = $categories;
        $this->items = $items;
        $this->vendors = $vendors;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.vendorfilter');
    }
}
