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
        Schema::create('DetailOrder', function (Blueprint $table) {
            $table->id();
            $table->integer('idProduct');
            $table->dateTime('timeCreateOrder');
            $table->integer('numberSelected')->default(0);
            $table->string('sale');
            $table->string('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DetailOrder');
    }
};
