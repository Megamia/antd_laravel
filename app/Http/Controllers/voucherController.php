<?php

namespace App\Http\Controllers;

use App\Models\value_voucher_promotion;
use Illuminate\Http\Request;

class voucherController extends Controller
{
    public function dataValueVoucherPromotion(Request $request)
    {
        $dataValueVoucherPromotion = value_voucher_promotion::all();
        if ($dataValueVoucherPromotion->count() > 0) {
            return response()->json(['status' => 1, 'dataValueVoucherPromotion' => $dataValueVoucherPromotion]);
        } else {
            return response()->json(['status' => 0, 'dataValueVoucherPromotion' => 'No dataValueVoucherPromotion']);
        }
    }
    public function chooseVoucher(Request $request)
    {
        $data = $request->only('id');
        $dataVouchers = value_voucher_promotion::whereIn('id', $data['id'])->get();

        if ($dataVouchers->isNotEmpty()) {
            return response()->json(['status' => 1, 'dataVouchers' => $dataVouchers]);
        } else {
            return response()->json(['status' => 0, 'dataVouchers' => 'no dataVouchers']);
        }
    }
}
