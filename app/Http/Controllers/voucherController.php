<?php

namespace App\Http\Controllers;

use App\Models\value_voucher;
use Illuminate\Http\Request;

class voucherController extends Controller
{
    public function dataValueVoucher(Request $request)
    {
        $dataValueVoucher = value_voucher::all();
        if ($dataValueVoucher->count() > 0) {
            return response()->json(['status' => 1, 'dataValueVoucher' => $dataValueVoucher]);
        } else {
            return response()->json(['status' => 0, 'dataValueVoucher' => 'No dataValueVoucher']);
        }
    }
    public function chooseVoucher(Request $request)
    {
        $data = $request->only('id');
        $dataVouchers = value_voucher::whereIn('id', $data['id'])->get();

        if ($dataVouchers->isNotEmpty()) {
            return response()->json(['status' => 1, 'dataVouchers' => $dataVouchers]);
        } else {
            return response()->json(['status' => 0, 'dataVouchers' => 'no dataVouchers']);
        }
    }
}
