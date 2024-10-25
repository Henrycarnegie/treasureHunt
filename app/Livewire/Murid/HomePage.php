<?php

namespace App\Livewire\Murid;

use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        return view('livewire.murid.home-page')->extends('layouts.app');
    }
}
