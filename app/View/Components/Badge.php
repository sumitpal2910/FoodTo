<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Badge extends Component
{
    public $class;
    public $text;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class = null, $text)
    {
        $this->class = $class;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.badge');
    }
}
