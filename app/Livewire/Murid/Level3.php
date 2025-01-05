<?php

namespace App\Livewire\Murid;

use App\Models\BoxLevel3;
use App\Models\FirstAcccessLevel3;
use App\Models\Level3 as ModelsLevel3;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Level3 extends Component
{
    use LivewireAlert;

    public $showModal = true, $data, $countdown, $deskripsi_opening;

    public function mount()
    {
        $check = FirstAcccessLevel3::where('role_name', Auth::user()->getRoleNames()->first())
            ->first();
        $this->deskripsi_opening = ModelsLevel3::value('text');

        if ($check) {
            return redirect()->route('murid.ShowSoalLevel3', ['boxId' => $check->box_id]);
        }

    }

    public function selectBox($boxId)
    {
        $existingAccess = FirstAcccessLevel3::where('box_id', $boxId)
            ->first();

        if ($existingAccess) {
            $this->alert('error', 'box telah di akses');
        } else {
            $roleName = Auth::user()->getRoleNames()->first();
            $level3 = ModelsLevel3::first();
            $endTime = (time() + ($level3->waktu_level3 * 60)) * 1000;

            FirstAcccessLevel3::create([
                'role_name' => $roleName,
                'box_id' => $boxId,
                'end_time' => $endTime,
            ]);

            return redirect()->route('murid.ShowSoalLevel3', ['boxId' => $boxId]);
        }
    }

    public function render()
    {
        $boxes = BoxLevel3::all();


        $this->data = $boxes->map(function ($box) {
            $isUsed = FirstAcccessLevel3::where('box_id', $box->id)
                ->exists();
            $box->using = $isUsed;
            return $box;
        });

    return view('livewire.murid.level3')->extends('layouts.app');
    }
}
