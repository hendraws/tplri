<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['program_akademik_id', 'nama_kelas', 'created_by', 'updated_by' ];

    public function getProgramAkademik()
    {
        return $this->belongsTo(ProgramAkademik::class, 'program_akademik_id', 'id');
    }
}
