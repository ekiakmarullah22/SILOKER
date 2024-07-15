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
        Schema::create('lowongan_pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemberi_kerja_id');
            $table->unsignedBigInteger('lokasi_id');
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('pemberi_kerja_id')->references('id')->on('pemberi_kerja')->onDelete('cascade');
            $table->foreign('lokasi_id')->references('id')->on('lokasi')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
            $table->string('nama', 150);
            $table->string('slug');
            $table->string('batas_lamaran', 20);
            $table->text('deskripsi');
            $table->string('gambar');
            $table->string('besaran_gaji');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_pekerjaan');
    }
};
