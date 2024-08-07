<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\DetailProduct;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('DetailProduct', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('quantity');
            $table->string('defaultPrice');
            $table->string('price');
            $table->string('img', 10000);
            $table->unsignedBigInteger('idTagTitle')->default(1);
            $table->foreign('idTagTitle')
                ->references('id')
                ->on('TagTitle');
        });

        $data = [
            [
                'name' => 'Tên của sản phẩm',
                'quantity' => '2',
                'defaultPrice' => '249.000',
                'price' => '249.000',
                'img' => 'http://127.0.0.1:8000/uploads/b01a8548b32136d8258ebb5131b4b5b4.jfif',
                'idTagTitle' => 2,
            ],
            [
                'name' => 'Tên của sản phẩm',
                'quantity' => '46',
                'defaultPrice' => '2.049.000',
                'price' => '2.049.000',
                'img' => 'http://127.0.0.1:8000/uploads/dd00e9636746a2996dfaf29abd7631b3.jfif'
            ],
            [
                'name' => 'Tên của sản phẩm',
                'quantity' => '0',
                'defaultPrice' => '1.249.000',
                'price' => '1.249.000',
                'img' => 'http://127.0.0.1:8000/uploads/a420b252cec7770c3d6e9d3dff2a3db4.jfif',
                'idTagTitle' => 2,
            ],
            [
                'name' => 'Tên của sản phẩm',
                'quantity' => '29',
                'defaultPrice' => '249.000',
                'price' => '249.000',
                'img' => 'http://127.0.0.1:8000/uploads/0b936eb81d043d5545d8b6c5a271f7d6.jfif',
                'idTagTitle' => 2,
            ],
            [
                'name' => 'Tên của sản phẩm',
                'quantity' => '161',
                'defaultPrice' => '249.000',
                'price' => '249.000',
                'img' => 'http://127.0.0.1:8000/uploads/4275c1c38fbd2f436e76c674485646e1.jfif'
            ],
            [
                'name' => 'Tên của sản phẩm',
                'quantity' => '2',
                'defaultPrice' => '249.000',
                'price' => '249.000',
                'img' => 'http://127.0.0.1:8000/uploads/680c37df0e9b8e211650a3298c009484.jfif'
            ],
        ];
        foreach ($data as $item) {
            $DetailProduct = new DetailProduct();
            $DetailProduct->name = $item['name'];
            $DetailProduct->quantity = $item['quantity'];
            $DetailProduct->defaultPrice = $item['defaultPrice'];
            $DetailProduct->price = $item['price'];
            $DetailProduct->img = $item['img'];
            if (isset($item['idTagTitle'])) {
                $DetailProduct->idTagTitle = $item['idTagTitle'];
            }
            $DetailProduct->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DetailProduct');
    }
};
