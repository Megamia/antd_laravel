<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\tag_title;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tag_title', function (Blueprint $table) {
            $table->id();
            $table->string('title_name');
            $table->timestamps();
        });

        $data = [
            ['title_name' => 'Lọc sản phẩm'],
            ['title_name' => 'Thương hiệu'],
            ['title_name' => 'Danh mục'],
            ['title_name' => 'Tags'],
        ];

        foreach ($data as $item) {
            $tag_title = new tag_title();
            $tag_title->title_name = $item['title_name'];
            $tag_title->save();
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tag_title');
    }
};
