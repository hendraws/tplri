<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianSoal extends Model
{
    use HasFactory;

    protected $with = ['getUjianMapel','getSoal','getPilihanJawaban'];

    protected $fillable = [ 'ujian_mata_pelajaran_id',  'soal_id', ];

    public function getUjianMapel(){
        return $this->belongsTo(UjianMataPelajaran::class, 'ujian_mata_pelajaran_id','id');
    }

    public function getSoal(){
        return $this->belongsTo(Soal::class, 'soal_id', 'id');
    }

    public function getPilihanJawaban(){
        return $this->hasMany(SoalPilihanGanda::class, 'soal_id', 'soal_id');
    }
}
