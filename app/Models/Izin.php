<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;
    protected $table = 'izin';
    protected $fillable = ['siswa_id', 'tendik_id', 'jenis_izin', 'tanggal', 'jam_mulai', 'jam_berakhir', 'keterangan', 'foto', 'created_at'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function tendik()
    {
        return $this->belongsTo(Tendik::class);
    }
}
