<?php

namespace App\Livewire\Murid;

use App\Models\AnswerLevel2;
use App\Models\FirstAcccessLevel2;
use App\Models\Level2 as ModelsLevel2;
use App\Models\Murid;
use App\Models\SoalLevel2;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Level2 extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $countdown, $startTime, $endTime = null, $display = '00:00', $showModal = true;
    public $data, $selectedAnswer = [], $answer_image = [], $soallevel2_id = [];

    public function mount()
    {
        $this->data = SoalLevel2::all();

        $level2 = ModelsLevel2::first();
        $data = FirstAcccessLevel2::where('role_name', Auth::user()->getRoleNames()->first())->first();

        if ($data) {
            $this->startTime = $data->created_at;
            $this->endTime = $data->end_time;
            $this->showModal = false;
        }

        $this->countdown = $level2 ? $level2->waktu_level2 : 0;
    }

    public function startGame($endTime)
    {
        $existingAccess = FirstAcccessLevel2::where('role_name', Auth::user()->getRoleNames()->first())->first();
        if (!$existingAccess) {
            FirstAcccessLevel2::create([
                'role_name' => Auth::user()->getRoleNames()->first(),
                'end_time' => $endTime,
            ]);
        }
        $this->endTime = $endTime;
    }

    public function simpanJawaban()
    {
        $roleName = Auth::user()->getRoleNames()->first();
        $murid = Murid::where('users_id', Auth::id())->first();

        if ($murid) {
            foreach ($this->soallevel2_id as $key => $id) {
                $selectedAnswer = $this->selectedAnswer[$key] ?? null;
                $uploadedImage = $this->answer_image[$key] ?? null;

                $customFileName = null;
                if ($uploadedImage instanceof TemporaryUploadedFile) {
                    $customFileName = 'answer_soal_level2' . $roleName . '_' . $key . '_' . time() . '.' . $uploadedImage->getClientOriginalExtension();
                    $uploadedImage->storeAs('answer_soal_level2', $customFileName, 'public');
                }

                $correctAnswer = SoalLevel2::where('id', $id)->value('correct_answer');
                $isCorrect = $selectedAnswer === $correctAnswer;
                $pointAnswer = $isCorrect ? 50 : 0;

                AnswerLevel2::create([
                    'murid_id' => $murid->id,
                    'soal_level2_id' => $id,
                    'answer' => $selectedAnswer,
                    'is_correct' => $isCorrect,
                    'image_reason' => $customFileName,
                    'point_answer' => $pointAnswer,
                    'total_point' => $pointAnswer,
                ]);

                $murid->increment('score_level_2', $pointAnswer);
            }
        }

        foreach ($this->answer_image as $file) {
            if ($file instanceof TemporaryUploadedFile) {
                $file->delete();
            }
        }

        $this->reset(['countdown', 'data', 'selectedAnswer', 'answer_image']);
        return redirect()->route('murid.home');
    }

    public function countdownFinished()
    {
        $this->display = '00:00';
    }

    public function render()
    {
        return view('livewire.murid.level2')->extends('layouts.app');
    }
}
