<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PortalSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(KategoriLaporanSeeder::class);
        $this->call(LaporSeeder::class);
    }
}
