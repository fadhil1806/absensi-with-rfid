<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataCardAlert extends Model
{
    use HasFactory;

    // Nama tabel yang sesuai dengan migrasi
    protected $table = 'data_card_alert';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'card_id',
        'data_card_id',
        'status',
    ];

    /**
     * Relasi ke tabel data_card
     */
    public function dataCard()
    {
        return $this->belongsTo(DataCard::class, 'data_card_id');
    }
}
