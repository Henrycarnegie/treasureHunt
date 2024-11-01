<?php

namespace App\Livewire\Guru;

use App\Models\Level1 as ModelsLevel1;
use Livewire\Component;
use Livewire\WithFileUploads;

class Level1 extends Component
{
    use WithFileUploads;

    public $role_name, $type_question, $question_text, $question_image, $answer_a, $answer_b, $answer_c, $answer_d, $corret_answer = 'd';

    public function setValue($role_name, $type_question){
        $this->role_name = $role_name;
        $this->type_question = $type_question;
    }

    public function simpanSoal()
    {
        $rules = [
            'role_name' => 'required',
            'type_question' => 'required',
            'question_text' => 'required|min:3|max:255',
            'question_image' => 'nullable|file|image|max:1024',
            'answer_a' => 'required|min:3|max:255',
            'answer_b' => 'required|min:3|max:255',
            'answer_c' => 'required|min:3|max:255',
            'answer_d' => 'required|min:3|max:255',
            'corret_answer' => 'required',
        ];

        $customMessages = [
            'role_name.required' => 'Nama role harus diisi.',
            'type_question.required' => 'Tipe pertanyaan harus diisi.',
            'question_text.required' => 'Teks pertanyaan harus diisi.',
            'question_text.min' => 'Teks pertanyaan harus minimal 3 karakter.',
            'question_text.max' => 'Teks pertanyaan tidak boleh lebih dari 255 karakter.',
            'question_image.image' => 'File yang diunggah harus berupa gambar.',
            'question_image.max' => 'Ukuran gambar tidak boleh lebih dari 1MB.',
            'answer_a.required' => 'Jawaban A harus diisi.',
            'answer_a.min' => 'Jawaban A harus minimal 3 karakter.',
            'answer_a.max' => 'Jawaban A tidak boleh lebih dari 255 karakter.',
            'answer_b.required' => 'Jawaban B harus diisi.',
            'answer_b.min' => 'Jawaban B harus minimal 3 karakter.',
            'answer_b.max' => 'Jawaban B tidak boleh lebih dari 255 karakter.',
            'answer_c.required' => 'Jawaban C harus diisi.',
            'answer_c.min' => 'Jawaban C harus minimal 3 karakter.',
            'answer_c.max' => 'Jawaban C tidak boleh lebih dari 255 karakter.',
            'answer_d.required' => 'Jawaban D harus diisi.',
            'answer_d.min' => 'Jawaban D harus minimal 3 karakter.',
            'answer_d.max' => 'Jawaban D tidak boleh lebih dari 255 karakter.',
            'corret_answer.required' => 'Jawaban benar harus diisi.',
        ];

        // dd($this->type_question, $this->role_name);

        // Cek dan validasi input
        $this->validate($rules, $customMessages);

        // Mengunggah gambar jika ada
        if ($this->question_image) {
            $customFileName = 'soal1_' . time() . '.' . $this->question_image->getClientOriginalExtension();
            $this->question_image->storeAs('soal_level1', $customFileName, 'public');
            $this->question_image = $customFileName;
        }

        // Menyimpan soal ke database
        ModelsLevel1::create([
            'role_name' => $this->role_name,
            'type_question' => $this->type_question,
            'question_text' => $this->question_text,
            'question_image' => $this->question_image,
            'answer_a' => $this->answer_a,
            'answer_b' => $this->answer_b,
            'answer_c' => $this->answer_c,
            'answer_d' => $this->answer_d,
            'corret_answer' => $this->corret_answer,
        ]);

        // Reset variabel
        $this->reset([
            'role_name',
            'type_question',
            'question_text',
            'question_image',
            'answer_a',
            'answer_b',
            'answer_c',
            'answer_d',
            'corret_answer',
        ]);
    }

    public function render()
    {
        return view('livewire.guru.level1')->extends('layouts.guru.app');
    }
}
