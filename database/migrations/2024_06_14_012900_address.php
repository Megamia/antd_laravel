<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Address;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Address', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('phoneNumber');
            $table->string('city');
            $table->string('district');
            $table->string('ward');
            $table->string('address');
            $table->unsignedBigInteger('idUser')->default(1);
            $table->foreign('idUser')
                ->references('id')
                ->on('DetailInforUserOrder')
                ->onDelete('cascade');
        });

        $data = [
            [
                'name' => 'Đỗ Phúc Lộc',
                'phoneNumber' => '0388911562',
                'city' => 'Hà Nội',
                'district' => 'Thanh Xuân',
                'ward' => 'Thanh Xuân Trung',
                'address' => '85 Vũ Trọng Phụng',
            ],
            [
                'name' => 'Trần Xuyến Chi',
                'phoneNumber' => '0889151562',
                'city' => 'Hà Nội',
                'district' => 'Thanh Xuân',
                'ward' => 'Thanh Xuân Trung',
                'address' => '85 Vũ Trọng Phụng',
            ],
            [
                'name' => 'Chi Phu',
                'phoneNumber' => '0911562884',
                'city' => 'Hà Nội',
                'district' => 'Thanh Xuân',
                'ward' => 'Thanh Xuân Trung',
                'address' => '85 Vũ Trọng Phụng',
                'idUser' => 2,
            ],
        ];
        foreach ($data as $item) {
            $address = new Address();
            $address->name = $item['name'];
            $address->phoneNumber = $item['phoneNumber'];
            $address->city = $item['city'];
            $address->district = $item['district'];
            $address->ward = $item['ward'];
            $address->address = $item['address'];
            if (isset($item['idUser'])) {
                $address->idUser = $item['idUser'];
            }
            $address->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Address');
    }
};
