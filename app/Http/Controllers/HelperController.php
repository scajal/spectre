<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{
    /**
     * Redirects the user to the home page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function takeMeHome()
    {
        return redirect()->route('people.index');
    }

    /**
     * Logout the user and go back to the login
     * page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function signOut()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
