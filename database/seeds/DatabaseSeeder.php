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
            'name' => 'Admin',
        ]);
        DB::table('roles')->insert([
            'name' => 'User',
        ]);
        DB::table('users')->insert([
            'name' => 'Luis Ugueto',
            'email' => 'blink242@outlook.com',
            'password' => bcrypt('1234'),
            'rol_id' => '1',
        ]);
        
        DB::table('videos')->insert([
            'url' => 'https://youtu.be/kpFPcUTd3FQ',
            'title' => 'Prueba',
            'description' => 'prueba'
        ]);
        
    }
}
