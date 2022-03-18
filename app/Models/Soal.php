<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Soal extends Model
{
    use HasFactory, Userstamps, SoftDeletes;

    protected $connection = 'DbBankSoal';
    protected $table = 'soal';

    protected $fillable = ['pertanyaan', 'jawaban_id', 'mapel', 'jabatan', 'created_by', 'updated_by','deleted_by'];

    protected $with = ['getPilihan'];

    public function getPilihan()
    {
        return $this->hasMany(SoalPilihanGanda::class, 'soal_id','id');
    }

    public function getJawaban()
    {
        return $this->belongsTo(SoalPilihanGanda::class, 'jawaban_id','id');
    }

    // public function getJawabanBenar(){
    //     return $this->hasOne(SoalPilihanGanda::class, 'id','jawaban_benar');
    // }


}
