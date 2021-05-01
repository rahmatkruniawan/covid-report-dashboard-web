<?php

use Illuminate\Database\Seeder;
use App\Models\Lapor;

class LaporSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Lapor::class,500)->create();
    }
}
