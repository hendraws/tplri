<?php

namespace App\Imports;

use App\Models\Kecermatan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KecerdasanImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Kecermatan([
            'soal_a' => $row['a'],
            'soal_b' => $row['b'],
            'soal_c' => $row['c'],
            'soal_d' => $row['d'],
            'soal_e' => $row['e'],
        ]);
    }
}
