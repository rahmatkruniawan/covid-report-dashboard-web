<?php

use Illuminate\Database\Seeder;

class KategoriLaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori_laporan')->insert([
            [
                'nama' => 'Pasien',
            ],
            [
                'nama' => 'Pelanggaran Prokes',
            ],
        ]);
    }
}
