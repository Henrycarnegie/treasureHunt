<?php

namespace App\Livewire\Murid;

use App\Models\Murid;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Leaderboard extends Component
{
    public $skor_polisi = 0, $skor_detektif = 0, $skor_petani = 0, $skor_nelayan = 0;
    public $avatars = [];

    public function mount()
    {
        // Ambil data murid berdasarkan users_id
        $polisi = Murid::where('users_id', 2)->first();
        $detektif = Murid::where('users_id', 3)->first();
        $nelayan = Murid::where('users_id', 4)->first();
        $petani = Murid::where('users_id', 5)->first();

        // Hitung total skor untuk setiap kelompok
        $this->skor_polisi = $this->hitungTotalSkor($polisi);
        $this->skor_detektif = $this->hitungTotalSkor($detektif);
        $this->skor_nelayan = $this->hitungTotalSkor($nelayan);
        $this->skor_petani = $this->hitungTotalSkor($petani);

        // Siapkan avatars dalam base64
        $this->avatars = $this->siapkanAvatar();
    }

    // Fungsi untuk menghitung total skor
    private function hitungTotalSkor($murid)
    {
        return
            $murid->score_level_1 +
            $murid->score_level_2 +
            $murid->score_level_3 +
            $murid->score_level_4 +
            $murid->score_level_5;
    }

    private function siapkanAvatar()
    {
        $avatars = [
            'polisi' => public_path('img/polisi.png'),
            'detektif' => public_path('img/detektif.png'),
            'nelayan' => public_path('img/nelayan.png'),
            'petani' => public_path('img/petani.png'),
        ];
        $base64Avatars = [];

        foreach ($avatars as $key => $path) {
            if (file_exists($path)) {
                $imageData = file_get_contents($path);
                $mimeType = mime_content_type($path);
                $base64Avatars[$key] = 'data:' . $mimeType . ';base64,' . base64_encode($imageData);
            } else {
                $base64Avatars[$key] = null; // Atur null jika file tidak ditemukan
            }
        }

        return $base64Avatars;
    }

    public function render()
    {
        return view('livewire.murid.leaderboard', [
            'avatars' => $this->avatars,
            'skor_polisi' => $this->skor_polisi,
            'skor_detektif' => $this->skor_detektif,
            'skor_nelayan' => $this->skor_nelayan,
            'skor_petani' => $this->skor_petani
        ])->extends('layouts.app');
    }
}
