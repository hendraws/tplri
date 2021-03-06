<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KecerdasanPilihanJawaban extends Model
{
    use HasFactory;

    protected $fillable = ['kecerdasan_id', 'pilihan', 'jawaban', 'benar'];
}
