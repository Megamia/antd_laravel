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
        Schema::create('InforUser', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')
                ->references('id')
                ->on('DetailInforUserOrder')
                ->onDelete('cascade');
            $table->unsignedBigInteger('idAddress');
            $table->foreign('idAddress')
                ->references('id')
                ->on('Address')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('InforUser');
    }
};
