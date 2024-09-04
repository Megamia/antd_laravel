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
            'idVoucherPromotion.*' => 'nullable|exists:VoucherPromotionValue,id',
            'idOrder' => 'required|array',
            'idOrder.*' => 'exists:Order,id',
        ]);

        $idVoucherPromotions = $validated['idVoucherPromotion'] ?? [];
        $idOrders = $validated['idOrder'];

        $result = [];

        foreach ($idOrders as $idOrder) {
            $order = Order::findOrFail($idOrder);

            $idVoucherCode = $order->idVoucherCode ?? null;

            $createVouchers = [];
            $totalVoucherValue = 0;

            foreach ($idVoucherPromotions as $idVoucherPromotion) {
                try {
                    if (!is_null($idVoucherPromotion)) {
                        $voucherPromotionValue = VoucherPromotionValue::findOrFail($idVoucherPromotion);
                        $totalVoucherValue += $voucherPromotionValue->value;
                    }
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Failed to retrieve voucher promotion value',
                        'error' => $e->getMessage()
                    ]);
                }
            }

            foreach ($idVoucherPromotions as $idVoucherPromotion) {
                try {
                    $createVoucher = Voucher::create([
                        'idVoucherPromotionValue' => $idVoucherPromotion ?? null,
                        'idOrder' => $idOrder,
                    ]);
                    $createVouchers[] = $createVoucher;
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Failed to create voucher',
                        'error' => $e->getMessage()
                    ]);
                }
            }

            $orderValueVoucher = 0;
            if ($idVoucherCode) {
                try {
                    $voucherCodeValue = VoucherCodeValue::findOrFail($idVoucherCode);
                    $orderValueVoucher = $voucherCodeValue->value;
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Failed to retrieve voucher code value',
                        'error' => $e->getMessage()
                    ]);
                }
            }

            try {
                $order->valueVoucher = ($totalVoucherValue + $orderValueVoucher) * 1000;
                $order->save();
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Failed to update order valueVoucher',
                    'error' => $e->getMessage()
                ]);
            }
        }
        $result[] = [
            'data' => Order::findOrFail($idOrders),
        ];

        return response()->json([
            'status' => 1,
            'result' => $result
        ]);
    }
}
