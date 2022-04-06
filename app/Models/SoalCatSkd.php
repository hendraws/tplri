<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SoalCatSkd extends Model  implements HasMedia
{
    use HasFactory, Userstamps, SoftDeletes, InteractsWithMedia;


    protected $fillable = ['pertanyaan', 'jawaban_id', 'mapel', 'kategori', 'created_by', 'updated_by','deleted_by','duplicate'];

    public function getPilihan()
    {
        return $this->hasMany(SoalPilihanCatSkd::class, 'soal_id','id');
    }

    public function getJawaban()
    {
        return $this->belongsTo(SoalPilihanCatSkd::class, 'jawaban_id','id');
    }

}
