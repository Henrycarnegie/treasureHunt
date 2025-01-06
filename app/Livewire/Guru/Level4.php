<?php

namespace App\Livewire\Guru;

use App\Models\IkanLevel4;
use App\Models\Level4 as ModelsLevel4;
use App\Models\SoalLevel4;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Level4 extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $waktu_level4, $data, $tambahSoalOpen = false, $id;
    public $question_text, $question_image, $type, $level_time, $deskripsi_opening, $modalOpening = false;
    protected $listeners = ['deleteConfirmed' => 'handleConfirm'];

    public function simpanWaktuLevel()
    {
        $rules = [
            'level_time' => 'required',
        ];

        $this->validate($rules);

        $waktu_level4 = ModelsLevel4::first();

        if (isset($waktu_level4)) {
            $waktu_level4->update([
                'waktu_level4' => $this->level_time,
            ]);
        }else{
            ModelsLevel4::create([
                'waktu_level4' => $this->level_time,
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
            'type' => 'required',
            'question_text' => 'required|min:3',
            'question_image' => 'nullable|file|image|max:10240',
        ];

        $customMessages = [
            'type.required' => 'Jenis ikan harus diisi.',
            'question_text.required' => 'Teks pertanyaan harus diisi.',
            'question_text.min' => 'Teks pertanyaan harus minimal 3 karakter.',
            'question_image.image' => 'File yang diunggah harus berupa gambar.',
            'question_image.max' => 'Ukuran gambar tidak boleh lebih dari 1MB.',
        ];

        // Validasi input
        $this->validate($rules, $customMessages);

        // Inisialisasi variabel untuk nama file
        $customFileName = null;

        if ($this->question_image) {
            // Menyimpan gambar dan mendapatkan nama file
            $customFileName = 'soal4_' . time() . '.' . $this->question_image->getClientOriginalExtension();
            $this->question_image->storeAs('soal_level4', $customFileName, 'public');
        }

        // Menyimpan data soal ke database
        SoalLevel4::create([
            'type' => $this->type,
            'question_text' => $this->question_text,
            'question_image' => $customFileName,
        ]);

        // Reset semua properti untuk mengosongkan data dan menghapus file temporary
        $this->reset([
            'type',
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
        $soal = SoalLevel4::find($id);

        if ($soal) {
            $filePath = public_path('storage/soal_level4/' . $soal->question_image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $soal->delete();
            $this->alert('success', 'Berhasil Menghapus Soal.');
        } else {
            $this->alert('error', 'Soal Tidak Ditemukan.');
        }
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

        $deskripsi_opening = ModelsLevel4::first();

        if (isset($deskripsi_opening)) {
            $deskripsi_opening->update([
                'text' => $this->deskripsi_opening,
            ]);
        }else{
            ModelsLevel4::create([
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
        $this->data = SoalLevel4::all();
        $this->deskripsi_opening = ModelsLevel4::value('text');
        $this->waktu_level4 = ModelsLevel4::value('waktu_level4');
        return view('livewire.guru.level4')->extends('layouts.guru.app');
    }
}
