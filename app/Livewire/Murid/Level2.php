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
    public $data, $selectedAnswer = [], $answer_image = [], $soallevel2_id = [], $isSubmitting = false, $deskripsi_opening;

    public function mount()
    {
        $this->data = SoalLevel2::all();

        $this->deskripsi_opening = ModelsLevel2::value('text');
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
        if ($this->isSubmitting) {
            return;
        }

        $this->isSubmitting = true;

        $roleName = Auth::user()->getRoleNames()->first();
        $murid = Murid::where('users_id', Auth::id())->first();
        $finish = FirstAcccessLevel2::where('role_name', Auth::user()->getRoleNames()->first())->first();

        $totalAnswerPerUser = SoalLevel2::count();
        $totalAnswer = AnswerLevel2::count();

        if (!$finish || !$murid) {
            $this->isSubmitting = false;
            return;
        }

        $finish->update([
            'status' => true,
        ]);

        // Create a single array of answers to process
        $answersToProcess = [];
        foreach ($this->soallevel2_id as $key => $id) {
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
                $customFileName = 'answer_soal_levle2' . $roleName . '_' . $id . '_' . time() . '.' . $uploadedImage->getClientOriginalExtension();
                $uploadedImage->storeAs('answer_soal_levle2', $customFileName, 'public');
            }

            $correctAnswer = SoalLevel2::where('id', $id)->value('correct_answer');
            $isCorrect = $selectedAnswer === $correctAnswer;
            $pointAnswer = $isCorrect ? 50 : 0;
            if ($totalAnswer >= $totalAnswerPerUser ) {
                if ($totalAnswer == $totalAnswerPerUser ) {
                    $pointAnswer += 20;
                } elseif ($totalAnswer == $totalAnswerPerUser  * 2) {
                    $pointAnswer += 15;
                } elseif ($totalAnswer == $totalAnswerPerUser  * 3) {
                    $pointAnswer += 10;
                }
            }else {
                $pointAnswer += 25;
            }

            // Check if answer already exists
            $existingAnswer = AnswerLevel2::where([
                'murid_id' => $murid->id,
                'soal_level2_id' => $id
            ])->first();

            if (!$existingAnswer) {
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
        return view('livewire.murid.level2')->extends('layouts.app');
    }
}
