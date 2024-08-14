<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\VoucherPromotionValue;
use App\Models\VoucherCodeValue;
use Illuminate\Http\Request;

class voucherController extends Controller
{
    //VoucherCode
    public function dataValueVoucherCode(Request $request)
    {
        $dataValueVoucherCode = VoucherCodeValue::all();
        if ($dataValueVoucherCode->isNotEmpty()) {
            return response()->json(['status' => 1, 'dataValueVoucherCode' => $dataValueVoucherCode]);
        } else {
            return response()->json(['status' => 0, 'dataValueVoucherCode' => 'No dataValueVoucherCode']);
        }
    }
    public function chooseVoucherCode(Request $request)
    {
        $data = $request->only('code');
        $chooseVoucherCode = VoucherCodeValue::where('code', $data['code'])->get();

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
        $dataValueVoucherPromotion = VoucherPromotionValue::all();
        if ($dataValueVoucherPromotion->isNotEmpty()) {
            return response()->json(['status' => 1, 'dataValueVoucherPromotion' => $dataValueVoucherPromotion]);
        } else {
            return response()->json(['status' => 0, 'dataValueVoucherPromotion' => 'No dataValueVoucherPromotion']);
        }
    }

    public function chooseVoucherPromotion(Request $request)
    {
        $data = $request->only('id');
        $chooseVoucherPromotion = VoucherPromotionValue::whereIn('id', $data['id'])->get();

        if ($chooseVoucherPromotion->isNotEmpty()) {
            return response()->json(['status' => 1, 'chooseVoucherPromotion' => $chooseVoucherPromotion]);
        } else {
            return response()->json(['status' => 0, 'chooseVoucherPromotion' => 'no chooseVoucherPromotion']);
        }
    }
    //VoucherPromotion

    public function createVoucher(Request $request)
    {
        $data = $request->only('idVoucherCode', 'idVoucherPromotion');
        $idVoucherCode = $data['idVoucherCode'];
        $idVoucherPromotions = $data['idVoucherPromotion'];

        if (!is_array($idVoucherPromotions)) {
            return response()->json(['status' => 0, 'message' => 'idVoucherPromotion phải là một mảng']);
        }

        $exsitVoucher = Voucher::where('idVoucherCodeValue', $idVoucherCode)
            ->whereIn('idVoucherPromotionValue', $idVoucherPromotions)
            ->get();

        if ($exsitVoucher) {
            return response()->json(['status' => 1, 'createVoucher' => $exsitVoucher, 'message' => 'Đã tồn tại']);
        } else {
            $createVouchers = [];
            foreach ($idVoucherPromotions as $idVoucherPromotion) {
                $createVoucher = Voucher::create([
                    'idVoucherCodeValue' => $idVoucherCode,
                    'idVoucherPromotionValue' => $idVoucherPromotion,
                ]);
                $createVouchers[] = $createVoucher;
            }
            return response()->json(['status' => 1, 'createVoucher' => $createVouchers]);
        }
    }
}
