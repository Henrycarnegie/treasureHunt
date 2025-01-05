<?php

namespace App\Livewire\Murid;

use App\Models\FirstAccessLevel5;
use App\Models\Level5 as ModelsLevel5;
use App\Models\Murid;
use App\Models\SoalLevel5;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Level5 extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $nyawa, $totalNyawa, $showModal = true, $data, $deskripsi_opening;
    protected $listeners = [
        'mount' => 'mount',
    ];

    public function mount()
    {
        $level5 = ModelsLevel5::first();
        $this->data = SoalLevel5::doesntHave('answer')->first();
        $this->deskripsi_opening = $level5->text;
        $data = FirstAccessLevel5::where('role_name', Auth::user()->getRoleNames()->first())->first();

        if ($data && $data->nyawa > 0 && $this->data !== null) {
            $this->totalNyawa = $level5->nyawa;
            $this->nyawa = $data->nyawa;
            $this->showModal = false;
        }else{
            if($data){
                $data->update([
                    'status' => true
                ]);
                return redirect()->route('murid.leaderboard');

            }
        }
    }

    public function startGame()
    {
        $level5 = ModelsLevel5::first();
        $existingAccess = FirstAccessLevel5::where('role_name', Auth::user()->getRoleNames()->first())->first();

        if (!$existingAccess) {
            $existingAccess = FirstAccessLevel5::create([
                'role_name' => Auth::user()->getRoleNames()->first(),
                'nyawa' => $level5->nyawa,
            ]);
        }

        $this->nyawa = $existingAccess->nyawa;
        $this->showModal = false;
        $this->mount();
    }

    public function selectAnswer(SoalLevel5 $id, $value)
    {
        $murid = Murid::where('users_id', Auth::id())->first();
        if ($id->correct_answer == $value) {
            $answer = $id->answer()->create([
                        'murid_id' => $murid->id,
                        'soal_level5_id' => $id->id,
                        'answer' => $value,
                        'is_correct' => true,
                        'point_answer' => 100,
                        'total_point' => 100,
                    ]);

            $murid->update([
                'score_level_5' => $murid->score_level_5 + $answer->total_point,
            ]);

            $this->alert('success', 'Jawaban Anda Benar', [
                'position' =>  'center',
                'toast' => false,
                'showConfirmButton' => true,
                'confirmButtonText' => 'Selanjutnya',
                'closeOnClickOutside' => false,
                'allowOutsideClick' => false,
                'timer' => false,
                'onConfirmed' => 'mount',
            ]);
        }else{
            $existingAccess = FirstAccessLevel5::where('role_name', Auth::user()->getRoleNames()->first())->first();
            $existingAccess->update([
                'nyawa' => $existingAccess->nyawa - 1,
            ]);

            $id->answer()->create([
                'murid_id' => $murid->id,
                'soal_level5_id' => $id->id,
                'answer' => $value,
                'is_correct' => false,
            ]);

            $this->alert('error', 'Jawaban Anda Salah', [
                'position' =>  'center',
                'toast' => false,
                'showConfirmButton' => true,
                'confirmButtonText' => 'Selanjutnya',
                'closeOnClickOutside' => false,
                'allowOutsideClick' => false,
                'timer' => false,
                'onConfirmed' => 'mount',
            ]);
        }
        // $this->mount();
    }

    public function handleAlertDismiss()
    {
        $this->mount();
    }

    public function render()
    {
        return view('livewire.murid.level5')->extends('layouts.app');
    }
}
