<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecerdasan extends Model
{
    use HasFactory;

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
