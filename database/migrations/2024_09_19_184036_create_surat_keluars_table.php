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
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kd_klasifikasi_id');
            $table->date('tgl_surat');
            $table->string('nomor');
            $table->string('perihal');
            $table->string('status');
            $table->string('asal');
            $table->date('tgl_kirim');
            $table->date('tgl_input')->default(date('Y-m-d'));
            $table->string('ttd')->nullable();
            $table->string('tujuan');
            $table->string('kepada');
            $table->string('jenis');
            $table->string('retensi');
            $table->string('retensi2');
            $table->string('retensi3');
            $table->string('file');
            $table->unsignedInteger('created_by'); 
            $table->unsignedInteger('updated_by')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluars');
    }
};
