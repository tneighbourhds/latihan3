<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

use App\Livewire\DaftarIndustri;
use App\Livewire\CreateIndustri;
use App\Livewire\DaftarGuru;
use App\Livewire\DaftarSiswa;
use App\Livewire\CreatePkl;

// Route untuk menampilkan gambar dari storage
Route::get('/fotofoto/{filename}', function ($filename) {
    $path = storage_path('fotofoto/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    return Response::make($file, 200)->header("Content-Type", $type);
});

// Halaman landing page
Route::get('/', function () {
    return view('landingpage');
});

// Halaman CRUD/Daftar
Route::get('/pkl/create', CreatePkl::class)->name('pkl.create');
Route::get('/siswa', DaftarSiswa::class)->name('siswa.index');
Route::get('/industri/create', CreateIndustri::class)->name('industri.create');
Route::get('/industri', DaftarIndustri::class)->name('industri.index');
Route::get('/guru', DaftarGuru::class)->name('guru.index');

// Middleware untuk siswa (user biasa)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'check_user_role',
    'role:siswa',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Middleware untuk admin
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin',
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
