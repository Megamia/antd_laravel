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
        $data = $request->only('idVoucherCode', 'idVoucherPromotion');
        $idVoucherCode = $data['idVoucherCode'] ?? null;
        $idVoucherPromotions = $data['idVoucherPromotion'] ?? [];

        $query = Voucher::query();

        if (!is_null($idVoucherCode)) {
            if ($idVoucherCode === 0) {
                $query->whereNull('idVoucherCodeValue');
            } else {
                $query->where('idVoucherCodeValue', $idVoucherCode);
            }
        } else {
            $query->whereNull('idVoucherCodeValue');
        }

        if (!empty($idVoucherPromotions)) {
            $query->whereIn('idVoucherPromotionValue', $idVoucherPromotions);
        } else {
            $query->whereNull('idVoucherPromotionValue');
        }

        $existingVouchers = $query->get();

        if ($existingVouchers->isNotEmpty()) {
            return response()->json([
                'status' => 1,
                'message' => 'Voucher(s) already exists',
                'existingVouchers' => $existingVouchers
            ]);
        }

        $createVouchers = [];
        $failedOrders = [];

        if (($idVoucherCode === 0 || is_null($idVoucherCode)) && empty($idVoucherPromotions)) {
            try {
                $createVoucher = Voucher::create([
                    'idVoucherCodeValue' => null,
                    'idVoucherPromotionValue' => null,
                ]);
                $createVouchers[] = $createVoucher;
            } catch (\Exception $e) {
                $failedOrders[] = ['error' => $e->getMessage()];
            }
        }

        if ((is_null($idVoucherCode) || $idVoucherCode === 0) && !empty($idVoucherPromotions)) {
            foreach ($idVoucherPromotions as $idVoucherPromotion) {
                try {
                    $createVoucher = Voucher::create([
                        'idVoucherCodeValue' => null,
                        'idVoucherPromotionValue' => $idVoucherPromotion,
                    ]);
                    $createVouchers[] = $createVoucher;
                } catch (\Exception $e) {
                    $failedOrders[] = [
                        'idVoucherPromotion' => $idVoucherPromotion,
                        'error' => $e->getMessage()
                    ];
                }
            }
        }

        if (!is_null($idVoucherCode) && $idVoucherCode !== 0 && empty($idVoucherPromotions)) {
            try {
                $createVoucher = Voucher::create([
                    'idVoucherCodeValue' => $idVoucherCode,
                    'idVoucherPromotionValue' => null,
                ]);
                $createVouchers[] = $createVoucher;
            } catch (\Exception $e) {
                $failedOrders[] = ['error' => $e->getMessage()];
            }
        }

        if (!is_null($idVoucherCode) && $idVoucherCode !== 0 && !empty($idVoucherPromotions)) {
            foreach ($idVoucherPromotions as $idVoucherPromotion) {
                try {
                    $createVoucher = Voucher::create([
                        'idVoucherCodeValue' => $idVoucherCode,
                        'idVoucherPromotionValue' => $idVoucherPromotion,
                    ]);
                    $createVouchers[] = $createVoucher;
                } catch (\Exception $e) {
                    $failedOrders[] = [
                        'idVoucherPromotion' => $idVoucherPromotion,
                        'error' => $e->getMessage()
                    ];
                }
            }
        }

        if (count($failedOrders) > 0) {
            return response()->json([
                'status' => 0,
                'message' => 'Một số voucher không thể được tạo',
                'failedOrders' => $failedOrders
            ], 500);
        }

        return response()->json([
            'status' => 1,
            'createVoucher' => $createVouchers,
            'message' => 'Voucher đã được tạo thành công'
        ]);
    }
}
