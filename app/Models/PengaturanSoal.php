<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengaturanSoal extends Model
{
    use HasFactory;
    use Userstamps;

    protected $fillable = ['kategori','jumlah_soal','created_by','updated_by'];

    public function getKategori(){
        return $this->belongsTo(RefOption::class, 'kategori', 'id');
    }
}
