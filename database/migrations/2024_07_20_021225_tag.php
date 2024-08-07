<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use  App\Models\Tag;

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
            $table->integer('parent_id')->nullable();
            
            $table->integer('id_item')->nullable();
           
            $table->boolean('itemChil');
            $table->timestamps();
        });

        $data = [
            [
                'name' => 'TagC1',
                'parent_id' => null,
                'id_item' => 1,
                'itemChil' => false
            ],
            [
                'name' => 'Tag1C2-A',
                'parent_id' => 1,
                'id_item' => 1,
                'itemChil' => true
            ],
            [
                'name' => 'Tag2C2-B',
                'parent_id' => 1,
                'id_item' => 2,
                'itemChil' => true
            ],
            [
                'name' => 'Tag3C2-C',
                'parent_id' => 1,
                'id_item' => 3,
                'itemChil' => true
            ],
            [
                'name' => 'Tag1C3-A',
                'parent_id' => 2,
                'id_item' => 1,
                'itemChil' => false
            ],
            [
                'name' => 'Tag1C3-B',
                'parent_id' => 2,
                'id_item' => 1,
                'itemChil' => true
            ],
            [
                'name' => 'Tag1C3-C',
                'parent_id' => 2,
                'id_item' => 1,
                'itemChil' => true
            ],
            [
                'name' => 'Tag2C3-A',
                'parent_id' => 2,
                'id_item' => 2,
                'itemChil' => false
            ],
            [
                'name' => 'Tag2C3-B',
                'parent_id' => 2,
                'id_item' => 2,
                'itemChil' => false
            ],
            [
                'name' => 'Tag2C3-C',
                'parent_id' => 2,
                'id_item' => 2,
                'itemChil' => false
            ],
            [
                'name' => 'Tag3C3-A',
                'parent_id' => 2,
                'id_item' => 3,
                'itemChil' => false
            ],
            [
                'name' => 'Tag3C3-B',
                'parent_id' => 2,
                'id_item' => 3,
                'itemChil' => false
            ],
            [
                'name' => 'Tag3C3-C',
                'parent_id' => 2,
                'id_item' => 3,
                'itemChil' => false
            ],
            [
                'name' => 'Tag1C4-B-1',
                'parent_id' => 3,
                'id_item' => 1,
                'itemChil' => false
            ],
            [
                'name' => 'Tag1C4-B-2',
                'parent_id' => 3,
                'id_item' => 1,
                'itemChil' => false
            ],
            [
                'name' => 'Tag1C4-C-1',
                'parent_id' => 3,
                'id_item' => 1,
                'itemChil' => false
            ],
            [
                'name' => 'Tag1C4-C-2',
                'parent_id' => 3,
                'id_item' => 1,
                'itemChil' => false
            ],
        ];
        foreach ($data as $item) {
            $tag = new Tag();
            $tag->name = $item['name'];
            $tag->parent_id = $item['parent_id'];
            $tag->id_item = $item['id_item'];
            $tag->itemChil = $item['itemChil'];
            $tag->save();
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('Tag');
    }
};
