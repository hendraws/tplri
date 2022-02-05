<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepribadianPilihanJawaban extends Model
{
    use HasFactory;

    protected $fillable = [ 'sesi', 'pilihan', 'jawaban', 'kepribadian_id', 'bobot',];
}
