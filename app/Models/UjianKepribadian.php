<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianKepribadian extends Model
{
    use HasFactory;
    protected $fillable = [ 'ujian_id', 'kepribadian_id','sesi'];
}
