<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\VoucherPromotionValue;
use App\Models\VoucherCodeValue;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

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
        $data = $request->only('idOrder', 'idVoucherPromotion');
        $idOrder = $data['idOrder'];
        $idVoucherPromotions = $data['idVoucherPromotion'] ?? [];

        $createVouchers = [];
        $failedVoucher = [];

        if (isset($data['idOrder']) && is_array($data['idOrder'])) {
            $idOrder = $data['idOrder'][0];
        }
        if (!$idOrder) {
            return response()->json([
                'status' => 0,
                'message' => 'ID đơn hàng không hợp lệ'
            ], 400);
        }

        if (empty($idVoucherPromotions)) {
            try {
                $createVoucher = Voucher::create([
                    'idOrder' => $idOrder,
                    'idVoucherPromotionValue' => null,
                ]);
                $createVouchers[] = $createVoucher;
            } catch (\Exception $e) {
                $failedVoucher[] = ['error' => $e->getMessage()];
            }
        } else {
            foreach ($idVoucherPromotions as $idVoucherPromotion) {
                try {
                    $createVoucher = Voucher::create([
                        'idOrder' => $idOrder,
                        'idVoucherPromotionValue' => $idVoucherPromotion,
                    ]);
                    $createVouchers[] = $createVoucher;
                } catch (\Exception $e) {
                    $failedVoucher[] = [
                        'idVoucherPromotion' => $idVoucherPromotion,
                        'error' => $e->getMessage()
                    ];
                }
            }
        }

        if (count($failedVoucher) > 0) {
            return response()->json([
                'status' => 0,
                'message' => 'Một số voucher không thể được tạo',
                'failedVoucher' => $failedVoucher
            ], 500);
        }

        return response()->json([
            'status' => 1,
            'createVoucher' => $createVouchers,
            'message' => 'Voucher đã được tạo thành công'
        ]);
    }
}
