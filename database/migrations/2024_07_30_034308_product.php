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
        Schema::create('Product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTagTitle');
            $table->foreign('idTagTitle')
                ->references('id')
                ->on('TagTitle');

            $table->unsignedBigInteger('idDetailProduct');
            $table->foreign('idDetailProduct')
                ->references('id')
                ->on('DetailProduct');
            $table->integer('numberSelected')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('Product');
    }
};
