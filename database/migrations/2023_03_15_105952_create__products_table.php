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
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->string('brand', 50);
                $table->decimal('price');
                $table->integer('account_id')->unsigned();
                $table->timestamps();

                $table->foreign('account_id')->references('id')->on('accounts');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('products')) {
            Schema::dropIfExists('products');
        }
    }
};
