<?php

namespace App\Http\Livewire\Traits;

trait HasValidation
{
    /**
     * Executed after a wired property has been
     * updated.
     * 
     * @param string $propertyName
     * @return void
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}