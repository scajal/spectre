<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class NavigationBar extends Component
{
    /**
     * Menu opened.
     * 
     * @var boolean
     */
    public $menuOpen;

    /**
     * Creates the component.
     * 
     * @return void
     */
    public function mount()
    {
        $this->menuOpen = false;
    }

    /**
     * Renders the component.
     * 
     * @return View
     */
    public function render()
    {
        return view('livewire.components.navigation-bar');
    }
}
