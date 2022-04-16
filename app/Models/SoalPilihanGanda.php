<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SoalPilihanGanda extends Model
{
    use HasFactory, SoftDeletes;

    // protected $connection = 'DbBankSoal';
    // protected $table = 'soal_pilihan';

    protected $fillable = [ 'soal_id','pilihan','jawaban','benar', ];

}
