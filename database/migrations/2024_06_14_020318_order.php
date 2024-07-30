<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idDetailOrder');
            $table->unsignedBigInteger('idVoucher');
            $table->unsignedBigInteger('idAddress');
            $table->foreign('idAddress')
                ->references('id')
                ->on('Address')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Order');
    }
};
