<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Voucher;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Voucher', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        $data = [
            [
                'name' => 'code',
            ],
            [
                'name' => 'discount',
            ],
            [
                'name' => 'promotion',
            ],
        ];
        foreach ($data as $item) {
            $voucher = new Voucher();
            $voucher->name = $item['name'];
            $voucher->save();
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('Voucher');
    }
};
