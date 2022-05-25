<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            'ikdin reguler 1',
            'ikdin reguler 2',
            'ikdin reguler 3',
            'ikdin reguler 4',
            'ikdin reguler 5',
            'ikdin reguler 6',
            'ikdin reguler 7',
            'ikdin reguler 8',
            'ikdin reguler 9',
            'ikdin reguler 10',
            'ikdin reguler 11',
            'ikdin reguler 12',
            'ikdin reguler 13',
            'ikdin private 1',
            'ikdin private 2',
            'ikdin private 3',
            'ikdin private 4',
            'ikdin private 5',
            'ikdin private 6',
            'ikdin private 7',
            'ikdin private 8',
            'ikdin private 9',
            'ikdin private 10',
            'ikdin private 11',
            'ikdin private 12',
            'ikdin private 13',
            'ikdin private 14',
            'ikdin private 15',
            'ikdin private 16',
            'ikdin private 17',
            'ikdin weekend reguler 1',
            'ikdin intensif reguler 1',
            'ikdin intensif reguler 2',
            'ikdin intensif reguler 3',
            'ikdin intensif reguler 4',
            'ikdin intensif reguler 5',
            'ikdin intensif reguler 6',
            'ikdin intensif reguler 7',
            'ikdin intensif reguler 8',
            'ikdin intensif private 1',
            'ikdin intensif private 2',
            'ikdin intensif private 3',
            'ikdin intensif private 4',
            'ikdin intensif private 5',
            'ikdin intensif private 6',
            'ikdin intensif private 7',
            'ikdin intensif private 8',
            'ikdin intensif private 9',
        ];
        $program_akademik_id = 1;

        foreach($data as $key => $value){
            Kelas::updateOrCreate([
                'nama_kelas' => $value,
                'program_akademik_id' => $program_akademik_id,
            ],[]);
        }


    }
}
