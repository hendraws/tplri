<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkademikUjianSiswa extends Model
{
    use HasFactory;

    protected $fillable = [ 'token', 'user_id', 'ujian_id', 'mtk', 'wk', 'pu', 'bahasa', 'status' ];

    public function getNilai()
    {
        return $this->belongsTo(AkademikUjianNilai::class, 'id', 'akademik_ujian_siswa_id');
    }
}
