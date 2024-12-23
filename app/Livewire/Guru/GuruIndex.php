<?php

namespace App\Livewire\Guru;

use App\Models\Murid;
use App\Models\User;
use Livewire\Component;

class GuruIndex extends Component
{
    public $scores = [];


    public function mount()
    {
        $murids = Murid::whereIn('users_id', [2, 3, 4, 5])->get();

        foreach ($murids as $murid) {
            $totalScore = $murid->score_level_1 + $murid->score_level_2 + $murid->score_level_3 + $murid->score_level_4 + $murid->score_level_5;
            $userName = User::find($murid->users_id)->name;
            $this->scores[$murid->users_id] = [
                'name' => $userName,
                'score' => $totalScore,
            ];
        }

        uasort($this->scores, function($a, $b) {
            return $b['score'] - $a['score'];
        });
    }

    public function render()
    {
        return view('livewire.guru.guru-index')->extends('layouts.guru.app');
    }
}
