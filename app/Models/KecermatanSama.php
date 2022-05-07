<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class KecermatanSama extends Model
{
    use HasFactory, Userstamps, SoftDeletes;

    protected $fillable = ['jawaban_a', 'jawaban_b', 'jawaban_c', 'jawaban_d', 'jawaban_e', 'kategori', 'created_by', 'updated_by', 'deleted_by',];
}
