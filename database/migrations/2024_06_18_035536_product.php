<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tag');
            $table->integer('quantity');
            $table->float('price');
            $table->string('img',10000);
        });


        $data = [
            [
                'name' => '123',
                'tag' => '123',
                'quantity' => '123',
                'price' => '123',
                'img' => 'http://127.0.0.1:8000/img/product/b01a8548b32136d8258ebb5131b4b5b4.jpg'
            ],
            [
                'name' => '456',
                'tag' => '456',
                'quantity' => '456',
                'price' => '456',
                'img' => '456'
            ],
            [
                'name' => '789',
                'tag' => '789',
                'quantity' => '789',
                'price' => '789',
                'img' => '789'
            ],
        ];
        foreach ($data as $item) {
            $address = new Product();
            $address->name = $item['name'];
            $address->tag = $item['tag'];
            $address->quantity = $item['quantity'];
            $address->price = $item['price'];
            $address->img = $item['img'];
            $address->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
