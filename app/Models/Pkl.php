<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Industri;
use App\Models\Guru;
use Illuminate\Support\Carbon;


class Pkl extends Model
{
    protected $table = 'pkls';

    protected $fillable = ['siswa_id', 'industri_id', 'guru_id', 'mulai', 'selesai'];

    protected $casts = [
        'mulai' => 'date',
        'selesai' => 'date',
    ];

     // Membuat accessor
    public function getDurasiAttribute()
    {
        if ($this->mulai && $this->selesai) {
            return $this->mulai->diffInDays($this->selesai);
        }
        return null;  // atau 0, sesuai kebutuhan
    }

    // di App\Models\Pkl.php
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function industri()
    {
        return $this->belongsTo(Industri::class);
    }
    protected static function booted()
    {
        static::saving(function ($pkl) {
            if ($pkl->mulai && $pkl->selesai) {
                $durasi = $pkl->mulai->diffInDays($pkl->selesai);

                if ($durasi < 90) {
                    throw new \Exception('Durasi PKL minimal harus 90 hari.');
                }
            }
        });
    }
}