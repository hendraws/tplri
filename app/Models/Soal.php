<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $fillable = [ 'mata_pelajaran_id', 'pertanyaan', 'jawaban_benar', 'pertanyaan_gambar', 'jawaban_gambar', 'created_by', 'updated_by',];

    public function getJawaban(){
        return $this->hasMany(SoalPilihanGanda::class, 'soal_id','id');
    }

    public function getJawabanBenar(){
        return $this->hasOne(SoalPilihanGanda::class, 'id','jawaban_benar');
    }


}
