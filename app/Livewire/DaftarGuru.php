<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Guru;

class DaftarGuru extends Component
{
    public function render()
    {
        // Ambil data guru berdasarkan pencarian
        $gurus = Guru::all();


        return view('livewire.daftar-guru', compact('gurus'))->layout('layouts.app');
    }
}

