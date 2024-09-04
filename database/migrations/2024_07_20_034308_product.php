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
            $table->timestamps();
        });
        $data = [
            ['name' => 'Giày'],
            ['name' => 'Mỹ phẩm'],
            ['name' => 'Hoa'],
            ['name' => 'Đồ điện tử'],
        ];
        foreach ($data as $product) {
            $products = new Product();
            if (isset($product['name'])) {
                $products->name = $product['name'];
            }
            if (isset($product['numberSelected'])) {
                $products->numberSelected = $product['numberSelected'];
            }
            $products->save();
        }
    }
    public function down(): void
    {
        Schema::dropIfExists('Product');
    }
};
