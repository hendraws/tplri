<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecerdasan extends Model implements HasMedia
{
    use HasFactory,  InteractsWithMedia;

    protected $fillable = [
        'pertanyaan',
        'kategori',
        'jawaban_id',
        'created_by',
        'edited_by',
    ];

    public function getPilihan()
    {
        return $this->hasMany(KecerdasanPilihanJawaban::class, 'kecerdasan_id','id');
    }

    public function getJawaban()
    {
        return $this->belongsTo(KecerdasanPilihanJawaban::class, 'jawaban_id','id');
    }

    public function getKategori()
    {
        return $this->belongsTo(RefOption::class,'kategori','id');
    }
}
