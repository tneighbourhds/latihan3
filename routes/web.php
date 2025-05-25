<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\DaftarIndustri;
use App\Livewire\CreateIndustri;
use App\Livewire\DaftarGuru;
use App\Livewire\DaftarSiswa;
use App\Livewire\CreatePkl;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

Route::get('/fotofoto/{filename}', function ($filename) {
    $path = storage_path('fotofoto/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    return Response::make($file, 200)->header("Content-Type", $type);
});

// Halaman Create Pkl
Route::get('/pkl/create', CreatePkl::class)->name('pkl.create');


Route::get('/siswa', DaftarSiswa::class)->name('siswa.index');


Route::get('/industri/create', CreateIndustri::class)->name('industri.create');

Route::get('/guru', DaftarGuru::class)->name('guru.index');



Route::get('/industri', DaftarIndustri::class)->name('industri.index');



Route::get('/', function () {
    return view('landingpage');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Rute dashboard utama yang memeriksa peran pengguna
    Route::get('/dashboard', function () {
        $user = Auth::user();  // Mendapatkan data pengguna yang sedang login

        // Cek peran pengguna setelah login
        if ($user->hasRole('admin')) {
            // Jika pengguna adalah admin, arahkan ke dashboard admin
            return redirect()->route('admin.dashboard');
        }

        // Jika pengguna bukan admin, arahkan ke dashboard biasa
        return view('dashboard');
    })->name('dashboard');
});

// Rute untuk dashboard admin
Route::middleware(['auth:sanctum', 'verified'])->get('/admin/dashboard', function () { // m
    return view('admin.dashboard');  // Tampilan dashboard untuk admin
})->name('admin.dashboard');



