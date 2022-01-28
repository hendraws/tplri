<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $fillable = ['nama_mapel', 'created_by',  'updated_by',];

    public function getSoal(){
        return $this->hasMany(Soal::class, 'mata_pelajaran_id', 'id');
    }
}
