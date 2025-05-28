<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    protected $fillable = ['nama', 'bidang_usaha', 'alamat', 'kontak', 'email'];

    public function pkls()
    {
        return $this->hasMany(Pkl::class);
        // one to many. yang dimana misal industri itu idnya cuma 1 tapi bisa dipake di beberapa daftar.
    }
}
