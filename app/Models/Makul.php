<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makul extends Model
{
    use HasFactory;

    protected $table = 'makul'; // Nama tabel

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'kode',
        'nama',
        'sks',
        'semester',
    ];
}
