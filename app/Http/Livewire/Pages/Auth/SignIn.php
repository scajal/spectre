<?php

namespace App\Http\Livewire\Pages\Auth;

use Livewire\Component;
use App\Http\Livewire\Traits\HasValidation;
use App\Http\Livewire\Traits\Notifies;

class SignIn extends Component
{
    use HasValidation, Notifies;

    /**
     * The email address.
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
     * The validation rules applied to the properties.
     * 
     * @var array
     */
    public $rules = [
        'email' => 'required|email|exists:users,email',
        'password' => 'required|string'
    ];

    /**
     * Renders the component.
     * 
     * @return View
     */
    public function render()
    {
        return view('livewire.pages.auth.sign-in');
    }

    /**
     * Attempt to sign in the user with the given
     * credentials.
     * 
     * @return mixed
     */
    public function signIn()
    {
        if (auth()->attempt($this->validate()))
            return redirect()->route('home');

        // The password is incorrect.
        $this->addError('password', 'Invalid password');
    }
}
