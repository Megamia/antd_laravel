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
            $table->foreign('idDetailOrder')
                ->references('id')
                ->on('DetailOrder')
                ->onDelete('cascade');
            $table->unsignedBigInteger('idVoucher');
            $table->foreign('idVoucher')
                ->references('id')
                ->on('Voucher')
                ->onDelete('cascade');
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
