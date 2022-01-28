<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'name' => [
                'permission-list',
                'permission-create',
                'permission-edit',
                'permission-delete',
            ]
        ];

        $now = date('Y-m-d H:i:s');
        $permission = [];
        $text = $permissions['name'];
        for($i= 0; $i < count($permissions['name']); $i++){
            $name = $text[$i];
            $permission = [
                'name' => $name,
                'guard_name' => 'web',
                'created_at' => $now
            ];

            $result = Permission::updateOrCreate(['name'=>$permission['name']], $permission);
            dump($result->name);
        }
    }
}
