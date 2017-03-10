<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => '1',
            'name' => 'Admin',
        ]);
        DB::table('roles')->insert([
            'id' => '2',
            'name' => 'User',
        ]);
        DB::table('users')->insert([
            'name' => 'Luis Ugueto',
            'email' => 'blink242@outlook.com',
            'password' => bcrypt('1234'),
            'rol_id' => '1',
        ]);
    }
}
