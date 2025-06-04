<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Siswa extends Model
{
    protected $fillable = ['nama', 'nis', 'gender', 'alamat', 'kontak', 'email', 'foto', 'status_pkl'];

    public static function validateEmail($email)
    {
        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email|unique:siswas,email',
        ]);

        return $validator->passes();
    }

     public function setKontakAttribute($value)
    {
        // Mengecek jika nomor diawali dengan "08"
        if (substr($value, 0, 2) == '08') {
            // Menambahkan kode negara +62 dan menghapus angka "0"
            $this->attributes['kontak'] = '+62' . substr($value, 1);
        } else {
            // Jika sudah ada kode negara, biarkan saja
            $this->attributes['kontak'] = $value;
        }
    }


    // Menambahkan accessor untuk foto
    // public function getFotoUrlAttribute()
    // {
    //     // Menggunakan helper url() untuk membuat URL dinamis
    // return Storage::url('siswa_photos/' . $this->foto);
    // }


    public function pkls()
    {
        return $this->hasOne(Pkl::class); 
        // one to one.
        // Model ini hanya punya satu data terkait di tabel pkls. Jika model ini adalah User, maka setiap user hanya punya satu entitas Pkl.
        
    }
}
