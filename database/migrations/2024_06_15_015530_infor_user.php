<?php

use App\Models\InforUser;
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
        Schema::create('InforUser', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')
                ->references('id')
                ->on('DetailInforUserOrder')
                ->onDelete('cascade');
            $table->unsignedBigInteger('idAddress');
            $table->foreign('idAddress')
                ->references('id')
                ->on('Address')
                ->onDelete('cascade');
        });
        $data = [
            [
                'idUser' => '1',
                'idAddress' => '1',
            ],
            [
                'idUser' => '1',
                'idAddress' => '2',
            ],
            [
                'idUser' => '2',
                'idAddress' => '3',
            ],
        ];
        foreach ($data as $item) {
            $InforUser = new InforUser();
            $InforUser->idUser = $item['idUser'];
            $InforUser->idAddress = $item['idAddress'];
            $InforUser->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('InforUser');
    }
};
