<?php

namespace App\Livewire\Guru;

use App\Models\AnswerLevel1;
use App\Models\AnswerLevel2;
use App\Models\AnswerLevel3;
use App\Models\AnswerLevel4;
use App\Models\AnswerLevel5;
use App\Models\FirstAcccessLevel1;
use App\Models\FirstAcccessLevel2;
use App\Models\FirstAcccessLevel3;
use App\Models\FirstAccessLevel4;
use App\Models\FirstAccessLevel5;
use App\Models\Murid;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class Respondent extends Component
{
    use LivewireAlert;

    public $datalevel1, $datalevel2, $datalevel3, $datalevel4, $datalevel5, $soal, $point_reason = [];
    protected $listeners = ['confirmed' => 'resetJawaban'];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        // Optimalkan pemanggilan data dengan menggunakan eager loading
        $this->datalevel1 = AnswerLevel1::with(['soalLevel1'])->get();
        $this->datalevel2 = AnswerLevel2::with(['soalLevel2'])->get();
        $this->datalevel3 = AnswerLevel3::with(['soalLevel3'])->get();
        $this->datalevel4 = AnswerLevel4::with(['soalLevel4'])->get();
        $this->datalevel5 = AnswerLevel5::with(['soalLevel5'])->get();
    }

    public function confirmReset()
    {
        $this->alert('warning', 'Apakah Anda Yakin Ingin Mereset Jawaban?', [
            'position' => 'center',
            'toast' => false,
            'timer' => false,
            'showConfirmButton' => true,
            'confirmButtonText' => 'Ya, Hapus',
            'showCancelButton' => true,
            'cancelButtonText' => 'Batal',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function resetJawaban()
    {
        // Optimalkan pemanggilan Murid dan User
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'guru');
        })->with('murid')->get();

        foreach ($users as $item) {
            $murid = $item->murid;
            $murid->update([
                'score_level_1' => 0,
                'score_level_2' => 0,
                'score_level_3' => 0,
                'score_level_4' => 0,
                'score_level_5' => 0,
            ]);
        }

        // Truncate tables
        AnswerLevel1::truncate();
        FirstAcccessLevel1::truncate();
        AnswerLevel2::truncate();
        FirstAcccessLevel2::truncate();
        AnswerLevel3::truncate();
        FirstAcccessLevel3::truncate();
        AnswerLevel4::truncate();
        FirstAccessLevel4::truncate();
        AnswerLevel5::truncate();
        FirstAccessLevel5::truncate();

        $this->alert('success', 'Berhasil Mereset Jawaban', [
            'timer' => 3000,
            'timerProgressBar' => true,
        ]);

        $this->loadData(); // Hanya panggil sekali untuk refresh data
    }

    // Sederhanakan simpanNilaiSoal dengan parameterisasi
    public function simpanNilai($level, $id, $number)
    {
        if($level == 1 || $level == 2) {
            $rules = [
                'point_reason.*' => 'required|numeric|min:0|max:50',
            ];

            $messages = [
                'point_reason.*.required' => 'Nilai harus diisi.',
                'point_reason.*.numeric' => 'Nilai harus berupa angka.',
                'point_reason.*.min' => 'Nilai minimal :min.',
                'point_reason.*.max' => 'Nilai maksimal :max.',
            ];
        }elseif($level == 3 || $level == 4) {
            $rules = [
                'point_reason.*' => 'required|numeric|min:0|max:100',
            ];
            $messages = [
                'point_reason.*.required' => 'Nilai harus diisi.',
                'point_reason.*.numeric' => 'Nilai harus berupa angka.',
                'point_reason.*.min' => 'Nilai minimal :min.',
                'point_reason.*.max' => 'Nilai maksimal :max.',
            ];
        }


        // Validasi input
        $this->validate($rules, $messages);

        // Cari model answer berdasarkan level
        $answerClass = "App\\Models\\AnswerLevel{$level}";
        $answer = $answerClass::find($id);

        if (!$answer) {
            $this->alert('error', 'Data tidak ditemukan');
            return;
        }

        $answer->point_reason = $this->point_reason[$number];
        $answer->total_point += $this->point_reason[$number];
        $answer->save();

        $murid = Murid::find($answer->murid_id);
        $murid->{'score_level_' . $level} += $this->point_reason[$number];
        $murid->save();

        $this->reset('point_reason');
        $this->alert('success', 'Berhasil Menyimpan Nilai');
        $this->loadData(); // Hanya panggil sekali untuk refresh data
    }

    public function render()
    {
        return view('livewire.guru.respondent')->extends('layouts.guru.app');
    }
}
