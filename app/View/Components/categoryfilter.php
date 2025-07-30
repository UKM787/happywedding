<?php

namespace App\View\Components;

use Illuminate\View\Component;

class categoryfilter extends Component
{

    public $items, $categories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($items, $categories)
    {
        $this->items = $items;
        $this->categories = $categories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.categoryfilter');
    }
}
