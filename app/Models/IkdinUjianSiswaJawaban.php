<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IkdinUjianSiswaJawaban extends Model
{
    use HasFactory;

    protected $fillable = [
        'ikdin_ujian_siswa_id', 'soal_id', 'jawaban_id', 'kategori','benar', 'skor',
    ];

}
