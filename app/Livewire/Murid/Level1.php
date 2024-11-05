<?php

namespace App\Livewire\Murid;

use App\Models\Level1 as ModelsLevel1;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Level1 extends Component
{
    use LivewireAlert;
    public $countdown;
    public $display = '00:00';

    public function mount()
    {
        $level1 = ModelsLevel1::first();
        $this->countdown = $level1 ? $level1->waktu_level1 : 0;
    }

    public function countdownFinished()
    {
        $this->display = '00:00';

        ModelsLevel1::first()->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);

        $this->alert('success', 'Berhasil Menambahkan soal');

        // Uncomment jika ingin redirect setelah selesai
        // return redirect()->route('next.level');
    }

    public function render()
    {
        return view('livewire.murid.level1')->extends('layouts.app');
    }
}
