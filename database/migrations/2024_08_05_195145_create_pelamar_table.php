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
        Schema::create('pelamar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lowongan_pekerjaan_id');
            $table->foreign('lowongan_pekerjaan_id')->references('id')->on('lowongan_pekerjaan')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('domisili');
            $table->integer('umur');
            $table->string('cv');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelamar');
    }
};
