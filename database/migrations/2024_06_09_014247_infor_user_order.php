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
        Schema::create('inforUserOrder', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('phoneNumber');
            $table->string('email')->unique();
            $table->string('text');
            $table->integer('number');
            $table->date('date');
            $table->string('dropDown');
            $table->string('checkBox');
            $table->string('address');
            $table->string('email2')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inforUserOrder');
    }
};
