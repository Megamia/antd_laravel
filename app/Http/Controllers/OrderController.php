<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Voucher;
use App\Models\VoucherCodeValue;
use App\Models\VoucherPromotionValue;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // public function createOrder(Request $request)
    // {
    //     $data = $request->only('idDetailOrder', 'idInforUser', 'idVoucher', 'valueOrder');
    //     $createOrders = [];
    //     $failedOrders = [];

    //     $totalValueVoucher = 0;
    //     if (!empty($data['idVoucher'])) {
    //         $idVoucherCodeValue = $data['idVoucher']['idVoucherCodeValue'] ?? null;
    //         $idVoucherPromotionValues = $data['idVoucher']['idVoucherPromotionValue'] ?? [];

    //         $valueVoucherCode = $idVoucherCodeValue ? VoucherCodeValue::where('id', $idVoucherCodeValue)->value('value') : 0;
    //         $valueVoucherPromotion = !empty($idVoucherPromotionValues) ? VoucherPromotionValue::whereIn('id', $idVoucherPromotionValues)->sum('value') : 0;

    //         $totalValueVoucher = $valueVoucherCode + $valueVoucherPromotion;
    //     }

    //     foreach ($data['idDetailOrder'] as $idDetailOrder) {
    //         try {
    //             $createOrder = Order::create([
    //                 'idDetailOrder' => $idDetailOrder,
    //                 'idVoucher' => $data['idVoucher'] ?? null,
    //                 'idInforUser' => $data['idInforUser'],
    //                 'valueVoucher' => $totalValueVoucher,
    //                 'valueOrder' => $data['valueOrder'],
    //             ]);
    //             $createOrders[] = $createOrder;
    //         } catch (\Exception $e) {
    //             $failedOrders[] = [
    //                 'idDetailOrder' => $idDetailOrder,
    //                 'error' => $e->getMessage()
    //             ];
    //         }
    //     }

    //     if (count($failedOrders) > 0) {
    //         return response()->json([
    //             'status' => 0,
    //             'message' => 'Some orders could not be created',
    //             'failedOrders' => $failedOrders
    //         ], 500);
    //     }

    //     return response()->json(['status' => 1, 'createOrders' => $createOrders]);
    // }
    public function createOrderWithoutValue(Request $request)
    {
        $validated = $request->validate([
            'idAddress' => 'required|exists:Address,id',
            'idVoucherCode' => 'nullable|exists:VoucherCodeValue,id',
        ]);

        $idAddress = $validated['idAddress'];
        $idVoucherCode = $validated['idVoucherCode'] ?? null;

        $createOrderWithoutValues = [];
        $detailCreateOrderWithoutValues = [];
        try {
            $orderData = [
                'idAddress' => $idAddress,
            ];

            if ($idVoucherCode !== null) {
                $orderData['idVoucherCode'] = $idVoucherCode;
            }

            $createOrderWithoutValue = Order::create($orderData);
            $createOrderWithoutValues[] = $createOrderWithoutValue;
            $detailCreateOrderWithoutValues[] = Order::find($createOrderWithoutValue->id);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => 'Failed to create order without value', 'error' => $e->getMessage()]);
        }

        return response()->json(['status' => 1, 'createOrderWithoutValue' => $createOrderWithoutValues, 'detail' => $detailCreateOrderWithoutValues]);
    }
    public function createOrderWithValue(Request $request)
    {
        $validated = $request->validate([
            'idVoucherCode' => 'nullable|exists:VoucherCodeValue,id',
        ]);
        $data = $request->only('idOrder', 'idVoucherCode');

        $idOrder = $data['idOrder'];

        $order = Order::where('id', $idOrder)->first();
        $idVoucherCodeFromOrder = $order ? $order->idVoucherCode : null;

        $valueVoucherCode = 0;
        if ($idVoucherCodeFromOrder) {
            $valueCode = VoucherCodeValue::where('id', $idVoucherCodeFromOrder)->value('value');
            if ($valueCode) {
                $cleanedValueVoucherCode = str_replace([',', '.'], '', $valueCode);
                $valueVoucherCode = (float) $cleanedValueVoucherCode;
            }
        }

        $voucherPromotions = Voucher::where('idOrder', $idOrder)
            ->pluck('idVoucherPromotionValue');

        $sumValueVoucherPromotion = VoucherPromotionValue::whereIn('id', $voucherPromotions)
            ->pluck('value')
            ->map(function ($valuePromotion) {
                $cleanedValueVoucherPromotion = str_replace([',', '.'], '', $valuePromotion);
                return (float) $cleanedValueVoucherPromotion;
            })
            ->sum();

        $priceDetailOrder = DetailOrder::where('idOrder', $idOrder)->value('price');
        $totalVoucherValue = $valueVoucherCode + $sumValueVoucherPromotion;
        $updatedRows = Order::where('id', $idOrder)
            ->update([
                'valueVoucher' => $totalVoucherValue,
                'valueOrder' => $priceDetailOrder
            ]);
        if ($updatedRows > 0) {
            return response()->json([
                'status' => 1,
                'totalVoucherValue' => $totalVoucherValue,
                'message' => 'Tính toán thành công'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'totalVoucherValue' => $totalVoucherValue,
                'message' => 'Tính toán thất bại'
            ]);
        }
    }
}
