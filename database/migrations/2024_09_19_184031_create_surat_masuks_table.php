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
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kd_klasifikasi_id');
            $table->date('tgl_surat');
            $table->string('nomor', 50);
            $table->string('perihal');
            $table->string('status', 100);
            $table->string('asal');
            $table->date('tgl_terima');
            $table->date('tgl_input')->default(date('Y-m-d'));
            $table->string('ttd');
            $table->string('tujuan');
            $table->string('kepada'); 
            $table->string('jenis'); 
            $table->string('retensi'); 
            $table->string('riwayat_mutasi'); 
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};
