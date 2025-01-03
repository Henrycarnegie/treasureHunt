<?php

namespace App\Livewire\Guru;

use App\Models\Level1 as ModelsLevel1;
use App\Models\SoalLevel1;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Level1 extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $waktu_level1, $data, $tambahSoalOpen = false, $id;
    public $role_name, $type_question, $question_text, $question_image, $answer_a, $answer_b, $correct_answer, $level_time;
    protected $listeners = ['deleteConfirmed' => 'handleConfirm'];

    public function setValue($role_name, $type_question){
        $this->role_name = $role_name;
        $this->type_question = $type_question;
    }

    public function simpanWaktuLevel()
    {
        $rules = [
            'level_time' => 'required',
        ];

        $this->validate($rules);

        $waktu_level1 = ModelsLevel1::first();

        if (isset($waktu_level1)) {
            $waktu_level1->update([
                'waktu_level1' => $this->level_time,
            ]);
        }else{
            ModelsLevel1::create([
                'waktu_level1' => $this->level_time,
            ]);
        }


        $this->reset('level_time');

        $this->alert('success', 'Waktu Level Berhasil Diubah', [
            'position' => 'center',
            'toast' => false,
        ]);
    }

    public function simpanSoal(){
        $rules = [
            'role_name' => 'required',
            'type_question' => 'required',
            'question_text' => 'required|min:3|max:255',
            'question_image' => 'nullable|image|max:1024',
            'answer_a' => 'required|min:1|max:255',
            'answer_b' => 'required|min:1|max:255',
            'correct_answer' => 'required',
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
            'correct_answer.required' => 'Jawaban benar harus diisi.',
        ];

        // Validasi input
        $this->validate($rules, $customMessages);

        // Inisialisasi variabel untuk nama file
        $customFileName = null;

        if ($this->question_image) {
            // Menyimpan gambar dan mendapatkan nama file
            $customFileName = 'soal1_' . time() . '.' . $this->question_image->getClientOriginalExtension();
            $this->question_image->storeAs('soal_level1', $customFileName, 'public');
        }

        $correct_answer = $this->correct_answer === 'A' ? $this->answer_a : $this->answer_b;

        // Menyimpan data soal ke database
        SoalLevel1::create([
            'role_name' => $this->role_name,
            'type_question' => $this->type_question,
            'question_text' => $this->question_text,
            'question_image' => $customFileName, // Pastikan ini null jika tidak ada gambar
            'answer_a' => $this->answer_a,
            'answer_b' => $this->answer_b,
            'correct_answer' => $correct_answer,
        ]);

        // Reset semua properti untuk mengosongkan data dan menghapus file temporary
        $this->reset([
            'role_name',
            'type_question',
            'question_text',
            'question_image',
            'answer_a',
            'answer_b',
            'correct_answer',
        ]);

        $this->clean_tmp();
    }

    public function clean_tmp(){
        $tmp = Storage::files('livewire-tmp');
        foreach($tmp as $t){
            Storage::delete($t);
        }

        $this->tambahSoalOpen = false;

        $this->alert('success', 'Berhasil Menambahkan soal');
    }

    public function confirmDelete($id)
    {
        $this->id = $id;
        $this->alert('warning', 'Apakah Anda Yakin Ingin Menghapus Soal Ini?', [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => true,
            'confirmButtonText' => 'Ya, Hapus',
            'showCancelButton' => true,
            'cancelButtonText' => 'Batal',
            'onConfirmed' => 'deleteConfirmed',
        ]);
    }

    public function handleConfirm()
    {
        if ($this->id) {
            $this->deletePermission($this->id);
        }
    }

    public function deletePermission($id)
    {
        $soal = SoalLevel1::find($id);

        if ($soal) {
            $filePath = public_path('storage/soal_level1/' . $soal->question_image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $soal->delete();
            $this->alert('success', 'Berhasil Menghapus Soal.');
        } else {
            $this->alert('error', 'Soal Tidak Ditemukan.');
        }
    }

    public function render()
    {
        $this->waktu_level1 = ModelsLevel1::value('waktu_level1');
        $this->data = SoalLevel1::select('id', 'role_name', 'type_question', 'question_text', 'question_image', 'correct_answer')->get();
        return view('livewire.guru.level1')->extends('layouts.guru.app');
    }

}
