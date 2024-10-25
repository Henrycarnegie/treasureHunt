<?php

namespace App\Livewire\Murid;

use Livewire\Component;

class Leaderboard extends Component
{
    public function render()
    {
        return view('livewire.murid.leaderboard')->extends('layouts.app');
    }
}
