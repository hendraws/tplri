<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IkdinUjianNilai extends Model
{
    use HasFactory;

    protected $fillable =
    [ 'ikdin_ujian_siswa_id','twk','tiu','tkp','nilai_akhir',    ];


    public function getUjianSiswa() {
        return $this->belongsTo(IkdinUjianSiswa::class, 'ikdin_ujian_siswa_id','id');
    }

}
