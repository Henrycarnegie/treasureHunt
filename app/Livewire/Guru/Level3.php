<?php

namespace App\Livewire\Guru;

use App\Models\BoxLevel3;
use App\Models\Level3 as ModelsLevel3;
use App\Models\SoalLevel3;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Level3 extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $waktu_level3, $data, $tambahSoalOpen = false, $id;
    public $question_text, $question_image, $level_time;
    protected $listeners = ['deleteConfirmed' => 'handleConfirm'];

    public function simpanWaktuLevel()
    {
        $rules = [
            'level_time' => 'required',
        ];

        $this->validate($rules);

        $waktu_level3 = ModelsLevel3::first();

        if (isset($waktu_level3)) {
            $waktu_level3->update([
                'waktu_level3' => $this->level_time,
            ]);
        }else{
            ModelsLevel3::create([
                'waktu_level3' => $this->level_time,
            ]);
        }


        $this->reset('level_time');

        $this->alert('success', 'Waktu Level Berhasil Diubah', [
            'position' => 'center',
            'toast' => false,
        ]);
    }

    public function simpanSoal($boxId){
        $rules = [
            'question_text' => 'required|min:3|max:255',
            'question_image' => 'nullable|file|image|max:1024',
        ];

        $customMessages = [
            'question_text.required' => 'Teks pertanyaan harus diisi.',
            'question_text.min' => 'Teks pertanyaan harus minimal 3 karakter.',
            'question_text.max' => 'Teks pertanyaan tidak boleh lebih dari 255 karakter.',
            'question_image.image' => 'File yang diunggah harus berupa gambar.',
            'question_image.max' => 'Ukuran gambar tidak boleh lebih dari 1MB.',
        ];

        // Validasi input
        $this->validate($rules, $customMessages);

        // Inisialisasi variabel untuk nama file
        $customFileName = null;

        if ($this->question_image) {
            // Menyimpan gambar dan mendapatkan nama file
            $customFileName = 'soal3_' . time() . '.' . $this->question_image->getClientOriginalExtension();
            $this->question_image->storeAs('soal_level3', $customFileName, 'public');
        }

        // Menyimpan data soal ke database
        SoalLevel3::create([
            'box_id' => $boxId,
            'question_text' => $this->question_text,
            'question_image' => $customFileName,
        ]);

        // Reset semua properti untuk mengosongkan data dan menghapus file temporary
        $this->reset([
            'question_text',
            'question_image',
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
        $soal = SoalLevel3::find($id);

        if ($soal) {
            $filePath = public_path('storage/soal_level3/' . $soal->question_image);
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
        $this->data = BoxLevel3::with('soalLevel3')->get();
        $this->waktu_level3 = ModelsLevel3::value('waktu_level3');
        return view('livewire.guru.level3')->extends('layouts.guru.app');
    }
}
