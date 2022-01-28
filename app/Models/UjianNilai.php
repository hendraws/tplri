<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianNilai extends Model
{
    use HasFactory;

    protected $fillable = [ 'ujian_siswa_id', 'kecerdasan', 'kecermatan', 'kepribadian', 'nilai_akhir',     ];

}
