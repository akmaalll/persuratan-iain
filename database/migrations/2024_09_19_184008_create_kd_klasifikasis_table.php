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
        Schema::create('kd_klasifikasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('jenis_klasifikasi_id');
            $table->string('nomor', 10);
            $table->string('nama');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kd_klasifikasis');
    }
};
