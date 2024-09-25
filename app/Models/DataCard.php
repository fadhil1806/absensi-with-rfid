<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataCard extends Model
{
    use HasFactory;

    protected $table = 'data_card';

    // Kolom yang bisa diisi
    protected $fillable = [
        'card_id',
        'tendik_id',
        'siswa_id',
        'status',
    ];

    // Relasi ke model Tendik
    public function tendik()
    {
        return $this->belongsTo(Tendik::class, 'tendik_id');
    }

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
