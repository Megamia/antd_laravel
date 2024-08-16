<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $data = $request->only('idDetailOrder', 'idInforUser', 'idVoucher');
        $createOrders = [];
        $failedOrders = [];

        if (is_null($data['idVoucher'])) {
            foreach ($data['idDetailOrder'] as $idDetailOrder) {
                try {
                    $createOrder = Order::create([
                        'idDetailOrder' => $idDetailOrder,
                        'idVoucher' => null,
                        'idInforUser' => $data['idInforUser'],
                    ]);
                    $createOrders[] = $createOrder;
                } catch (\Exception $e) {
                    $failedOrders[] = [
                        'idDetailOrder' => $idDetailOrder,
                        'error' => $e->getMessage()
                    ];
                }
            }
        } else {
            foreach ($data['idVoucher'] as $idVoucher) {
                foreach ($data['idDetailOrder'] as $idDetailOrder) {
                    try {
                        $createOrder = Order::create([
                            'idDetailOrder' => $idDetailOrder,
                            'idVoucher' => $idVoucher,
                            'idInforUser' => $data['idInforUser'],
                        ]);
                        $createOrders[] = $createOrder;
                    } catch (\Exception $e) {
                        $failedOrders[] = [
                            'idDetailOrder' => $idDetailOrder,
                            'idVoucher' => $idVoucher,
                            'error' => $e->getMessage()
                        ];
                    }
                }
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
