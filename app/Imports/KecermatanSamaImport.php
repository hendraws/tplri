<?php

namespace App\Imports;

use App\Models\KecermatanSama;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KecermatanSamaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new KecermatanSama([
            'jawaban_a' => $row['a'],
            'jawaban_b' => $row['b'],
            'jawaban_c' => $row['c'],
            'jawaban_d' => $row['d'],
            'jawaban_e' => $row['e'],
            'kategori' => $row['kategori'],
        ]);
    }
}
