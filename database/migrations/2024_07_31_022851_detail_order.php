<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->dateTime('timeCreateOrder')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('sale')->default(0);
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
