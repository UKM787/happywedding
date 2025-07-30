<?php

namespace App\View\Components;

use Illuminate\View\Component;

class taskfilter extends Component
{
    public $tasks, $allTask, $categories;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tasks, $categories)
    {
        $this->tasks = $tasks;
        $this->categories = $categories;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.taskfilter');
    }
}
