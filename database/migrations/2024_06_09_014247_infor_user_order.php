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
            $table->string('email')->nullable()->default('example@gmail');
            $table->string('text')->nullable();
            $table->integer('number')->nullable();
            $table->timestamp('date')->useCurrent();
            $table->string('dropDown')->nullable();
            $table->string('checkBox')->nullable();
            $table->string('address')->nullable();
            $table->string('email2')->nullable()->default('example2@gmail');
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
