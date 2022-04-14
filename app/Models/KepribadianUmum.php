<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepribadianUmum extends Model
{
    use HasFactory;



    protected $fillable = [ 'pertanyaan','sesi','jenis','jawaban_id','created_by','edited_by',];

    public function getPilihan()
    {
        return $this->hasMany(KepribadianPilihanJawaban::class, 'kepribadian_id','id');
    }

    public function getJawaban()
    {
        return $this->belongsTo(KepribadianPilihanJawaban::class, 'jawaban_id','id');
    }

    public function getPilihanSesi2()
    {
        return $this->hasMany(KepribadianPilihanJawaban::class, 'sesi','sesi');
    }
}
