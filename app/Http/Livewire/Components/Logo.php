<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Logo extends Component
{
    /**
     * The size.
     * 
     * @var string
     */
    public $size;

    /**
     * Renders the component.
     * 
     * @return View
     */
    public function render()
    {
        return view('livewire.components.logo');
    }
}
