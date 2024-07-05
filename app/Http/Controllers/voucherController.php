<?php

namespace App\Http\Controllers;

use App\Models\value_voucher_promotion;
use Illuminate\Http\Request;

class voucherController extends Controller
{
    //VoucherCode
    public function dataValueVoucherCode(Request $request)
    {
        $dataValueVoucherCode = value_voucher_promotion::all();
        if ($dataValueVoucherCode->count() > 0) {
            return response()->json(['status' => 1, 'dataValueVoucherCode' => $dataValueVoucherCode]);
        } else {
            return response()->json(['status' => 0, 'dataValueVoucherCode' => 'No dataValueVoucherCode']);
        }
    }
    public function chooseVoucherCode(Request $request)
    {
        $data = $request->only('code');
        $dataVouchers = value_voucher_promotion::whereIn('code', $data['code'])->get();

        if ($dataVouchers->isNotEmpty()) {
            return response()->json(['status' => 1, 'dataVouchers' => $dataVouchers]);
        } else {
            return response()->json(['status' => 0, 'dataVouchers' => 'no dataVouchers']);
        }
    }
    //VoucherCode

    //VoucherPromotion
    public function dataValueVoucherPromotion(Request $request)
    {
        $dataValueVoucherPromotion = value_voucher_promotion::all();
        if ($dataValueVoucherPromotion->count() > 0) {
            return response()->json(['status' => 1, 'dataValueVoucherPromotion' => $dataValueVoucherPromotion]);
        } else {
            return response()->json(['status' => 0, 'dataValueVoucherPromotion' => 'No dataValueVoucherPromotion']);
        }
    }

    public function chooseVoucherPromotion(Request $request)
    {
        $data = $request->only('id');
        $dataVouchersPromotion = value_voucher_promotion::whereIn('id', $data['id'])->get();

        if ($dataVouchersPromotion->isNotEmpty()) {
            return response()->json(['status' => 1, 'dataVouchersPromotion' => $dataVouchersPromotion]);
        } else {
            return response()->json(['status' => 0, 'dataVouchersPromotion' => 'no dataVouchersPromotion']);
        }
    }
    //VoucherPromotion



}
