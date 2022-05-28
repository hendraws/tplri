<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianSiswaJawabanKecermatan extends Model
{
    use HasFactory;

    protected $fillable = [ 'ujian_siswa_id', 'soal_id', 'soal_a', 'soal_b', 'soal_c', 'soal_d', 'jawaban', 'benar',     ];


}
