<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\value_voucher;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('value_voucher', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->float('value');
            $table->unsignedBigInteger('voucher_id');
            $table->foreign('voucher_id')->references('id')->on('vouchers');
            $table->timestamps();
        });
        $data = [
            [
                'text' => "Chiến dịch Trung thu đầy trăng",
                'value' => '100.000',
                "voucher_id" => "3",
            ],
            [
                "text" => "Sale 11/11 Black Friday",
                'value' => '200.000',
                "voucher_id" => "3",
            ],
            [
                "text" => "Giảm 40k cho đơn trên 1.000.000đ",
                'value' => '300.000',
                "voucher_id" => "3",
            ],
            [
                "text" => "Tết sum vầy",
                "value" => "400.000",
                "voucher_id" => "3",
            ],
            [
                "text" => "Đồng giá combo",
                "value" => "500.000",
                "voucher_id" => "3",
            ],
        ];
        foreach ($data as $item) {
            $value_voucher = new value_voucher();
            $value_voucher->text = $item['text'];
            $value_voucher->value = $item['value'];
            $value_voucher->voucher_id = $item['voucher_id'];
            $value_voucher->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('value_vouchers');
    }
};
