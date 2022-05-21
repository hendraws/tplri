<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianSiswa extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'ujian_id', 'kecerdasan', 'kepribadian', 'kecermatan', 'status_ujian',  'token' , 'status_akses'   ];

    public function getSiswa()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function jawabanBenarKecerdasan()
    {
        return $this->hasMany(UjianSiswaJawabanKecerdasan::class, 'ujian_siswa_id','id')->where('benar', 1);
    }
    public function jawabanBenarKecermatan()
    {
        return $this->hasMany(UjianSiswaJawabanKecermatan::class, 'ujian_siswa_id','id')->where('benar', 1);
    }

    public function getJawabanKecerdasan()
    {
        return $this->hasMany(UjianSiswaJawabanKecerdasan::class, 'ujian_siswa_id','id');
    }


    public function getNilai()
    {
        return $this->belongsTo(UjianNilai::class, 'id', 'ujian_siswa_id');
    }

    public function getUjian()
    {
        return $this->belongsTo(Ujian::class, 'ujian_id', 'id');
    }
}
