<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pkl;

class DaftarSiswa extends Component
{
    public $search = '';  // Properti untuk pencarian siswa

    public function render()
    {
        // Menyaring data PKL berdasarkan nama siswa yang mengandung kata pencarian
        $pkls = Pkl::whereHas('siswa', function ($query) {
            // Menggunakan like untuk mencocokkan nama yang mengandung kata pencarian
            $query->where('nama', 'like', '%' . $this->search . '%');
        })->get();

        return view('livewire.daftar-siswa', compact('pkls'));
    }

    // Menambahkan method untuk update pencarian saat tombol enter ditekan
    public function updateSearch()
    {
        // Anda bisa memanipulasi data pencarian di sini jika diperlukan
    }
}
