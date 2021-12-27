<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class ContentHeader extends Component
{
    public $title;
    public $count;
    public $prefix;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $count = '', $prefix = "")
    {
        $this->title = $title;
        $this->count = $count;
        $this->prefix = $prefix;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.content-header');
    }
}
