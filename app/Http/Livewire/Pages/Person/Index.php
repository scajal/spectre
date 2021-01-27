<?php

namespace App\Http\Livewire\Pages\Person;

use Livewire\Component;
use App\Http\Livewire\Traits\HasSearch;
use Livewire\WithPagination;

class Index extends Component
{
    use HasSearch, WithPagination;

    /**
     * The query string.
     * 
     * @var array
     */
    protected $queryString = ['search' => ['except' => '']];

    /**
     * Renders the component.
     * 
     * @return View
     */
    public function render()
    {
        return view('livewire.pages.person.index', [
            'people' => $this->load()
        ]);
    }

    /**
     * Load the relevant data.
     * 
     * @return Collection<Model>
     */
    public function load()
    {
        // Check if we need to filter the data.
        if (empty($this->search)) {
            return config('models.person')::paginate(10);
        }

        // Filter the data with the search value.
        return config('models.person')::where('id', '=', $this->search)
            ->orWhere('first_name', 'like', "%{$this->search}%")
            ->orWhere('last_name', 'like', "%{$this->search}%")
            ->paginate(10);
    }
}
