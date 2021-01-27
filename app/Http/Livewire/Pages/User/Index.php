<?php

namespace App\Http\Livewire\Pages\User;

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
        return view('livewire.pages.user.index', [
            'users' => $this->load()
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
            return config('models.user')::paginate(10);
        }

        // Filter the data with the search value.
        return config('models.user')::where('id', '=', $this->search)
            ->orWhere('email', 'like', "%{$this->search}%")
            ->paginate(10);
    }
}
