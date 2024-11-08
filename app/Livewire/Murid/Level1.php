<?php

namespace App\Livewire\Murid;

use App\Models\Level1 as ModelsLevel1;
use App\Models\SoalLevel1;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Level1 extends Component
{
    use LivewireAlert;
    public $countdown, $display = '00:00';
    public $data;

    public function mount()
    {
        $level1 = ModelsLevel1::first();
        $this->countdown = $level1 ? $level1->waktu_level1 : 0;
    }

    public function countdownFinished()
    {
        $this->display = '00:00';

        // ModelsLevel1::first()->update([
        //     'status' => 'completed',
        //     'completed_at' => now()
        // ]);

        return redirect()->route('murid.home');

        // Uncomment jika ingin redirect setelah selesai
        // return redirect()->route('next.level');
    }

    public function render()
    {
        $this->data = SoalLevel1::all();
        return view('livewire.murid.level1')->extends('layouts.app');
    }
}
