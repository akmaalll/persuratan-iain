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
        Schema::create('user_menus', function (Blueprint $table) {
            $table->string('id', 40)->primary();
            $table->unsignedBigInteger('id_role');
            $table->foreign('id_role')->references('id')->on('roles');
            $table->unsignedBigInteger('id_menu');
            $table->foreign('id_menu')->references('id')->on('menus');
            $table->char('read', 1)->nullable();
            $table->char('create', 1)->nullable();
            $table->char('edit', 1)->nullable();
            $table->char('delete', 1)->nullable();
            $table->char('report', 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_menus');
    }
};
