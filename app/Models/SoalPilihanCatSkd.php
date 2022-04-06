<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SoalPilihanCatSkd extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'soal_id','pilihan','jawaban','benar', ];

}
