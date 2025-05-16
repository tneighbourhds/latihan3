<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Siswa extends Model
{
    protected $fillable = ['nama', 'nis', 'gender', 'alamat', 'kontak', 'email', 'foto', 'status_pkl'];

    // Menambahkan accessor untuk foto
    // public function getFotoUrlAttribute()
    // {
    //     // Menggunakan helper url() untuk membuat URL dinamis
    // return Storage::url('siswa_photos/' . $this->foto);
    // }


    public function pkls()
    {
        return $this->hasOne(Pkl::class);
    }
}
