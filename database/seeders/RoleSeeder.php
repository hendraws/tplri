<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = ['super-admin', 'administrator', 'siswa'];
        foreach ($roles as $role) {
            $input['name'] = $role;
            Role::updateOrCreate(['name' => $input['name']], $input);
        }

    }
}
