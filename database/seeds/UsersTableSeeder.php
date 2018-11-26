<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset the table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();

//        $faker = Factory::create();

        App\User::create([
            'name' => 'ADMIN admin',
            'slug' => str_slug('ADMIN-admin'),
            'username' => 'adminBoss',
            'password' => bcrypt('123456')
        ]);
//        App\User::create([
//            'name' => 'TAZ the boss',
//            'slug' => str_slug('TAZ the boss'),
//            'email' => 't@g.com',
//            'password' => bcrypt('123456')
//        ]);
//        App\User::create([
//            'name' => 'Edwin kailu',
//            'slug' => str_slug('Edwin k'),
//            'email' => 'e@g.com',
//            'password' => bcrypt('123456')
//        ]);
    }
}
