<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformMerdekaMengajar extends Model
{
    use HasFactory;
    protected $table = 'platform_merdeka_mengajar';
    protected $fillable = ['tendik_id', 'topik', 'tanggal', 'jam_mulai', 'jam_berakhir', 'hasil', 'sertifikat'];

    public function tendik()
    {
        return $this->belongsTo(Tendik::class);
    }
}
