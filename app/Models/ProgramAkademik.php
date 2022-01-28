<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramAkademik extends Model
{
    use HasFactory;

    protected $fillable = ['nama_program', 'created_by', 'updated_by',];

}
