<?php

use App\Models\DetailTag;
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
        Schema::create('DetailTag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTag')->default(1);
            $table->foreign('idTag')
                ->references('id')
                ->on('Tag');
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
                'itemChil' => false,
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
            $detailTag = new DetailTag();
            $detailTag->name = $item['name'];
            if (isset($item['idTag'])) {
                $detailTag->idTag = $item['idTag'];
            }
            $detailTag->parent_id = $item['parent_id'];
            $detailTag->id_item = $item['id_item'];
            $detailTag->itemChil = $item['itemChil'];
            $detailTag->save();
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('DetailTag');
    }
};
