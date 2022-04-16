<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Soal extends Model implements HasMedia
{
    use HasFactory, Userstamps, SoftDeletes, InteractsWithMedia;

    // protected $connection = 'DbBankSoal';
    // protected $table = 'soal';

    protected $fillable = ['pertanyaan', 'jawaban_id', 'mapel', 'jabatan', 'created_by', 'updated_by','deleted_by','duplicate'];

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
