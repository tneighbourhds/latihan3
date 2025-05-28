<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = ['nama', 'nip', 'gender', 'alamat', 'kontak', 'email'];

    public function pkls()
    {
        return $this->hasMany(Pkl::class);
    // one to many. yang dimana misal guru itu idnya cuma 1 tapi bisa dipake di beberapa daftar.

    }
}
