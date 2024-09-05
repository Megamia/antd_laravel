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
            $table->unsignedBigInteger('idOrder');
            $table->foreign('idOrder')
                ->references('id')
                ->on('Order')
                ->onDelete('cascade');
            $table->dateTime('timeCreateOrder', precision: 0)->default(now());
            $table->string('sale')->default(0)->nullable();
            $table->string('price')->default(0);
            $table->timestamps();
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
