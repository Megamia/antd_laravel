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
            $table->unsignedBigInteger('idDetailProduct')->nullable();
            $table->foreign('idDetailProduct')
                ->references('id')
                ->on('DetailProduct')
                ->onDelete('cascade');
            $table->unsignedBigInteger('idDetailOrder');
            $table->foreign('idDetailOrder')
                ->references('id')
                ->on('DetailOrder')
                ->onDelete('cascade');
            $table->integer('numberSelected')->default(1);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('Product');
    }
};
