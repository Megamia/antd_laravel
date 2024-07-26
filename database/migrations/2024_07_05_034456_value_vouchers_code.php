<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\VoucherCodeValue;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('VoucherCodeValue', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('value');
            $table->unsignedBigInteger('voucher_id');
            $table->foreign('voucher_id')->references('id')->on('Voucher');
            $table->timestamps();
        });
        $data = [
            [
                'code' => "GOKUNOPICOLO",
                'value' => '1.000',
                "voucher_id" => "1",
            ],
            [
                "code" => "CMT8-1945",
                'value' => '2.000',
                "voucher_id" => "1",
            ],
            [
                "code" => "NHAPBUADI",
                'value' => '3.000',
                "voucher_id" => "1",
            ],
            [
                "code" => "ABCDXYZ",
                "value" => "4.000",
                "voucher_id" => "1",
            ],
            [
                "code" => "BANTUMLUM",
                "value" => "5.000",
                "voucher_id" => "1",
            ],
        ];
        foreach ($data as $item) {
            $value_voucher_code = new VoucherCodeValue();
            $value_voucher_code->code = $item['code'];
            $value_voucher_code->value = $item['value'];
            $value_voucher_code->voucher_id = $item['voucher_id'];
            $value_voucher_code->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('VoucherCodeValue');
    }
};
