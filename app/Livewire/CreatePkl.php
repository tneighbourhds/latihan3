<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pkl;  // Model Pkl
use App\Models\Siswa; // Relasi dengan model Siswa
use App\Models\Industri; // Relasi dengan model Industri
use App\Models\Guru; // Relasi dengan model Guru
use Illuminate\Support\Facades\DB; // Import DB untuk transaksi

class CreatePkl extends Component
{
    public $siswa_id, $industri_id, $guru_id, $mulai, $selesai;

    // $sudahInput berfungsi sebagai flag untuk mengecek apakah siswa sudah pernah mengisi data PKL sebelumnya atau belum
    public $sudahInput = false; // ✅ Properti untuk cek input PKL
    // sudah input berarti sudah isi, nah false itu kan maksudnya berarti kita gabisa ngisi form lagi
    // jadi misal dah input, yaudah false kaga bisa lapor lagi.


    // ✅ Ini mount-nya kamu taruh di sini
    public function mount()
    {
        // Ambil id siswa berdasarkan email yang sedang login
        $siswaId = Siswa::where('email', auth()->user()->email)->value('id');   // Mendapatkan ID siswa berdasarkan email yang sedang login melalui auth()->user()->email.

        $this->siswa_id = $siswaId; // Menyimpan ID siswa yang diperoleh ke dalam properti $siswa_id.

        // Cek apakah sudah pernah input PKL
        $this->sudahInput = Pkl::where('siswa_id', $siswaId)->exists();
        // Mengecek apakah siswa sudah pernah mengisi data PKL. Jika sudah, properti $sudahInput di-set menjadi true.
    }

    // Menambahkan validasi untuk form input
    protected $rules = [
        'siswa_id' => 'required|exists:siswas,id',         // Validasi siswa_id
        'industri_id' => 'required|exists:industris,id',    // Validasi industri_id
        'guru_id' => 'required|exists:gurus,id',           // Validasi guru_id
        'mulai' => 'required|date',                        // Validasi tanggal mulai
        'selesai' => 'required|date|after_or_equal:mulai',  // Validasi tanggal selesai harus setelah atau sama dengan tanggal mulai
    ];

    public function save()
    {
        // Melakukan validasi data
        $this->validate();

        // Menggunakan DB::beginTransaction() untuk memulai transaksi, kemudian mencoba menyimpan data PKL dengan Pkl::create(). Jika berhasil, transaksi di-commit dengan DB::commit().

        DB::beginTransaction();

        try {
            // Simpan data PKL
            Pkl::create([
                'siswa_id' => $this->siswa_id, //sesuai yang diberi di tabel pkl ya!
                'industri_id' => $this->industri_id,
                'guru_id' => $this->guru_id,
                'mulai' => $this->mulai, // Menggunakan properti yang sesuai
                'selesai' => $this->selesai, // Menggunakan properti yang sesuai
            ]);

            DB::commit();

            // Menampilkan pesan sukses setelah data berhasil disimpan
            session()->flash('message', 'PKL berhasil ditambahkan!');
            
            // Redirect ke halaman dashboard setelah berhasil
            return redirect()->route('dashboard');

            // menangani kesalahan atau exception yang terjadi selama eksekusi kode dalam blok try.
            } catch (\Exception $e) { // menangkap dan menangani error atau exception yang terjadi selama eksekusi kode di dalam blok try.
                DB::rollBack(); //membatalkan transaksi database yang telah dimulai dengan DB::beginTransaction() di awal.

            // Menangani error dan menampilkan pesan error
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        // Ambil data yang diperlukan untuk dropdown
        $industris = Industri::all();
        $gurus = Guru::all();
        $siswas = Siswa::where('email', auth()->user()->email)->get();  // Menampilkan siswa sesuai email yang login

        // Menampilkan halaman create-pkl dengan data siswa, industri, dan guru
        return view('livewire.create-pkl', compact('siswas', 'industris', 'gurus'))->layout('layouts.app');
    }
}
