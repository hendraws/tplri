<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecermatan extends Model
{
    use HasFactory;

    protected $fillable = [ 'soal_a', 'soal_b', 'soal_c', 'soal_d', 'soal_e', 'created_by', 'edited_by','kategori' ];
}
