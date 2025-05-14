<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pkl;  // Pastikan kamu sudah membuat model Siswa


class DaftarSiswa extends Component
{
    public function render()
    {
        // Ambil semua data siswa
        $pkls = Pkl::all();

        return view('livewire.daftar-siswa', compact('pkls'))->layout('layouts.app');
        // melihat daftar siswa. lalu compact pkls adalah untuk memanggil tabel pkl
    }
}