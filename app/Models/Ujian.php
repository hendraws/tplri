<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $fillable = [ 'judul', 'tanggal', 'token', 'is_active', 'created_by', 'updated_by',  'kategori_kecermatan'   ];
    protected $with = ['getSoalKecerdasan','getSoalKecermatan','getSoalKepribadianSatu','getSoalKepribadianDua'];

    public function getProgramAkademik()
    {
        return $this->belongsTo(ProgramAkademik::class, 'program_akademik_id', 'id');
    }

    public function getKelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function getMataPelajaran()
    {
        return $this->hasMany(UjianMataPelajaran::class, 'ujian_id', 'id');
    }

    public function getSoal()
    {
        return $this->hasManyThrough(UjianSoal::class, UjianMataPelajaran::class, 'ujian_id', 'ujian_mata_pelajaran_id', 'id', 'id');
    }

    public function getSoalKecerdasan()
    {
        return $this->belongsToMany(Kecerdasan::class, 'ujian_kecerdasans','ujian_id','kecerdasan_id');
    }

    public function getSoalKecermatan()
    {
        return $this->belongsToMany(Kecermatan::class, 'ujian_kecermatans','ujian_id','kecermatan_id');
    }

    public function getSoalKepribadianSatu() {
        return $this->belongsToMany(Kepribadian::class, 'ujian_kepribadians','ujian_id','kepribadian_id')->where('kepribadians.sesi', 1);
    }
    public function getSoalKepribadianDua() {
        return $this->belongsToMany(Kepribadian::class, 'ujian_kepribadians','ujian_id','kepribadian_id')->where('kepribadians.sesi', 2);
    }
}
