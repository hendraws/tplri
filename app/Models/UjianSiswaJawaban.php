<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianSiswaJawaban extends Model
{
    use HasFactory;

    protected $fillable = [ 'ujian_siswa_id', 'soal_id','kategori', 'jawaban_id','benar' ];
}
