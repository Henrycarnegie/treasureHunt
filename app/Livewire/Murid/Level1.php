<?php

namespace App\Livewire\Murid;

use App\Models\AnswerLevel1;
use App\Models\Level1 as ModelsLevel1;
use App\Models\Murid;
use App\Models\SoalLevel1;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Level1 extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $countdown, $display = '00:00';
    public $data, $selectedAnswer = [], $answer_image = [], $soallevel1_id = [];

    public function mount()
    {
        $level1 = ModelsLevel1::first();
        $this->countdown = $level1 ? $level1->waktu_level1 : 0;
    }

    public function simpanJawaban(){
        $userId = Auth::id();
        $roleName = Auth::user()->getRoleNames()->first();
        $murid = Murid::where('users_id', $userId)->pluck('id')->first();

        if ($murid) {
            foreach ($this->soallevel1_id as $key => $id) {
                // Periksa apakah indeks ada
                if (!isset($this->selectedAnswer[$key])) {
                    $this->selectedAnswer[$key] = null;
                }

                if (!isset($this->answer_image[$key])) {
                    $this->answer_image[$key] = null;
                }else{
                    $customFileName = 'answer_soal1_'. $roleName . '_' . $key. '_' . time() . '.' . $this->answer_image[$key]->getClientOriginalExtension();
                    $this->answer_image[$key]->storeAs('answer_soal_level1', $customFileName, 'public');
                }

                $data = SoalLevel1::select('correct_answer')->where('id', $this->soallevel1_id[$key])->first();

                // Buat instance baru dari AnswerLevel1
                $answer = new AnswerLevel1();
                $answer->murid_id = $murid;
                $answer->soal_level1_id = $this->soallevel1_id[$key];
                $answer->answer = $this->selectedAnswer[$key];
                $answer->is_correct = ($this->selectedAnswer[$key] == $data->correct_answer) ? true : false;
                $answer->image_reason = (isset($this->answer_image[$key])) ? $customFileName : null;
                $answer->point_answer = ($this->selectedAnswer[$key] == $data->correct_answer) ? 50 : 0;
                $answer->save();

                $answer->update([
                    'total_point' => $answer->point_answer,
                ]);
            }
        }
        foreach ($this->answer_image as $file) {
            if ($file instanceof TemporaryUploadedFile) {
                $file->delete();
            }
        }
        $this->reset([
            'countdown',
            'data',
            'selectedAnswer',
            'answer_image',
        ]);
        $this->dispatch('submitForm');
        return redirect()->route('murid.home');
    }

    public function countdownFinished()
    {
        $this->display = '00:00';
    }

    public function render()
    {
        $this->data = SoalLevel1::all();
        return view('livewire.murid.level1')->extends('layouts.app');
    }
}
