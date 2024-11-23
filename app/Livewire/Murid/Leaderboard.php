<?php

namespace App\Livewire\Murid;

use App\Models\Murid;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Leaderboard extends Component
{
    public $skor_polisi, $skor_detektif, $skor_petani, $skor_nelayan;

    public function mount(){
        $polisi = Murid::where('users_id', 2)->first();
        $detektif = Murid::where('users_id', 3)->first();
        $nelayan = Murid::where('users_id', 4)->first();
        $petani = Murid::where('users_id', 5)->first();

        $this->skor_polisi += ($polisi->score_level_1 + $polisi->score_level_2 + $polisi->score_level_3 + $polisi->score_level_4 + $polisi->score_level_5);
        $this->skor_detektif += ($detektif->score_level_1 + $detektif->score_level_2 + $detektif->score_level_3 + $detektif->score_level_4 + $detektif->score_level_5);
        $this->skor_petani += ($petani->score_level_1 + $petani->score_level_2 + $petani->score_level_3 + $petani->score_level_4 + $petani->score_level_5);
        $this->skor_nelayan += ($nelayan->score_level_1 + $nelayan->score_level_2 + $nelayan->score_level_3 + $nelayan->score_level_4 + $nelayan->score_level_5);
    }
    public function render()
    {
        return view('livewire.murid.leaderboard')->extends('layouts.app');
    }
}
