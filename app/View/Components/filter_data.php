<?php

namespace App\View\Components;

use Illuminate\View\Component;

class filter_data extends Component
{

    public $url;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url, $start = null, $end = null)
    {
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.filter_data');
    }
}
