<?php

use App\Models\Product;
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
        Schema::create('Product', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('numberSelected')->default(1);
            $table->unsignedBigInteger('idDetailProduct')->nullable();
            $table->foreign('idDetailProduct')
                ->references('id')
                ->on('DetailProduct');
            $table->unsignedBigInteger('idDetailOrder')->nullable();
            $table->foreign('idDetailOrder')
                ->references('id')
                ->on('DetailOrder');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('Product');
    }
};
