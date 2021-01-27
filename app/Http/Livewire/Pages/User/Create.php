<?php

namespace App\Http\Livewire\Pages\User;

use Livewire\Component;
use App\Http\Livewire\Traits\HasValidation;
use App\Http\Livewire\Traits\Notifies;

class Create extends Component
{
    use HasValidation, Notifies;

    /**
     * The email.
     * 
     * @var string
     */
    public $email;

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
     * The validation rules applied to the 
     * properties.
     * 
     * @var array
     */
    public $rules = [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|confirmed'
    ];

    /**
     * Renders the component.
     * 
     * @return View
     */
    public function render()
    {
        return view('livewire.pages.user.create');
    }

    /**
     * Create the user with the given data.
     * 
     * @return void
     */
    public function save()
    {
        // Create the user with the validated information.
        config('models.user')::create($this->validate());

        // Redirect and notify.
        $this->redirectAndNotify(route('users.index'), "{$this->email} created successfully");
    }
}
