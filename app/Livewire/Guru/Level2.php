<?php

namespace App\Livewire\Guru;

use App\Models\Level2 as ModelsLevel2;
use App\Models\SoalLevel2;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Level2 extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $waktu_level2, $data, $tambahSoalOpen = false, $id;
    public $question_text, $question_image, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $level_time, $deskripsi_opening, $modalOpening = false;
    protected $listeners = ['deleteConfirmed' => 'handleConfirm'];


    public function simpanWaktuLevel()
    {
        $rules = [
            'level_time' => 'required',
        ];

        $this->validate($rules);

        $waktu_level1 = ModelsLevel2::first();

        if (isset($waktu_level1)) {
            $waktu_level1->update([
                'waktu_level2' => $this->level_time,
            ]);
        }else{
            ModelsLevel2::create([
                'waktu_level2' => $this->level_time,
            ]);
        }


        $this->reset('level_time');

        $this->alert('success', 'Waktu Level Berhasil Diubah', [
            'position' => 'center',
            'toast' => false,
        ]);
    }

    public function simpanSoal()
    {
        // dd($this->question_text);
        $rules = [
            'question_text' => 'required|min:3',
            'question_image' => 'nullable|file|image|max:10240',
            'answer_a' => 'required|min:1',
            'answer_b' => 'required|min:1',
            'answer_c' => 'required|min:1',
            'answer_c' => 'required|min:1',
            'correct_answer' => 'required',
        ];

        $customMessages = [
            'question_text.required' => 'Teks pertanyaan harus diisi.',
            'question_text.min' => 'Teks pertanyaan harus minimal 3 karakter.',
            'question_image.image' => 'File yang diunggah harus berupa gambar.',
            'question_image.max' => 'Ukuran gambar tidak boleh lebih dari 1MB.',
            'answer_a.required' => 'Jawaban A harus diisi.',
            'answer_a.min' => 'Jawaban A harus minimal 3 karakter.',
            'answer_b.required' => 'Jawaban B harus diisi.',
            'answer_b.min' => 'Jawaban B harus minimal 3 karakter.',
            'answer_c.required' => 'Jawaban C harus diisi.',
            'answer_c.min' => 'Jawaban C harus minimal 3 karakter.',
            'answer_d.required' => 'Jawaban D harus diisi.',
            'answer_d.min' => 'Jawaban D harus minimal 3 karakter.',
            'correct_answer.required' => 'Jawaban benar harus diisi.',
        ];

        // Validasi input
        $this->validate($rules, $customMessages);

        // Inisialisasi variabel untuk nama file
        $customFileName = null;

        if ($this->question_image) {
            // Menyimpan gambar dan mendapatkan nama file
            $customFileName = 'soal2_' . time() . '.' . $this->question_image->getClientOriginalExtension();
            $this->question_image->storeAs('soal_level2', $customFileName, 'public');
        }

        $correct_answer = null;

        if($this->correct_answer == "A"){
            $correct_answer = $this->answer_a;
        }else if($this->correct_answer == "B"){
            $correct_answer = $this->answer_b;
        }else if($this->correct_answer == "C"){
            $correct_answer = $this->answer_c;
        }else if($this->correct_answer == "D"){
            $correct_answer = $this->answer_d;
        }

        // Menyimpan data soal ke database
        SoalLevel2::create([
            'question_text' => $this->question_text,
            'question_image' => $customFileName,
            'answer_a' => $this->answer_a,
            'answer_b' => $this->answer_b,
            'answer_c' => $this->answer_c,
            'answer_d' => $this->answer_d,
            'correct_answer' => $correct_answer,
        ]);

        $this->reset([
            'question_text',
            'question_image',
            'answer_a',
            'answer_b',
            'answer_c',
            'answer_d',
            'correct_answer',
        ]);

        $this->clean_tmp();
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
        $soal = SoalLevel2::find($id);

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

    public function clean_tmp(){
        $tmp = Storage::files('livewire-tmp');
        foreach($tmp as $t){
            Storage::delete($t);
        }

        $this->tambahSoalOpen = false;

        $this->alert('success', 'Berhasil Menambahkan soal');
    }
    public function simpanOpening()
    {
        $rules = [
            'deskripsi_opening' => 'required|min:3',
        ];

        $customMessages = [
            'deskripsi_opening.required' => 'Deskripsi opening harus diisi.',
            'deskripsi_opening.min' => 'Deskripsi opening harus minimal 3 karakter.',
        ];

        $this->validate($rules, $customMessages);

        $deskripsi_opening = ModelsLevel2::first();

        if (isset($deskripsi_opening)) {
            $deskripsi_opening->update([
                'text' => $this->deskripsi_opening,
            ]);
        }else{
            ModelsLevel2::create([
                'text' => $this->deskripsi_opening,
            ]);
        }

        $this->reset('deskripsi_opening');

        $this->alert('success', 'Deskripsi Opening Berhasil Diubah', [
            'position' => 'center',
            'toast' => false,
        ]);

        $this->modalOpening = false;
    }

    public function render()
    {
        $this->waktu_level2 = ModelsLevel2::value('waktu_level2');
        $this->deskripsi_opening = ModelsLevel2::value('text');
        $this->data = SoalLevel2::select('id', 'question_text', 'question_image', 'correct_answer')->get();
        return view('livewire.guru.level2')->extends('layouts.guru.app');
    }
}
