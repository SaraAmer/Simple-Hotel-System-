<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin= Role::create(['name' => 'admin']);

        $manager= Role::create(['name' => 'manager']);
        $receptionist= Role::create(['name' => 'receptionist']);
        $client= Role::create(['name' => 'client']);

      $clientCrud= Permission::create(['name' => 'client CRUD']);
      $accessManagerNames= Permission::create(['name' => 'access manager names']);


       $admin->givePermissionTo($clientCrud);
       $admin->givePermissionTo($accessManagerNames);

       


    }
}
