<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianKecermatan extends Model
{
    use HasFactory;

    protected $fillable = [ 'ujian_id', 'kecermatan_id', ];
}
