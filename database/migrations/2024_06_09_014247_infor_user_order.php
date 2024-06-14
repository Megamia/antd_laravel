<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\InforUserOrder;

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

        // Tạo bản ghi mặc định
        $inforUserOrder = new InforUserOrder();
        $inforUserOrder->name = 'John Doe';
        $inforUserOrder->phoneNumber = 1234567890;
        $inforUserOrder->email = 'example@gmail.com';
        $inforUserOrder->text = 'Default text';
        $inforUserOrder->number = 100;
        $inforUserOrder->dropDown = 'Default dropdown';
        $inforUserOrder->checkBox = 'Default checkbox';
        $inforUserOrder->address = '123 Main St, Anytown USA';
        $inforUserOrder->email2 = 'example2@gmail.com';
        $inforUserOrder->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inforUserOrder');
    }
};
