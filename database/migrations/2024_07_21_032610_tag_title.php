<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TagTitle;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('TagTitle', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('idTag')->default(1);
            $table->foreign('idTag')
                ->references('id')
                ->on('Tag');
            $table->unsignedBigInteger('idDetailProduct')->default(1);
            $table->foreign('idDetailProduct')
                ->references('id')
                ->on('DetailProduct');
            $table->timestamps();
        });

        $data = [
            ['name' => 'Lọc sản phẩm', 'idDetailProduct' => 1],
            ['name' => 'Thương hiệu', 'idDetailProduct' => 2],
            ['name' => 'Danh mục'],
            ['name' => 'Tags'],
        ];

        foreach ($data as $item) {
            $tag_title = new TagTitle();
            $tag_title->name = $item['name'];
            if (isset($item['idDetailProduct'])) {
                $tag_title->idDetailProduct = $item['idDetailProduct'];
            }
            $tag_title->save();
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('TagTitle');
    }
};
