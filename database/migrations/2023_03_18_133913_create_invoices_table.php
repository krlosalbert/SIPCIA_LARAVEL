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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('number', 50);
            $table->string('number_entries', 50);
            $table->decimal('total');
            $table->integer('supplier_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->timestamps();


            //$table->foreign('supplier_id')->references('id')->on('supliers');
            //$table->foreign('account_id')->references('id')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
