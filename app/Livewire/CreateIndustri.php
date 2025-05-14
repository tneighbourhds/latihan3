<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Industri;

class CreateIndustri extends Component
{
    public $nama, $bidang_usaha, $alamat, $kontak, $email;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'bidang_usaha' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'kontak' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ];

    // Metode untuk menyimpan data industri
    public function save()
    {
        $this->validate(); // Validasi input

        // Simpan industri ke database
        Industri::create([
            'nama' => $this->nama,
            'bidang_usaha' => $this->bidang_usaha,
            'alamat' => $this->alamat,
            'kontak' => $this->kontak,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Industri berhasil ditambahkan!');  // Tampilkan pesan sukses
        return redirect()->route('industri.index');  // Kembali ke daftar industri setelah submit
    }

    public function render()
    {
        return view('livewire.create-industri')->layout('layouts.app');
    }
}
