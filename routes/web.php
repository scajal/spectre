<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\HelperController@takeMeHome')->name('home');

/*
|--------------------------------------------------------------------------
| Authentication routes.
|--------------------------------------------------------------------------
*/

Route::get('/login', App\Http\Livewire\Pages\Auth\SignIn::class)->name('login')->middleware('guest');

Route::get('/logout', 'App\Http\Controllers\HelperController@signOut')->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| User routes.
|--------------------------------------------------------------------------
*/

Route::get('/users', App\Http\Livewire\Pages\User\Index::class)->name('users.index')->middleware('auth');

Route::get('/users/create', App\Http\Livewire\Pages\User\Create::class)->name('users.create')->middleware('auth');

Route::get('/users/{id}/edit', App\Http\Livewire\Pages\User\Edit::class)->name('users.edit')->middleware('auth');

/*
|--------------------------------------------------------------------------
| People routes.
|--------------------------------------------------------------------------
*/

Route::get('/people', App\Http\Livewire\Pages\Person\Index::class)->name('people.index')->middleware('auth');

Route::get('/people/create', App\Http\Livewire\Pages\Person\Create::class)->name('people.create')->middleware('auth');

Route::get('/people/{id}/edit', App\Http\Livewire\Pages\Person\Edit::class)->name('people.edit')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Version routes.
|--------------------------------------------------------------------------
*/

Route::get('/version', App\Http\Livewire\Pages\Version::class)->name('version')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Fallback route.
|--------------------------------------------------------------------------
*/

Route::fallback('App\Http\Controllers\HelperController@takeMeHome');