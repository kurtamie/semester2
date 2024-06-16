<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->id('id_surat_izin');
            $table->unsignedBigInteger('id_user'); // Menggunakan tipe data unsignedBigInteger untuk foreign key

            // New Line
            $table->string('nim')->length(15);
            $table->string('nama');
            $table->string('nama_dosen_wali');
            $table->string('kelas_perkuliahan');
            $table->string('nama_dan_nomor_telepon_orang_tua_wali')->length(50);
            $table->string('tanggal_mulai_izin');
            $table->string('jenis_perizinan');
            $table->date('tanggal_akhir_izin');
            $table->enum('status', ['PROSES', 'SELESAI', 'TOLAK'])->default('PROSES');
            $table->string('foto1');
            $table->string('foto2');
            $table->string('foto3');
            // End New Line

            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users'); // Menambahkan foreign key constraint
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
