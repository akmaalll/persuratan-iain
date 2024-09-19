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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('main_menu', 150);
            $table->enum('sub_parent', ['1', '0'])->default('1');
            $table->integer('parent');
            $table->string('name', 150);
            $table->string('icon', 50)->nullable();
            $table->string('url')->nullable();
            $table->integer('index')->default(100);
            $table->tinyInteger('sort')->default(1);
            $table->enum('active', ['1', '0'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
