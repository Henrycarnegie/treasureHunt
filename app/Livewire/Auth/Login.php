<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    /** @var string */
    public $username = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    protected $rules = [
        'username' => ['required'],
        'password' => ['required'],
    ];

    public function authenticate()
    {
        $this->validate();

        if (!Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
            $this->addError('username', trans('auth.failed'));

            return;
        }

        $user = Auth::user();

        if ($user->hasRole('guru')) {
            return redirect()->intended(route('guru.dashboard'));
        }

        if ($user->hasRole('polisi') || $user->hasRole('detektif') || $user->hasRole('nelayan') || $user->hasRole('petani')) {
            return redirect()->intended(route('murid.home'));
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
