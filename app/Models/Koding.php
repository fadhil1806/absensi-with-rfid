<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koding extends Model
{
    use HasFactory;
    protected $table = 'koding';
    protected $fillable = ['pelatih', 'tanggal', 'jam_mulai', 'jam_berakhir', 'kelas', 'materi', 'hadir', 'sakit', 'izin', 'alpa'];
}
