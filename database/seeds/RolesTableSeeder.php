<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();

        $admin = new Role();
        $admin->name = "admin";
        $admin->display_name = "ADMIN";
        $admin->save();

        $u1 = User::find(1);
        $u1->detachRole($admin);
        $u1->attachRole($admin);

    }
}
