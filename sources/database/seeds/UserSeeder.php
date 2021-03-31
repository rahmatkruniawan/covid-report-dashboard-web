<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'name' => 'Mimin Surimin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'role' => 'Developer',
            ],
            [
                'name' => 'Bambang Suparmo',
                'email' => 'satgas@gmail.com',
                'password' => bcrypt('satgas'),
                'role' => 'Satgas Covid-19',
            ],
            [
                'name' => 'Slamet Sentosa',
                'email' => 'relawan@gmail.com',
                'password' => bcrypt('relawan'),
                'role' => 'Relawan',
            ],
        ]);
    }
}
