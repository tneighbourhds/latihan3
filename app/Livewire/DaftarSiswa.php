<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pkl;

class DaftarSiswa extends Component
{
    use WithPagination;

    public $search = '';  // Properti untuk pencarian siswa

    protected $paginationTheme = 'tailwind';

    // Reset halaman ke 1 setiap kali pencarian diubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Gunakan paginate() untuk mendukung pagination dan onEachSide()
        $pkls = Pkl::with(['siswa', 'industri', 'guru']) // eager load relasi
                    ->whereHas('siswa', function ($query) {
                        $query->where('nama', 'like', '%' . $this->search . '%');
                    })
                    ->paginate(2); // Ubah dari get() ke paginate()

        return view('livewire.daftar-siswa', compact('pkls'));
    }

    // Opsional, jika ingin pencarian di-trigger manual
    public function updateSearch()
    {
        $this->resetPage();
    }
}
