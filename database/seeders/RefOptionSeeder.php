<?php

namespace Database\Seeders;

use App\Models\RefOption;
use Illuminate\Database\Seeder;

class RefOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            ['key'=>'matematika','option' => 'Matematika', 'modul'=> 'kategori-kecermatan'],
            ['key'=>'silogisme','option' => 'Silogisme', 'modul'=> 'kategori-kecermatan'],
            ['key'=>'verbal','option' => 'Verbal', 'modul'=> 'kategori-kecermatan'],
            ['key'=>'spasial','option' => 'Spasial', 'modul'=> 'kategori-kecermatan'],
            ['key'=>'satuan','option' => 'Satuan', 'modul'=> 'kategori-kecermatan'],
            ['key'=>'mtk-kotak','option' => 'MTK Kotak', 'modul'=> 'kategori-kecermatan'],
            ['key'=>'bind','option' => 'Bahasa Indonesia', 'modul'=> 'mapel_akademik'],
            ['key'=>'bing','option' => 'Bahasa Inggris', 'modul'=> 'mapel_akademik'],
            ['key'=>'mtk','option' => 'Matematika', 'modul'=> 'mapel_akademik'],
            ['key'=>'pu','option' => 'Pengetahuan Umum', 'modul'=> 'mapel_akademik'],
            ['key'=>'wk','option' => 'Wawasan Kebangsaan', 'modul'=> 'mapel_akademik'],
        ];

        foreach($options as $op){
            RefOption::updateOrCreate(['modul'=>$op['modul'], 'key'=>$op['key']],$op);
        }
    }
}
