<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidRequirements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createTableLapor();
        $this->createTableRiwayatLapor();
        $this->createTableKategoriLaporan();
        $this->createTableFileLapor();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_lapor');
        Schema::dropIfExists('kategori_laporan');
        Schema::dropIfExists('riwayat_lapor');
        Schema::dropIfExists('lapor');
    }

    private function createTableLapor()
    {
        Schema::create('lapor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pelapor')->nullable();
            $table->string('no_hp_pelapor')->nullable();
            $table->string('email_pelapor')->nullable();
            $table->string('nama_terlapor')->nullable();
            $table->string('no_hp_terlapor')->nullable();
            $table->text('deskripsi_laporan')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->enum('status', ['menunggu', 'diproses', 'dibatalkan', 'selesai'])->nullable();
            $table->timestamps();
        });
    }

    private function createTableRiwayatLapor()
    {
        Schema::create('riwayat_lapor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lapor_id');
            $table->integer('user_id');
            $table->enum('status', ['diproses', 'dibatalkan', 'selesai'])->nullable();
            $table->timestamps();
        });
    }

    private function createTableKategoriLaporan()
    {
        Schema::create('kategori_laporan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->timestamps();
        });
    }

    private function createTableFileLapor()
    {
        Schema::create('file_lapor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lapor_id');
            $table->timestamps();
        });
    }
}
