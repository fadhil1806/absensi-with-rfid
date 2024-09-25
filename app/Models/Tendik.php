<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tendik extends Model
{
    use HasFactory;
    protected $table = 'tendik';
    protected $fillable = ['nik', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'role', 'jam_masuk', 'jam_pulang', 'nomor_whatsapp', 'foto'];

    public function izin()
    {
        return $this->hasMany('App\Models\Izin');
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
