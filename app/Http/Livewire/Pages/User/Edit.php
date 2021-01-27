<?php

namespace App\Http\Livewire\Pages\User;

use Livewire\Component;
use App\Http\Livewire\Traits\HasValidation;
use App\Http\Livewire\Traits\Notifies;

class Edit extends Component
{
    use HasValidation, Notifies;

    /**
     * The password.
     * 
     * @var string
     */
    public $password;

    /**
     * The password confirmation.
     * 
     * @var string
     */
    public $password_confirmation;

    /**
     * The user.
     * 
     * @var User
     */
    public $user;

    /**
     * The rules applied for validation.
     * 
     * @var array
     */
    public $rules = [
        'password' => 'required|string|confirmed'
    ];

    /**
     * Executed when the component is mounted.
     * 
     * @param int $id
     * @return void
     */
    public function mount($id)
    {
        $this->user = config('models.user')::findOrFail($id);
    }

    /**
     * Renders the component.
     * 
     * @return View
     */
    public function render()
    {
        return view('livewire.pages.user.edit');
    }

    /**
     * Save the user with the new data.
     * 
     * @return void
     */
    public function save()
    {
        /* Save the edited user and notify the authenticated
         * user that it was edited. */
        $this->user->update($this->validate());

        // Redirect and notify.
        $this->redirectAndNotify(route('users.index'), explode('@', $this->user->email)[0] . '\'s password changed successfully');
    }
}
