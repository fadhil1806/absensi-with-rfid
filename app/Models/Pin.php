<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    use HasFactory;
    protected $table = 'pin';
    protected $fillable = ['pin'];
    protected $hidden = [
        'pin'
    ];
    protected function casts(): array
    {
        return [
            'pin' => 'hashed',
        ];
    }
}
