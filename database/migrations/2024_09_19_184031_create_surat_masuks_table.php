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
            $table->date('tgl_surat');
            $table->string('nomor', 50);
            $table->string('perihal');
            $table->string('status', 100);
            $table->string('asal');
            $table->string('jenis_nosurat');
            $table->date('tgl_terima');
            $table->date('tgl_input')->default(date('Y-m-d'));
            $table->string('ttd')->nullable();
            $table->string('tujuan');
            $table->string('kepada');
            $table->string('jenis');
            $table->string('retensi');
            $table->string('retensi2');
            $table->string('retensi3');
            $table->string('riwayat_mutasi');
            $table->string('upload_file');
            $table->string('no_box')->nullable();
            $table->string('no_rak')->nullable();
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by')->nullable();
				$table->string('status_arsip')->nullable();
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
