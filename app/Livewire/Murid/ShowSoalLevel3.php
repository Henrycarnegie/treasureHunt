<?php

namespace App\Livewire\Murid;

use App\Models\AnswerLevel3;
use App\Models\FirstAcccessLevel3;
use App\Models\Level3;
use App\Models\Murid;
use App\Models\SoalLevel3;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ShowSoalLevel3 extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $countdown, $startTime, $endTime = null, $display = '00:00';
    public $data, $answer_image = [], $soallevel3_id = [];

    public function mount($boxId)
    {
        $this->data = SoalLevel3::where('box_id', $boxId)->get();

        $level3 = Level3::first();
        $data = FirstAcccessLevel3::where('role_name', Auth::user()->getRoleNames()->first())
                    ->where('box_id', $boxId)
                    ->first();

        if ($data) {
            $this->startTime = $data->created_at;
            $this->endTime = $data->end_time;
            $this->showModal = false;
        }

        $this->countdown = $level3 ? $level3->waktu_level3 : 0;
    }

    public function simpanJawaban()
    {
        $roleName = Auth::user()->getRoleNames()->first();
        $murid = Murid::where('users_id', Auth::id())->first();
        $finish = FirstAcccessLevel3::where('role_name', Auth::user()->getRoleNames()->first())->first();
        $finish->update([
            'status' => true,
        ]);

        if ($murid) {
            foreach ($this->soallevel3_id as $key => $id) {
                $uploadedImage = $this->answer_image[$key] ?? null;

                $customFileName = null;
                if ($uploadedImage instanceof TemporaryUploadedFile) {
                    $customFileName = 'answer_soal_level3' . $roleName . '_' . $key . '_' . time() . '.' . $uploadedImage->getClientOriginalExtension();
                    $uploadedImage->storeAs('answer_soal_level3', $customFileName, 'public');
                }

                AnswerLevel3::create([
                    'murid_id' => $murid->id,
                    'soal_level3_id' => $id,
                    'image_reason' => $customFileName,
                ]);
            }
        }

        foreach ($this->answer_image as $file) {
            if ($file instanceof TemporaryUploadedFile) {
                $file->delete();
            }
        }

        $this->reset(['countdown', 'data', 'answer_image']);
        return redirect()->route('murid.leaderboard');
    }

    public function countdownFinished()
    {
        $this->display = '00:00';
    }

    public function render()
    {
        return view('livewire.murid.show-soal-level3')->extends('layouts.app');
    }
}
