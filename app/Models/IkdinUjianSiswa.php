<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IkdinUjianSiswa extends Model
{
    use HasFactory;

    protected $fillable = [ 'token', 'user_id', 'ujian_id', 'skd',     ];

    public function getNilai()
    {
        return $this->belongsTo(IkdinUjianNilai::class, 'id', 'ikdin_ujian_siswa_id');
    }

}
