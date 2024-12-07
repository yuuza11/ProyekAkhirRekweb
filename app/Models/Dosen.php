<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen'; // Nama tabel

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama',
        'nidn',
        'email',
    ];
}
