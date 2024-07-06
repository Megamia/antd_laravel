<?php

namespace App\Http\Controllers;

use App\Models\value_voucher_promotion;
use App\Models\value_voucher_code;
use Illuminate\Http\Request;

class voucherController extends Controller
{
    //VoucherCode
    public function dataValueVoucherCode(Request $request)
    {
        $dataValueVoucherCode = value_voucher_code::all();
        if ($dataValueVoucherCode->isNotEmpty()) {
            return response()->json(['status' => 1, 'dataValueVoucherCode' => $dataValueVoucherCode]);
        } else {
            return response()->json(['status' => 0, 'dataValueVoucherCode' => 'No dataValueVoucherCode']);
        }
    }
    public function chooseVoucherCode(Request $request)
    {
        $data = $request->only('code');
        $chooseVoucherCode = value_voucher_code::where('code', $data['code'])->get();

        if ($chooseVoucherCode->isNotEmpty()) {
            return response()->json(['status' => 1, 'chooseVoucherCode' => $chooseVoucherCode]);
        } else {
            return response()->json(['status' => 0, 'chooseVoucherCode' => 'no chooseVoucherCode']);
        }
    }
    //VoucherCode

    //VoucherPromotion
    public function dataValueVoucherPromotion(Request $request)
    {
        $dataValueVoucherPromotion = value_voucher_promotion::all();
        if ($dataValueVoucherPromotion->isNotEmpty()) {
            return response()->json(['status' => 1, 'dataValueVoucherPromotion' => $dataValueVoucherPromotion]);
        } else {
            return response()->json(['status' => 0, 'dataValueVoucherPromotion' => 'No dataValueVoucherPromotion']);
        }
    }

    public function chooseVoucherPromotion(Request $request)
    {
        $data = $request->only('id');
        $chooseVoucherPromotion = value_voucher_promotion::whereIn('id', $data['id'])->get();

        if ($chooseVoucherPromotion->isNotEmpty()) {
            return response()->json(['status' => 1, 'chooseVoucherPromotion' => $chooseVoucherPromotion]);
        } else {
            return response()->json(['status' => 0, 'chooseVoucherPromotion' => 'no chooseVoucherPromotion']);
        }
    }
    //VoucherPromotion



}
