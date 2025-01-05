<?php

namespace App\Livewire\Murid;

use App\Models\FirstAccessLevel4;
use App\Models\Level3;
use App\Models\Level4 as ModelsLevel4;
use App\Models\SoalLevel4;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Level4 extends Component
{
    use LivewireAlert;

    public $countdown, $startTime, $endTime = null, $display = '00:00', $showModal = true;
    public $data, $access, $deskripsi_opening, $modalOpening = false;
    protected $listeners = ['finishConfirmed' => 'handleConfirm'];

    public function mount()
    {
        $level4 = ModelsLevel4::first();
        $this->deskripsi_opening = ModelsLevel4::value('text');
        $data = FirstAccessLevel4::where('role_name', Auth::user()->getRoleNames()->first())->first();

        if ($data) {
            $this->startTime = $data->created_at;
            $this->endTime = $data->end_time;
            $this->showModal = false;
        }

        $this->countdown = $level4 ? $level4->waktu_level4 : 0;
    }

    public function startGame($endTime)
    {
        $existingAccess = FirstAccessLevel4::where('role_name', Auth::user()->getRoleNames()->first())->first();
        if (!$existingAccess) {
            FirstAccessLevel4::create([
                'role_name' => Auth::user()->getRoleNames()->first(),
                'end_time' => $endTime,
            ]);
        }
        $this->endTime = $endTime;
    }

    public function confirmFinish()
    {
        $this->alert('warning', 'Apakah Anda Yakin Ingin Menyelesaikan Level Ini?', [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => true,
            'confirmButtonText' => 'Ya, Yakin',
            'showCancelButton' => true,
            'cancelButtonText' => 'Batal',
            'onConfirmed' => 'finishConfirmed',
        ]);
    }

    public function handleConfirm()
    {
        $finish = FirstAccessLevel4::where('role_name', Auth::user()->getRoleNames()->first())->first();
        $finish->update([
            'status' => true,
        ]);

        return redirect()->route('murid.leaderboard');
    }


    public function simpanOpening()
    {
        $rules = [
            'deskripsi_opening' => 'required|min:3|max:255',
        ];

        $customMessages = [
            'deskripsi_opening.required' => 'Deskripsi opening harus diisi.',
            'deskripsi_opening.min' => 'Deskripsi opening harus minimal 3 karakter.',
            'deskripsi_opening.max' => 'Deskripsi opening tidak boleh lebih dari 255 karakter.',
        ];

        $this->validate($rules, $customMessages);

        $deskripsi_opening = ModelsLevel4::first();

        if (isset($deskripsi_opening)) {
            $deskripsi_opening->update([
                'text' => $this->deskripsi_opening,
            ]);
        }else{
            Level3::create([
                'text' => $this->deskripsi_opening,
            ]);
        }

        $this->reset('deskripsi_opening');

        $this->alert('success', 'Deskripsi Opening Berhasil Diubah', [
            'position' => 'center',
            'toast' => false,
        ]);
    }

    public function render()
    {
        $this->data = SoalLevel4::with(['answer' => function ($query) {
            $murid = auth()->user()->murid;
            $query->where('murid_id', $murid->id);
        }])
        ->get()
        ->map(function ($soal) {
            $soal->is_answered = $soal->answer !== null && $soal->answer->count() > 0;
            return $soal;
        });

        $this->access = FirstAccessLevel4::where('role_name', Auth::user()->getRoleNames()->first())->first();

        return view('livewire.murid.level4')->extends('layouts.app');
    }
}
