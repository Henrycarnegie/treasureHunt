<?php

namespace App\Livewire\Murid;

use App\Models\AnswerLevel4;
use App\Models\FirstAccessLevel4;
use App\Models\Level4;
use App\Models\Murid;
use App\Models\SoalLevel4;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ShowSoalLevel4 extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $countdown, $startTime, $endTime = null, $display = '00:00';
    public $data, $answer_image = [], $soallevel4_id = [];

    public function mount($soalId)
    {
        $this->data = SoalLevel4::where('id', $soalId)->get();

        $level4 = Level4::first();
        $data = FirstAccessLevel4::where('role_name', Auth::user()->getRoleNames()->first())
                    ->first();

        if ($data) {
            $this->startTime = $data->created_at;
            $this->endTime = $data->end_time;
        }

        $this->countdown = $level4 ? $level4->waktu_level4 : 0;
    }

    public function simpanJawaban()
    {
        $roleName = Auth::user()->getRoleNames()->first();
        $murid = Murid::where('users_id', Auth::id())->first();

        if ($murid) {
            if (!is_null($this->soallevel4_id) && !empty($this->soallevel4_id)) {
                foreach ($this->soallevel4_id as $key => $id) {
                    $uploadedImage = $this->answer_image[$key] ?? null;

                    $customFileName = null;
                    if ($uploadedImage instanceof TemporaryUploadedFile) {
                        $customFileName = 'answer_soal_level4' . $roleName . '_' . $key . '_' . time() . '.' . $uploadedImage->getClientOriginalExtension();
                        $uploadedImage->storeAs('answer_soal_level4', $customFileName, 'public');
                    }

                    AnswerLevel4::create([
                        'murid_id' => $murid->id,
                        'soal_level4_id' => $id,
                        'image_reason' => $customFileName,
                    ]);
                }
            } else {
                $this->alert('error', 'Tidak ada soal yang dijawab');
                return;
            }
        }

        foreach ($this->answer_image as $file) {
            if ($file instanceof TemporaryUploadedFile) {
                $file->delete();
            }
        }

    $this->reset(['countdown', 'data', 'answer_image', 'soallevel4_id']);
    return redirect()->route('murid.level4');
}

    public function countdownFinished()
    {
        $this->display = '00:00';
        $finish = FirstAccessLevel4::where('role_name', Auth::user()->getRoleNames()->first())->first();
        $finish->update([
            'status' => true,
        ]);

        return redirect()->route('murid.leaderboard');  
    }
    public function render()
    {
        return view('livewire.murid.show-soal-level4')->extends('layouts.app');
    }
}
