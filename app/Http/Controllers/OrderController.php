<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\VoucherCodeValue;
use App\Models\VoucherPromotionValue;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $data = $request->only('idDetailOrder', 'idInforUser', 'idVoucher', 'valueOrder');
        $createOrders = [];
        $failedOrders = [];

        $totalValueVoucher = 0;
        if (!empty($data['idVoucher'])) {
            $idVoucherCodeValue = $data['idVoucher']['idVoucherCodeValue'] ?? null;
            $idVoucherPromotionValues = $data['idVoucher']['idVoucherPromotionValue'] ?? [];

            $valueVoucherCode = $idVoucherCodeValue ? VoucherCodeValue::where('id', $idVoucherCodeValue)->value('value') : 0;
            $valueVoucherPromotion = !empty($idVoucherPromotionValues) ? VoucherPromotionValue::whereIn('id', $idVoucherPromotionValues)->sum('value') : 0;

            $totalValueVoucher = $valueVoucherCode + $valueVoucherPromotion;
        }

        foreach ($data['idDetailOrder'] as $idDetailOrder) {
            try {
                $createOrder = Order::create([
                    'idDetailOrder' => $idDetailOrder,
                    'idVoucher' => $data['idVoucher'] ?? null,
                    'idInforUser' => $data['idInforUser'],
                    'valueVoucher' => $totalValueVoucher,
                    'valueOrder' => $data['valueOrder'],
                ]);
                $createOrders[] = $createOrder;
            } catch (\Exception $e) {
                $failedOrders[] = [
                    'idDetailOrder' => $idDetailOrder,
                    'error' => $e->getMessage()
                ];
            }
        }

        if (count($failedOrders) > 0) {
            return response()->json([
                'status' => 0,
                'message' => 'Some orders could not be created',
                'failedOrders' => $failedOrders
            ], 500);
        }

        return response()->json(['status' => 1, 'createOrders' => $createOrders]);
    }
}
