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
        if (!Schema::hasTable('suppliers')) {
            Schema::create('suppliers', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('nit')->unique();
                $table->string('name', 50);
                $table->string('city', 50);
                $table->string('address', 50);
                $table->bigInteger('phone');
                $table->string('email', 50)->unique();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('suppliers')) {
            Schema::dropIfExists('suppliers');
        }
    }
};
