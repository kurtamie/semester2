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
        Schema::create('surat_surveys', function (Blueprint $table) {
            $table->id('id_surat_survey');
            $table->unsignedBigInteger('id_user');
            $table->string('nim')->length(15);
            $table->string('nama');
            $table->string('alamat_tujuan');
            $table->string('alamat_instansi');
            $table->string('keperluan_mahasiswa');
            $table->string('tugas_yang_dikerjakan');
            $table->string('pdf_file')->nullable();
            $table->enum('status', ['PROSES', 'TERIMA', 'TOLAK'])->default('PROSES');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_surveys');
    }
};