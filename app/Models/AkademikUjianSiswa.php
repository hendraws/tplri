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

    public function getSiswa()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function getUjian()
    {
        return $this->belongsTo(Ujian::class, 'ujian_id', 'id');
    }
}
