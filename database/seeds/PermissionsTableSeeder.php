<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();

        $all = new Permission();
        $all->name = "all";
        $all->save();

        $admin = Role::find(1);

        $admin->detachPermissions([$all]);
        $admin->attachPermissions([$all]);

    }
}
