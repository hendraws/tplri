<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianKecerdasan extends Model
{
    use HasFactory;

    protected $fillable = [ 'ujian_id', 'kecerdasan_id', ];
}
