<?php

namespace App\Livewire\Murid;

use App\Models\FirstAcccessLevel2;
use App\Models\Level2 as ModelsLevel2;
use App\Models\SoalLevel2;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Level2 extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $countdown, $startTime, $endTime = null, $display = '00:00', $showModal = true;
    public $data, $selectedAnswer = [], $answer_image = [], $soallevel1_id = [];
    public $answeredQuestions = [];

    public function mount()
    {
        $this->data = SoalLevel2::all();
        $this->answeredQuestions = [];

        $level2 = ModelsLevel2::first();
        $data = FirstAcccessLevel2::where('role_name', Auth::user()->getRoleNames()->first())->first();
        if ($data != null) {
            $this->startTime = $data->created_at;
            $this->endTime = $data->end_time;
            $this->showModal = false;
        }

        $this->countdown = $level2 ? $level2->waktu_level2 : 0;
    }

    public function startGame($endTime)
    {
        if (null == FirstAcccessLevel2::where('role_name', Auth::user()->getRoleNames()->first())->first()) {
            FirstAcccessLevel2::create([
                'role_name' => Auth::user()->getRoleNames()->first(),
                'end_time' => $endTime
            ]);
        }
    }

    public function questionAnswered($questionId)
    {
        // Check if both answer and image are provided
        if (isset($this->selectedAnswer[$questionId]) && isset($this->answer_image[$questionId])) {
            if (!in_array($questionId, $this->answeredQuestions)) {
                $this->answeredQuestions[] = $questionId;
            }
            return true;
        }
        return false;
    }

    public function getNextUnansweredQuestion($currentQuestion)
    {
        $totalQuestions = count($this->data);
        for ($i = $currentQuestion + 1; $i <= $totalQuestions; $i++) {
            if (!in_array($this->data[$i-1]->id, $this->answeredQuestions)) {
                return $i;
            }
        }
        return $totalQuestions; // If no unanswered questions found, go to last question
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
