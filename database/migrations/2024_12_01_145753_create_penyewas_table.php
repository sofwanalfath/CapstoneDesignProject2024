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
        Schema::create('penyewas', function (Blueprint $table) {
            $table->id();
            $table->string('jenisSewaKamar');
            $table->string('noKamar')->unique();
            $table->string('noHP');
            $table->string('nama');
            $table->string('kontakDarurat');
            $table->string('jenisKelamin');
            $table->date('tanggalMasuk');
            $table->date('tanggalKeluar');
            $table->integer('lamaSewa');
            $table->integer('hargaSewa');
            $table->integer('totalSewa');
            $table->string('keterangan')->nullable();
            $table->enum('status', ['Belum Lunas', 'Lunas'])->default('Belum Lunas');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewas');
    }
};
