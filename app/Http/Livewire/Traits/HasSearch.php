<?php

namespace App\Http\Livewire\Traits;

trait HasSearch
{
    /**
     * The search value.
     * 
     * @var string
     */
    public $search;

    /**
     * Creates the trait.
     * 
     * @return void
     */
    public function mountHasSearch()
    {
        $this->fill(request()->only('search'));
    }

    /**
     * Executed when the search value is being updated.
     * 
     * @return void
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }
}