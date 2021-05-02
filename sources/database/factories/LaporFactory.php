<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Lapor;
use Faker\Generator as Faker;

$factory->define(Lapor::class, function (Faker $faker) {
    static $number = 1;

    return [
        'kode_lapor' => "20210404".str_pad($number++,4,'0',STR_PAD_LEFT),
        'kategori_laporan_id' => $faker->numberBetween(1,2),
        'nama_pelapor' => $faker->name,
        'no_hp_pelapor' => $faker->e164PhoneNumber,
        'email_pelapor' => $faker->unique()->safeEmail,
        'nama_terlapor' => $faker->name,
        'no_hp_terlapor' => $faker->e164PhoneNumber,
        'deskripsi_laporan' => $faker->realText,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'alamat' => $faker->streetAddress,
        'kecamatan' => null,
        'kabupaten' => $faker->randomElement(['Sleman', 'Yogyakarta', 'Gunung Kidul', 'Bantul', 'Kulon Progo']),
        'provinsi' => 'Yogyakarta',
        'status' => $faker->randomElement(['menunggu', 'diproses', 'dibatalkan', 'selesai']),
        'created_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = '1 months', $timezone = null),
    ];
});
