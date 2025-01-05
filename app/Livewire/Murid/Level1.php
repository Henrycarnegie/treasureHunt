<?php

namespace App\Livewire\Murid;

use App\Models\AnswerLevel1;
use App\Models\FirstAcccessLevel1;
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

    public $countdown, $startTime, $endTime = null, $display = '00:00', $showModal = true;
    public $data, $selectedAnswer = [], $answer_image = [], $soallevel1_id = [], $isSubmitting = false, $deskripsi_opening;

    public function mount()
    {
        $this->data = SoalLevel1::all();
        $this->deskripsi_opening = ModelsLevel1::value('text');

        $level1 = ModelsLevel1::first();
        $data = FirstAcccessLevel1::where('role_name', Auth::user()->getRoleNames()->first())->first();

        if ($data) {
            $this->startTime = $data->created_at;
            $this->endTime = $data->end_time;
            $this->showModal = false;
        }

        $this->countdown = $level1 ? $level1->waktu_level1 : 0;
    }

    public function startGame($endTime)
    {
        $existingAccess = FirstAcccessLevel1::where('role_name', Auth::user()->getRoleNames()->first())->first();
        if (!$existingAccess) {
            FirstAcccessLevel1::create([
                'role_name' => Auth::user()->getRoleNames()->first(),
                'end_time' => $endTime,
            ]);
        }
        $this->endTime = $endTime;
    }

    public function simpanJawaban()
    {
        if ($this->isSubmitting) {
            return;
        }

        $this->isSubmitting = true;

        $roleName = Auth::user()->getRoleNames()->first();
        $murid = Murid::where('users_id', Auth::id())->first();
        $finish = FirstAcccessLevel1::where('role_name', Auth::user()->getRoleNames()->first())->first();

        if (!$finish || !$murid) {
            $this->isSubmitting = false;
            return;
        }

        $finish->update([
            'status' => true,
        ]);

        // Create a single array of answers to process
        $answersToProcess = [];
        foreach ($this->soallevel1_id as $key => $id) {
            $answersToProcess[] = [
                'id' => $id,
                'answer' => $this->selectedAnswer[$key] ?? null,
                'image' => $this->answer_image[$key] ?? null
            ];
        }

        // Process each answer once
        foreach ($answersToProcess as $answer) {
            $selectedAnswer = $answer['answer'];
            $uploadedImage = $answer['image'];
            $id = $answer['id'];

            $customFileName = null;
            if ($uploadedImage instanceof TemporaryUploadedFile) {
                $customFileName = 'answer_soal_level1' . $roleName . '_' . $id . '_' . time() . '.' . $uploadedImage->getClientOriginalExtension();
                $uploadedImage->storeAs('answer_soal_level1', $customFileName, 'public');
            }

            $correctAnswer = SoalLevel1::where('id', $id)->value('correct_answer');
            $isCorrect = $selectedAnswer === $correctAnswer;
            $pointAnswer = $isCorrect ? 50 : 0;

            // Check if answer already exists
            $existingAnswer = AnswerLevel1::where([
                'murid_id' => $murid->id,
                'soal_level1_id' => $id
            ])->first();

            if (!$existingAnswer) {
                AnswerLevel1::create([
                    'murid_id' => $murid->id,
                    'soal_level1_id' => $id,
                    'answer' => $selectedAnswer,
                    'is_correct' => $isCorrect,
                    'image_reason' => $customFileName,
                    'point_answer' => $pointAnswer,
                    'total_point' => $pointAnswer,
                ]);

                $murid->increment('score_level_1', $pointAnswer);
            }
        }

        // Cleanup
        foreach ($this->answer_image as $file) {
            if ($file instanceof TemporaryUploadedFile) {
                $file->delete();
            }
        }

        $this->reset(['countdown', 'selectedAnswer', 'answer_image', 'isSubmitting']);
        return redirect()->route('murid.leaderboard');
    }

    public function countdownFinished()
    {
        $this->display = '00:00';
    }

    public function render()
    {
        return view('livewire.murid.level1')->extends('layouts.app');
    }
}
