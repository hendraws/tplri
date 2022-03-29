<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkademikUjianSiswaJawaban extends Model
{
    use HasFactory;

    protected $fillable = ['akademik_ujian_siswa_id', 'soal_id', 'mapel', 'jawaban_id', 'benar'];

}
