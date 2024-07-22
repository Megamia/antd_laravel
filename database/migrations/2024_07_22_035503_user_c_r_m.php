<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\userCRM;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('userCRM', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phoneNumber');
            $table->string('email')->nullable();
        });
        $data = [
            [
                'name' => 'Trần Nguyễn Hạnh Nhân',
                'phoneNumber' => '0388911145',
                'email' => null,
            ],
            [
                'name' => 'Trần Hạnh Nhân',
                'phoneNumber' => '0388911145',
                'email' => null,
            ],
            [
                'name' => 'Hạnh Nhân',
                'phoneNumber' => '0388911145',
                'email' => null,
            ],
        ];
        foreach ($data as $item) {
            $userCRM = new userCRM();
            $userCRM->name = $item['name'];
            $userCRM->phoneNumber = $item['phoneNumber'];
            $userCRM->email = $item['email'];
            $userCRM->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
