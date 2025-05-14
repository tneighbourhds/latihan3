<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pkl;  // Model Pkl
use App\Models\Siswa; // Relasi dengan model Siswa
use App\Models\Industri; // Relasi dengan model Industri
use App\Models\Guru; // Relasi dengan model Guru

class CreatePkl extends Component
{
    public $siswa_id, $industri_id, $guru_id, $mulai, $selesai;

    // Menambahkan validasi untuk form input
    protected $rules = [
        'siswa_id' => 'required|exists:siswas,id',         // Validasi siswa_id
        'industri_id' => 'required|exists:industris,id',    // Validasi industri_id
        'guru_id' => 'required|exists:gurus,id',           // Validasi guru_id
        'mulai' => 'required|date',                        // Validasi tanggal mulai
        'selesai' => 'required|date|after_or_equal:mulai',  // Validasi tanggal selesai harus setelah atau sama dengan tanggal mulai
    ];

    public function save()
    // ini tu disesuaiin sama yang create-pkl.blade. pada baris     
    // <form wire:submit.prevent="save">

    {
        // Melakukan validasi data
        $this->validate();

        // Simpan data PKL
        Pkl::create([
            'siswa_id' => $this->siswa_id, //sesuai yang diberi di tabel pkl ya!
            'industri_id' => $this->industri_id,
            'guru_id' => $this->guru_id,
            'mulai' => $this->mulai, // Menggunakan properti yang sesuai
            'selesai' => $this->selesai, // Menggunakan properti yang sesuai
        ]);

        // Menampilkan pesan sukses setelah data berhasil disimpan
        session()->flash('message', 'PKL berhasil ditambahkan!');
        
        // Redirect ke halaman dashboard setelah berhasil
        return redirect()->route('dashboard');
        // jadi setelah kita submit (melaporkan diri) nanti kita bakalan diarahin ke dashbord
    }

    public function render()
    // merender (menampilkan) halaman
    {
        // Ambil data yang diperlukan untuk dropdown
        $siswas = Siswa::all();
        $industris = Industri::all();
        $gurus = Guru::all();


        // Menghapus compact('pkls') karena tidak diperlukan
        return view('livewire.create-pkl', compact('siswas', 'industris', 'gurus'))->layout('layouts.app');
        //menampilkan halaman create pkl. 
        //Compact ini akan menerima data yang berisi daftar siswa, industri, dan guru
    }
}
