<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalAgendaKelas extends Model
{
    use HasFactory;
    protected $table = 'jurnal_agenda_kelas';
    protected $fillable = ['tendik_id', 'mapel', 'tanggal', 'jam_mulai', 'jam_berakhir', 'kelas', 'materi', 'hadir', 'sakit', 'izin', 'alpa', 'keterangan'];

    public function tendik()
    {
        return $this->belongsTo(Tendik::class);
    }
}
