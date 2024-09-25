<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Futsal extends Model
{
    use HasFactory;
    protected $table = 'futsal';
    protected $fillable = ['pelatih', 'tanggal', 'jam_mulai', 'jam_berakhir', 'kelas', 'materi', 'hadir', 'sakit', 'izin', 'alpa'];
}
