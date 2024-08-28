<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Voucher;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Voucher', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idOrder')->nullable();
            $table->foreign('idOrder')
                ->references('id')
                ->on('Order')
                ->onDelete('cascade');
            $table->unsignedBigInteger('idVoucherPromotionValue')->nullable();
            $table->foreign('idVoucherPromotionValue')
                ->references('id')
                ->on('VoucherPromotionValue')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Voucher');
    }
};
