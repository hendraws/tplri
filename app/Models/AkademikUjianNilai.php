<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkademikUjianNilai extends Model
{
    use HasFactory;

    protected $fillable = [ 'akademik_ujian_siswa_id', 'mtk', 'wk', 'pu', 'bind', 'bing', 'nilai_akhir', ];
}
