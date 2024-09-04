<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Tag;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Tag', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('idProduct')->nullable();
            $table->foreign('idProduct')
                ->references('id')
                ->on('Product');
            $table->unsignedBigInteger('idDetailTag')->nullable();
            $table->foreign('idDetailTag')
                ->references('id')
                ->on('DetailTag');
            $table->timestamps();
        });

        $data = [
            ['name' => 'Lọc sản phẩm'],
            ['name' => 'Thương hiệu'],
            ['name' => 'Danh mục'],
            ['name' => 'Tags'],
        ];

        foreach ($data as $item) {
            $tag = new Tag();
            $tag->name = $item['name'];
            if (isset($item['idProduct'])) {
                $tag->idProduct = $item['idProduct'];
            }
            $tag->save();
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('Tag');
    }
};
