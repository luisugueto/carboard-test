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
         DB::table('users')->insert([
            'name' => 'Luis Ugueto',
            'email' => 'blink242@outlook.com',
            'password' => bcrypt('1234'),
        ]);
    }
}
