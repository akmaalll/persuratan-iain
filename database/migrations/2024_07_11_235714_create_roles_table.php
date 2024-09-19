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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3)->unique();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_role')->after('password');
            $table->foreign('id_role')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_role']);
        });

        Schema::dropIfExists('roles');
    }
};
