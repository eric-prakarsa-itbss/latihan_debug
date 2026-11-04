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
        Schema::create('mahasiswas', function (Blueprint $table){
            $table->uuid('id');
            $table->string('NIM')->unique();
            $table->string('name');
            $table->enum('jurusan', ['Bisnis Digital', 'Sistem dan Teknologi Informasi', 'Kewirausahaan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('table_mahasiswa');
    }
};
