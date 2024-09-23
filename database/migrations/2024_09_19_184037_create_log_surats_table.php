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
        Schema::create('log_surats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('surat_masuks_id')->nullable();
            $table->unsignedInteger('surat_keluars_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->string('created_by', 5);
            $table->string('updated_by', 5);
            $table->string('deleted_by', 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_surats');
    }
};
