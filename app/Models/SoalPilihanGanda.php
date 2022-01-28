<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalPilihanGanda extends Model
{
    use HasFactory;

    protected $fillable = [ 'soal_id', 'pilihan', 'jawaban', 'bobot_nilai', 'benar', 'pilihan_gambar', ];
}
