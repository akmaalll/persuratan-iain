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
        Schema::create('no_surats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kd_klasifikasi_id');
            $table->date('tgl_surat');
            $table->string('nomor');
            $table->string('status');
            $table->string('perihal');
            $table->string('asal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('no_surats');
    }
};
