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
        $this->datalevel1 = AnswerLevel1::select('answer_level1.*',
            'soal_level1.question_text as soal_question_text',
            'soal_level1.question_image as soal_question_image',
            'soal_level1.correct_answer as soal_correct_answer')
            ->join('soal_level1', 'answer_level1.soal_level1_id', '=', 'soal_level1.id')
            ->get();

        $this->datalevel2 = AnswerLevel2::select('answer_level2.*',
            'soal_level2.question_text as soal_question_text',
            'soal_level2.question_image as soal_question_image',
            'soal_level2.correct_answer as soal_correct_answer')
            ->join('soal_level2', 'answer_level2.soal_level2_id', '=', 'soal_level2.id')
            ->get();
        $this->datalevel3 = AnswerLevel3::select('answer_level3.*',
            'soal_level3.question_text as soal_question_text',
            'soal_level3.question_image as soal_question_image')
            ->join('soal_level3', 'answer_level3.soal_level3_id', '=', 'soal_level3.id')
            ->get();
        $this->datalevel4 = AnswerLevel4::select('answer_level4.*',
            'soal_level4.question_text as soal_question_text',
            'soal_level4.question_image as soal_question_image')
            ->join('soal_level4', 'answer_level4.soal_level4_id', '=', 'soal_level4.id')
            ->get();
        $this->datalevel5 = AnswerLevel5::select('answer_level5.*',
            'soal_level5.question_text as soal_question_text',
            'soal_level5.question_image as soal_question_image')
            ->join('soal_level5', 'answer_level5.soal_level5_id', '=', 'soal_level5.id')
            ->get();

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
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'guru');
        })->get();
        foreach ($users as $item) {
            $murid = Murid::where('users_id', $item->id)->first();
            $murid->score_level_1 = 0;
            $murid->score_level_2 = 0;
            $murid->score_level_3 = 0;
            $murid->score_level_4 = 0;
            $murid->score_level_5 = 0;
            $murid->save();
        }
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
        $this->alert('success', 'Berhasil Mereset Jawaban',
        [
            'timer' => 3000,
            'timerProgressBar' => true,
        ]);
        $this->mount();
    }

    public function simpanNilaiSoal1($id, $number)
    {
        $rules = [
            'point_reason.*' => 'required|numeric|min:0|max:50',
        ];

        $messages = [
            'point_reason.*.required' => 'Nilai harus diisi.',
            'point_reason.*.numeric' => 'Nilai harus berupa angka.',
            'point_reason.*.min' => 'Nilai minimal 0.',
            'point_reason.*.max' => 'Nilai maksimal 50.',
        ];

        // Validasi input
        $this->validate($rules, $messages);

        $answer = AnswerLevel1::find($id);
        $answer->point_reason = $this->point_reason[$number];
        $answer->total_point += $this->point_reason[$number];
        $answer->save();

        $murid = Murid::where('id', $answer->murid_id)->first();
        $murid->score_level_1 += $this->point_reason[$number];
        $murid->save();

        $this->reset('point_reason');
        $this->alert('success', 'Berhasil Menyimpan Nilai');
        $this->mount();
    }

    public function simpanNilaiSoal2($id, $number)
    {
        $rules = [
            'point_reason.*' => 'required|numeric|min:0|max:50',
        ];

        $messages = [
            'point_reason.*.required' => 'Nilai harus diisi.',
            'point_reason.*.numeric' => 'Nilai harus berupa angka.',
            'point_reason.*.min' => 'Nilai minimal 0.',
            'point_reason.*.max' => 'Nilai maksimal 50.',
        ];

        // Validasi input
        $this->validate($rules, $messages);

        $answer = AnswerLevel2::find($id);
        $answer->point_reason = $this->point_reason[$number];
        $answer->total_point += $this->point_reason[$number];
        $answer->save();

        $murid = Murid::where('id', $answer->murid_id)->first();
        $murid->score_level_2 += $this->point_reason[$number];
        $murid->save();

        $this->reset('point_reason');
        $this->alert('success', 'Berhasil Menyimpan Nilai');
        $this->mount();
    }

    public function simpanNilaiSoal3($id, $number)
    {
        $rules = [
            'point_reason.*' => 'required|numeric|min:0|max:100',
        ];

        $messages = [
            'point_reason.*.required' => 'Nilai harus diisi.',
            'point_reason.*.numeric' => 'Nilai harus berupa angka.',
            'point_reason.*.min' => 'Nilai minimal 0.',
            'point_reason.*.max' => 'Nilai maksimal 100.',
        ];

        // Validasi input
        $this->validate($rules, $messages);

        $answer = AnswerLevel3::find($id);
        $answer->point_reason = $this->point_reason[$number];
        $answer->total_point += $this->point_reason[$number];
        $answer->save();

        $murid = Murid::where('id', $answer->murid_id)->first();
        $murid->score_level_3 += $this->point_reason[$number];
        $murid->save();

        $this->reset('point_reason');
        $this->alert('success', 'Berhasil Menyimpan Nilai');
        $this->mount();
    }

    public function simpanNilaiSoal4($id, $number)
    {
        $rules = [
            'point_reason.*' => 'required|numeric|min:0|max:100',
        ];

        $messages = [
            'point_reason.*.required' => 'Nilai harus diisi.',
            'point_reason.*.numeric' => 'Nilai harus berupa angka.',
            'point_reason.*.min' => 'Nilai minimal 0.',
            'point_reason.*.max' => 'Nilai maksimal 100.',
        ];

        // Validasi input
        $this->validate($rules, $messages);

        $answer = AnswerLevel4::find($id);
        $answer->point_reason = $this->point_reason[$number];
        $answer->total_point += $this->point_reason[$number];
        $answer->save();

        $murid = Murid::where('id', $answer->murid_id)->first();
        $murid->score_level_4 += $this->point_reason[$number];
        $murid->save();

        $this->reset('point_reason');
        $this->alert('success', 'Berhasil Menyimpan Nilai');
        $this->mount();
    }

    public function render()
    {
        return view('livewire.guru.respondent')->extends('layouts.guru.app');
    }
}
