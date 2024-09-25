<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\Tendik;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';
    protected $fillable = ['tendik_id', 'siswa_id', 'date', 'jam_masuk', 'jam_pulang','status'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
    public function tendik()
    {
        return $this->belongsTo(Tendik::class, 'tendik_id', 'id');
    }

    public function scopeIsNullSiswa(){
        return $this->whereNull('siswa_id');
    }
}
