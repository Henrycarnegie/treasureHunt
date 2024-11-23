<?php

namespace App\Livewire\Guru;

use App\Models\AnswerLevel1;
use App\Models\Murid;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class Respondent extends Component
{
    use LivewireAlert;
    public $data, $soal, $point_reason = [];

    public function simpanNilaiSoal1($id, $number)
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

        $answer = AnswerLevel1::find($id);
        $answer->point_reason = $this->point_reason[$number];
        $answer->total_point += $this->point_reason[$number];
        $answer->save();

        $murid = Murid::where('id', $answer->murid_id)->first();
        $murid->score_level_1 += $this->point_reason[$number];
        $murid->save();


        $this->reset('point_reason');

        $this->alert('success', 'Berhasil Menyimpan Nilai');
    }

    public function render()
    {
        $this->data = AnswerLevel1::select('answer_level1.*',
            'soal_level1.role_name as soal_role_name',
            'soal_level1.type_question as soal_type_question',
            'soal_level1.question_text as soal_question_text',
            'soal_level1.question_image as soal_question_image',
            'soal_level1.correct_answer as soal_correct_answer')
            ->join('soal_level1', 'answer_level1.soal_level1_id', '=', 'soal_level1.id')
            ->get();
        return view('livewire.guru.respondent')->extends('layouts.guru.app');
    }
}
