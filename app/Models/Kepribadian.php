<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepribadian extends Model
{
    use HasFactory;

    protected $fillable = [ 'pertanyaan','sesi','jawaban_id','created_by','edited_by',];

    public function getPilihan()
    {
        return $this->hasMany(KepribadianPilihanJawaban::class, 'sesi','sesi');
    }

    public function getJawaban()
    {
        return $this->belongsTo(KepribadianPilihanJawaban::class, 'jawaban_id','id');
    }
}
