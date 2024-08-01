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
            $table->timestamps();
        });

        $data = [
            ['name' => 'Lọc sản phẩm'],
            ['name' => 'Thương hiệu'],
            ['name' => 'Danh mục'],
            ['name' => 'Tags'],
        ];

        foreach ($data as $item) {
            $tag_title = new TagTitle();
            $tag_title->name = $item['name'];
            $tag_title->save();
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('TagTitle');
    }
};
